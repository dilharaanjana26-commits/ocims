<?php
namespace Admin;

use Controller;
use Database;
use Flash;
use Csrf;
use Env;
use Auth;

class PaymentsController extends Controller
{
    public function index()
    {
        $this->requireRole('admin');
        $db = Database::get();
        $teacherPayments = $db->query("SELECT tp.*, t.name AS teacher_name FROM teacher_payments tp JOIN teachers t ON t.id = tp.teacher_id ORDER BY tp.id DESC")->fetchAll();
        $studentPayments = $db->query("SELECT sp.*, s.name AS student_name, b.name AS batch_name FROM student_payments sp JOIN students s ON s.id = sp.student_id JOIN batches b ON b.id = sp.batch_id ORDER BY sp.id DESC")->fetchAll();
        $this->view('admin/payments', ['teacherPayments' => $teacherPayments, 'studentPayments' => $studentPayments]);
    }

    public function approveTeacher()
    {
        $this->requireRole('admin');
        if (!Csrf::validate($_POST['csrf_token'] ?? '')) {
            Flash::error('Invalid CSRF token.');
            $this->redirect('/public/index.php?route=admin/payments');
        }
        $paymentId = (int) ($_POST['payment_id'] ?? 0);
        $db = Database::get();
        $db->prepare("UPDATE teacher_payments SET status = 'approved' WHERE id = :id")->execute(['id' => $paymentId]);
        $payment = $db->prepare('SELECT * FROM teacher_payments WHERE id = :id');
        $payment->execute(['id' => $paymentId]);
        $paymentData = $payment->fetch();
        if ($paymentData) {
            $months = (int) Env::get('TEACHER_SUBSCRIPTION_MONTHS', 1);
            $db->prepare("UPDATE teachers SET subscription_status = 'active', subscription_expiry = DATE_ADD(CURDATE(), INTERVAL {$months} MONTH) WHERE id = :id")
                ->execute(['id' => $paymentData['teacher_id']]);
        }
        Flash::success('Teacher payment approved.');
        $this->redirect('/public/index.php?route=admin/payments');
    }

    public function approveStudent()
    {
        $this->requireRole('admin');
        if (!Csrf::validate($_POST['csrf_token'] ?? '')) {
            Flash::error('Invalid CSRF token.');
            $this->redirect('/public/index.php?route=admin/payments');
        }
        $paymentId = (int) ($_POST['payment_id'] ?? 0);
        $db = Database::get();
        $db->prepare("UPDATE student_payments SET status = 'approved' WHERE id = :id")->execute(['id' => $paymentId]);
        Flash::success('Student payment approved.');
        $this->redirect('/public/index.php?route=admin/payments');
    }

    public function proof()
    {
        if (!Auth::check() || Auth::role() !== 'admin') {
            $this->renderNotFound();
        }

        $paymentId = (int) ($_GET['id'] ?? 0);
        if ($paymentId <= 0) {
            $this->renderNotFound();
        }

        $db = Database::get();
        $payment = $db->prepare('SELECT proof FROM student_payments WHERE id = :id');
        $payment->execute(['id' => $paymentId]);
        $paymentData = $payment->fetch();

        if (!$paymentData) {
            $payment = $db->prepare('SELECT proof FROM teacher_payments WHERE id = :id');
            $payment->execute(['id' => $paymentId]);
            $paymentData = $payment->fetch();
        }

        $proofPath = $paymentData['proof'] ?? '';
        if ($proofPath === '') {
            $this->renderNotFound();
        }

        $publicRoot = realpath(__DIR__ . '/../../../public');
        $baseDir = $publicRoot ? realpath($publicRoot . '/uploads/payment_proofs') : false;
        if (!$publicRoot || !$baseDir) {
            $this->renderNotFound();
        }

        $relativeProof = ltrim($proofPath, '/\\');
        $fullPath = realpath($publicRoot . '/' . $relativeProof);
        if (!$fullPath || strpos($fullPath, $baseDir) !== 0 || !is_file($fullPath)) {
            $this->renderNotFound();
        }

        $extension = strtolower(pathinfo($fullPath, PATHINFO_EXTENSION));
        $mimeTypes = [
            'pdf' => 'application/pdf',
            'png' => 'image/png',
            'jpg' => 'image/jpeg',
            'jpeg' => 'image/jpeg',
            'gif' => 'image/gif',
        ];

        if (!isset($mimeTypes[$extension])) {
            $this->renderNotFound();
        }

        header('Content-Type: ' . $mimeTypes[$extension]);
        header('Content-Length: ' . filesize($fullPath));
        header('Content-Disposition: inline; filename="' . basename($fullPath) . '"');
        readfile($fullPath);
        exit;
    }

    private function renderNotFound()
    {
        header('HTTP/1.1 404 Not Found');
        echo '404 Not Found';
        exit;
    }
}

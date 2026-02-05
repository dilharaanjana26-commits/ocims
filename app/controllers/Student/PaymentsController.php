<?php
namespace Student;

use Controller;
use Database;
use Flash;
use Csrf;
use Helpers;
use PaymentService;
use Env;

class PaymentsController extends Controller
{
    public function index()
    {
        $this->requireRole('student');
        $db = Database::get();
        $studentId = $_SESSION['user']['id'];
        $batches = $db->query('SELECT * FROM batches ORDER BY name')->fetchAll();
        $payments = $db->prepare('SELECT sp.*, b.name AS batch_name FROM student_payments sp JOIN batches b ON b.id = sp.batch_id WHERE sp.student_id = :id ORDER BY sp.id DESC');
        $payments->execute(['id' => $studentId]);
        $this->view('student/payments', ['payments' => $payments->fetchAll(), 'batches' => $batches]);
    }

    public function storeManual()
    {
        $this->requireRole('student');
        if (!Csrf::validate($_POST['csrf_token'] ?? '')) {
            Flash::error('Invalid CSRF token.');
            $this->redirect('/public/index.php?route=student/payments');
        }
        try {
            $proof = Helpers::uploadFile($_FILES['proof'], __DIR__ . '/../../../public/assets/uploads/payment_proofs', ['jpg', 'jpeg', 'png', 'pdf']);
            $amount = (float) ($_POST['amount'] ?? 0);
            $stmt = Database::get()->prepare('INSERT INTO student_payments (student_id, batch_id, amount, convenience_fee, total_amount, payment_type, proof, status, paid_on) VALUES (:student_id, :batch_id, :amount, :convenience_fee, :total_amount, :payment_type, :proof, :status, :paid_on)');
            $stmt->execute([
                'student_id' => $_SESSION['user']['id'],
                'batch_id' => (int) ($_POST['batch_id'] ?? 0),
                'amount' => $amount,
                'convenience_fee' => 0,
                'total_amount' => $amount,
                'payment_type' => 'manual',
                'proof' => str_replace(__DIR__ . '/../../../public', '', $proof),
                'status' => 'pending',
                'paid_on' => date('Y-m-d'),
            ]);
            Flash::success('Manual payment submitted for approval.');
        } catch (Exception $e) {
            Flash::error($e->getMessage());
        }
        $this->redirect('/public/index.php?route=student/payments');
    }

    public function storeOnline()
    {
        $this->requireRole('student');
        if (!Csrf::validate($_POST['csrf_token'] ?? '')) {
            Flash::error('Invalid CSRF token.');
            $this->redirect('/public/index.php?route=student/payments');
        }
        $amount = (float) ($_POST['amount'] ?? 0);
        $service = new PaymentService();
        $fee = $service->calculateConvenienceFee($amount, (float) Env::get('CONVENIENCE_FEE_PERCENT', 5));
        $total = $amount + $fee;
        $result = $service->processOnlinePayment($total);
        $stmt = Database::get()->prepare('INSERT INTO student_payments (student_id, batch_id, amount, convenience_fee, total_amount, payment_type, proof, status, paid_on) VALUES (:student_id, :batch_id, :amount, :convenience_fee, :total_amount, :payment_type, :proof, :status, :paid_on)');
        $stmt->execute([
            'student_id' => $_SESSION['user']['id'],
            'batch_id' => (int) ($_POST['batch_id'] ?? 0),
            'amount' => $amount,
            'convenience_fee' => $fee,
            'total_amount' => $total,
            'payment_type' => 'online',
            'proof' => $result['gateway_reference'],
            'status' => $result['status'],
            'paid_on' => date('Y-m-d'),
        ]);
        Flash::success('Online payment captured successfully.');
        $this->redirect('/public/index.php?route=student/payments');
    }
}

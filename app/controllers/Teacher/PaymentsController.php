<?php
namespace Teacher;

use Controller;
use Database;
use Flash;
use Csrf;
use Helpers;

class PaymentsController extends Controller
{
    public function index()
    {
        $this->requireRole('teacher');
        $db = Database::get();
        $payments = $db->prepare('SELECT * FROM teacher_payments WHERE teacher_id = :id ORDER BY id DESC');
        $payments->execute(['id' => $_SESSION['user']['id']]);
        $this->view('teacher/payments', ['payments' => $payments->fetchAll()]);
    }

    public function store()
    {
        $this->requireRole('teacher');
        if (!Csrf::validate($_POST['csrf_token'] ?? '')) {
            Flash::error('Invalid CSRF token.');
            $this->redirect('/public/index.php?route=teacher/payments');
        }
        try {
            $proof = Helpers::uploadFile($_FILES['proof'], __DIR__ . '/../../../public/assets/uploads/payment_proofs', ['jpg', 'jpeg', 'png', 'pdf']);
            $stmt = Database::get()->prepare('INSERT INTO teacher_payments (teacher_id, amount, payment_type, proof, status, paid_on) VALUES (:teacher_id, :amount, :payment_type, :proof, :status, :paid_on)');
            $stmt->execute([
                'teacher_id' => $_SESSION['user']['id'],
                'amount' => (float) ($_POST['amount'] ?? 0),
                'payment_type' => 'manual',
                'proof' => str_replace(__DIR__ . '/../../../public', '', $proof),
                'status' => 'pending',
                'paid_on' => date('Y-m-d'),
            ]);
            Flash::success('Payment submitted for approval.');
        } catch (Exception $e) {
            Flash::error($e->getMessage());
        }
        $this->redirect('/public/index.php?route=teacher/payments');
    }
}

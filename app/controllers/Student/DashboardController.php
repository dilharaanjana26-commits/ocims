<?php
namespace Student;

use Controller;
use Database;

class DashboardController extends Controller
{
    public function index()
    {
        $this->requireRole('student');
        $db = Database::get();
        $studentId = $_SESSION['user']['id'];
        $payments = $db->prepare("SELECT sp.*, b.name AS batch_name FROM student_payments sp JOIN batches b ON b.id = sp.batch_id WHERE sp.student_id = :id ORDER BY sp.id DESC");
        $payments->execute(['id' => $studentId]);
        $nextClass = $db->prepare("SELECT cs.*, b.name AS batch_name FROM class_schedule cs JOIN batches b ON b.id = cs.batch_id WHERE cs.class_date >= CURDATE() ORDER BY cs.class_date LIMIT 1");
        $nextClass->execute();
        $this->view('student/dashboard', [
            'payments' => $payments->fetchAll(),
            'nextClass' => $nextClass->fetch(),
        ]);
    }
}

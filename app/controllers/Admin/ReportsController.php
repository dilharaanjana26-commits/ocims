<?php
namespace Admin;

use Controller;
use Database;

class ReportsController extends Controller
{
    public function index()
    {
        $this->requireRole('admin');
        $db = Database::get();
        $teacherPayments = $db->query("SELECT status, COUNT(*) as total FROM teacher_payments GROUP BY status")->fetchAll();
        $studentPayments = $db->query("SELECT status, COUNT(*) as total FROM student_payments GROUP BY status")->fetchAll();
        $attendance = $db->query("SELECT status, COUNT(*) as total FROM attendance GROUP BY status")->fetchAll();
        $performance = $db->query("SELECT AVG(score) as avg_score FROM performance")->fetchColumn();
        $upcoming = $db->query("SELECT COUNT(*) FROM class_schedule WHERE class_date >= CURDATE()")->fetchColumn();

        $this->view('admin/reports', [
            'teacherPayments' => $teacherPayments,
            'studentPayments' => $studentPayments,
            'attendance' => $attendance,
            'performance' => $performance,
            'upcoming' => $upcoming,
        ]);
    }
}

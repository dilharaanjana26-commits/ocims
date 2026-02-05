<?php
namespace Admin;

use Controller;
use Database;
use Auth;

class DashboardController extends Controller
{
    public function index()
    {
        $this->requireRole('admin');
        $db = Database::get();

        $stats = [
            'teachers' => $db->query("SELECT COUNT(*) FROM teachers WHERE approval_status = 'approved'")->fetchColumn(),
            'students' => $db->query("SELECT COUNT(*) FROM students WHERE approval_status = 'approved'")->fetchColumn(),
            'batches' => $db->query('SELECT COUNT(*) FROM batches')->fetchColumn(),
            'pending_teacher_payments' => $db->query("SELECT COUNT(*) FROM teacher_payments WHERE status = 'pending'")->fetchColumn(),
            'pending_student_payments' => $db->query("SELECT COUNT(*) FROM student_payments WHERE status = 'pending' AND payment_type = 'manual'")->fetchColumn(),
            'pending_posts' => $db->query("SELECT COUNT(*) FROM posts WHERE status = 'pending'")->fetchColumn(),
            'pending_post_payments' => $db->query("SELECT COUNT(*) FROM post_payments WHERE status = 'pending'")->fetchColumn(),
            'upcoming_classes' => $db->query("SELECT COUNT(*) FROM class_schedule WHERE class_date >= CURDATE()")->fetchColumn(),
            'pending_teacher_approvals' => $db->query("SELECT COUNT(*) FROM teachers WHERE approval_status = 'pending'")->fetchColumn(),
            'pending_student_approvals' => $db->query("SELECT COUNT(*) FROM students WHERE approval_status = 'pending'")->fetchColumn(),
        ];

        $this->view('admin/dashboard', ['stats' => $stats]);
    }
}

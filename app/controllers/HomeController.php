<?php
use Database;

class HomeController extends Controller
{
    public function index()
    {
        $db = Database::get();
        $posts = $db->query("SELECT p.*, t.name AS teacher_name, b.name AS batch_name FROM posts p JOIN teachers t ON t.id = p.teacher_id JOIN batches b ON b.id = p.batch_id WHERE p.status = 'approved' ORDER BY p.created_at DESC")->fetchAll();

        $stats = [
            'teachers' => $db->query("SELECT COUNT(*) FROM teachers WHERE approval_status = 'approved'")->fetchColumn(),
            'students' => $db->query("SELECT COUNT(*) FROM students WHERE approval_status = 'approved'")->fetchColumn(),
            'batches' => $db->query('SELECT COUNT(*) FROM batches')->fetchColumn(),
            'upcoming_classes' => $db->query("SELECT COUNT(*) FROM class_schedule WHERE class_date >= CURDATE()")->fetchColumn(),
        ];

        $this->view('home', ['posts' => $posts, 'stats' => $stats]);
    }
}

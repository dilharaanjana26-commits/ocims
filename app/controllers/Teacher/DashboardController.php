<?php
namespace Teacher;

use Controller;
use Database;

class DashboardController extends Controller
{
    public function index()
    {
        $this->requireRole('teacher');
        $db = Database::get();
        $teacherId = $_SESSION['user']['id'];
        $teacher = $db->prepare('SELECT * FROM teachers WHERE id = :id');
        $teacher->execute(['id' => $teacherId]);
        $teacherData = $teacher->fetch();
        $batches = $db->prepare('SELECT * FROM batches WHERE teacher_id = :id');
        $batches->execute(['id' => $teacherId]);
        $classes = $db->prepare("SELECT * FROM class_schedule WHERE batch_id IN (SELECT id FROM batches WHERE teacher_id = :id) AND class_date >= CURDATE() ORDER BY class_date");
        $classes->execute(['id' => $teacherId]);
        $pendingPosts = $db->prepare("SELECT COUNT(*) FROM posts WHERE teacher_id = :id AND status = 'pending'");
        $pendingPosts->execute(['id' => $teacherId]);

        $this->view('teacher/dashboard', [
            'teacher' => $teacherData,
            'batches' => $batches->fetchAll(),
            'classes' => $classes->fetchAll(),
            'pendingPosts' => $pendingPosts->fetchColumn(),
        ]);
    }
}

<?php
namespace Student;

use Controller;
use Database;
use Flash;

class ContentController extends Controller
{
    public function index()
    {
        $this->requireRole('student');
        $db = Database::get();
        $studentId = $_SESSION['user']['id'];

        $hasAccess = $db->prepare("SELECT COUNT(*) FROM student_payments WHERE student_id = :id AND status IN ('approved','captured')");
        $hasAccess->execute(['id' => $studentId]);
        if ($hasAccess->fetchColumn() == 0) {
            Flash::error('Payment required to access content.');
            $this->redirect('/public/index.php?route=student/payments');
        }

        $posts = $db->query("SELECT p.*, t.name AS teacher_name FROM posts p JOIN teachers t ON t.id = p.teacher_id WHERE p.status = 'approved' ORDER BY p.created_at DESC")->fetchAll();
        $tutes = $db->query('SELECT tutes.*, batches.name AS batch_name FROM tutes JOIN batches ON batches.id = tutes.batch_id ORDER BY tutes.id DESC')->fetchAll();
        $live = $db->query('SELECT live_classes.*, batches.name AS batch_name FROM live_classes JOIN batches ON batches.id = live_classes.batch_id ORDER BY live_classes.schedule_date DESC')->fetchAll();

        $this->view('student/content', ['posts' => $posts, 'tutes' => $tutes, 'live' => $live]);
    }
}

<?php
namespace Teacher;

use Controller;
use Database;
use Flash;
use Csrf;

class ClassesController extends Controller
{
    private function ensureActiveSubscription()
    {
        $teacher = Database::get()->prepare('SELECT subscription_status, subscription_expiry FROM teachers WHERE id = :id');
        $teacher->execute(['id' => $_SESSION['user']['id']]);
        $data = $teacher->fetch();
        if (!$data || $data['subscription_status'] !== 'active' || ($data['subscription_expiry'] && $data['subscription_expiry'] < date('Y-m-d'))) {
            Flash::error('Subscription inactive or expired.');
            $this->redirect('/public/index.php?route=teacher/dashboard');
        }
    }

    public function index()
    {
        $this->requireRole('teacher');
        $db = Database::get();
        $classes = $db->prepare("SELECT cs.*, b.name AS batch_name FROM class_schedule cs JOIN batches b ON b.id = cs.batch_id WHERE b.teacher_id = :id ORDER BY cs.class_date DESC");
        $classes->execute(['id' => $_SESSION['user']['id']]);
        $batches = $db->prepare('SELECT * FROM batches WHERE teacher_id = :id');
        $batches->execute(['id' => $_SESSION['user']['id']]);
        $this->view('teacher/classes', ['classes' => $classes->fetchAll(), 'batches' => $batches->fetchAll()]);
    }

    public function store()
    {
        $this->requireRole('teacher');
        $this->ensureActiveSubscription();
        if (!Csrf::validate($_POST['csrf_token'] ?? '')) {
            Flash::error('Invalid CSRF token.');
            $this->redirect('/public/index.php?route=teacher/classes');
        }
        $stmt = Database::get()->prepare('INSERT INTO class_schedule (batch_id, class_date, start_time, end_time, topic, status) VALUES (:batch_id, :class_date, :start_time, :end_time, :topic, :status)');
        $stmt->execute([
            'batch_id' => (int) ($_POST['batch_id'] ?? 0),
            'class_date' => $_POST['class_date'] ?? date('Y-m-d'),
            'start_time' => $_POST['start_time'] ?? '09:00',
            'end_time' => $_POST['end_time'] ?? '10:00',
            'topic' => trim($_POST['topic'] ?? ''),
            'status' => 'scheduled',
        ]);
        Flash::success('Class scheduled.');
        $this->redirect('/public/index.php?route=teacher/classes');
    }
}

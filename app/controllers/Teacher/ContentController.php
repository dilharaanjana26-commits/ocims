<?php
namespace Teacher;

use Controller;
use Database;
use Flash;
use Csrf;
use Helpers;

class ContentController extends Controller
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
        $batches = $db->prepare('SELECT * FROM batches WHERE teacher_id = :id');
        $batches->execute(['id' => $_SESSION['user']['id']]);
        $tutes = $db->prepare('SELECT tutes.*, batches.name AS batch_name FROM tutes JOIN batches ON batches.id = tutes.batch_id WHERE batches.teacher_id = :id ORDER BY tutes.id DESC');
        $tutes->execute(['id' => $_SESSION['user']['id']]);
        $live = $db->prepare('SELECT live_classes.*, batches.name AS batch_name FROM live_classes JOIN batches ON batches.id = live_classes.batch_id WHERE batches.teacher_id = :id ORDER BY live_classes.id DESC');
        $live->execute(['id' => $_SESSION['user']['id']]);
        $this->view('teacher/content', [
            'batches' => $batches->fetchAll(),
            'tutes' => $tutes->fetchAll(),
            'live' => $live->fetchAll(),
        ]);
    }

    public function uploadTute()
    {
        $this->requireRole('teacher');
        $this->ensureActiveSubscription();
        if (!Csrf::validate($_POST['csrf_token'] ?? '')) {
            Flash::error('Invalid CSRF token.');
            $this->redirect('/public/index.php?route=teacher/content');
        }
        try {
            $file = Helpers::uploadFile($_FILES['file'], __DIR__ . '/../../../public/assets/uploads/tutes', ['pdf', 'jpg', 'jpeg', 'png']);
            Database::get()->prepare('INSERT INTO tutes (batch_id, title, file_path) VALUES (:batch_id, :title, :file_path)')
                ->execute([
                    'batch_id' => (int) ($_POST['batch_id'] ?? 0),
                    'title' => trim($_POST['title'] ?? ''),
                    'file_path' => str_replace(__DIR__ . '/../../../public', '', $file),
                ]);
            Flash::success('Tute uploaded.');
        } catch (Exception $e) {
            Flash::error($e->getMessage());
        }
        $this->redirect('/public/index.php?route=teacher/content');
    }

    public function addLive()
    {
        $this->requireRole('teacher');
        $this->ensureActiveSubscription();
        if (!Csrf::validate($_POST['csrf_token'] ?? '')) {
            Flash::error('Invalid CSRF token.');
            $this->redirect('/public/index.php?route=teacher/content');
        }
        Database::get()->prepare('INSERT INTO live_classes (batch_id, youtube_embed_url, schedule_date) VALUES (:batch_id, :youtube_embed_url, :schedule_date)')
            ->execute([
                'batch_id' => (int) ($_POST['batch_id'] ?? 0),
                'youtube_embed_url' => trim($_POST['youtube_embed_url'] ?? ''),
                'schedule_date' => $_POST['schedule_date'] ?? date('Y-m-d'),
            ]);
        Flash::success('Live class added.');
        $this->redirect('/public/index.php?route=teacher/content');
    }
}

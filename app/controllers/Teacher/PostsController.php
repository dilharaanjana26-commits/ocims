<?php
namespace Teacher;

use Controller;
use Database;
use Flash;
use Csrf;
use Helpers;

class PostsController extends Controller
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
        $posts = $db->prepare('SELECT * FROM posts WHERE teacher_id = :id ORDER BY id DESC');
        $posts->execute(['id' => $_SESSION['user']['id']]);
        $batches = $db->prepare('SELECT * FROM batches WHERE teacher_id = :id');
        $batches->execute(['id' => $_SESSION['user']['id']]);
        $this->view('teacher/posts', ['posts' => $posts->fetchAll(), 'batches' => $batches->fetchAll()]);
    }

    public function store()
    {
        $this->requireRole('teacher');
        $this->ensureActiveSubscription();
        if (!Csrf::validate($_POST['csrf_token'] ?? '')) {
            Flash::error('Invalid CSRF token.');
            $this->redirect('/public/index.php?route=teacher/posts');
        }
        $db = Database::get();
        $stmt = $db->prepare('INSERT INTO posts (teacher_id, batch_id, content, visibility, status, created_at) VALUES (:teacher_id, :batch_id, :content, :visibility, :status, NOW())');
        $stmt->execute([
            'teacher_id' => $_SESSION['user']['id'],
            'batch_id' => (int) ($_POST['batch_id'] ?? 0),
            'content' => trim($_POST['content'] ?? ''),
            'visibility' => 'students',
            'status' => 'pending',
        ]);
        $postId = $db->lastInsertId();
        if (!empty($_FILES['media']['name'])) {
            try {
                $path = Helpers::uploadFile($_FILES['media'], __DIR__ . '/../../../public/assets/uploads/post_media', ['jpg', 'jpeg', 'png', 'pdf']);
                $db->prepare('INSERT INTO post_media (post_id, file_path, media_type, created_at) VALUES (:post_id, :file_path, :media_type, NOW())')
                    ->execute([
                        'post_id' => $postId,
                        'file_path' => str_replace(__DIR__ . '/../../../public', '', $path),
                        'media_type' => pathinfo($path, PATHINFO_EXTENSION),
                    ]);
            } catch (Exception $e) {
                Flash::error($e->getMessage());
            }
        }
        Flash::success('Post submitted for approval.');
        $this->redirect('/public/index.php?route=teacher/posts');
    }

    public function requestFeature()
    {
        $this->requireRole('teacher');
        $this->ensureActiveSubscription();
        if (!Csrf::validate($_POST['csrf_token'] ?? '')) {
            Flash::error('Invalid CSRF token.');
            $this->redirect('/public/index.php?route=teacher/posts');
        }
        try {
            $publicRoot = realpath(__DIR__ . '/../../../public');
            $uploadDir = $publicRoot . '/uploads/payment_proofs';
            $proof = Helpers::uploadFile($_FILES['proof'], $uploadDir, ['jpg', 'jpeg', 'png', 'pdf']);
            $relativeProof = ltrim(str_replace($publicRoot, '', $proof), '/\\');
            Database::get()->prepare('INSERT INTO post_payments (post_id, teacher_id, amount, payment_type, proof, status, created_at) VALUES (:post_id, :teacher_id, :amount, :payment_type, :proof, :status, NOW())')
                ->execute([
                    'post_id' => (int) ($_POST['post_id'] ?? 0),
                    'teacher_id' => $_SESSION['user']['id'],
                    'amount' => (float) ($_POST['amount'] ?? 0),
                    'payment_type' => 'manual',
                    'proof' => $relativeProof,
                    'status' => 'pending',
                ]);
            Flash::success('Feature request submitted for approval.');
        } catch (Exception $e) {
            Flash::error($e->getMessage());
        }
        $this->redirect('/public/index.php?route=teacher/posts');
    }
}

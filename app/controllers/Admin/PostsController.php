<?php
namespace Admin;

use Controller;
use Database;
use Flash;
use Csrf;

class PostsController extends Controller
{
    public function index()
    {
        $this->requireRole('admin');
        $db = Database::get();
        $posts = $db->query("SELECT p.*, t.name AS teacher_name, b.name AS batch_name FROM posts p JOIN teachers t ON t.id = p.teacher_id JOIN batches b ON b.id = p.batch_id ORDER BY p.id DESC")->fetchAll();
        $postPayments = $db->query("SELECT pp.*, p.content FROM post_payments pp JOIN posts p ON p.id = pp.post_id ORDER BY pp.id DESC")->fetchAll();
        $this->view('admin/posts', ['posts' => $posts, 'postPayments' => $postPayments]);
    }

    public function approve()
    {
        $this->requireRole('admin');
        if (!Csrf::validate($_POST['csrf_token'] ?? '')) {
            Flash::error('Invalid CSRF token.');
            $this->redirect('/public/index.php?route=admin/posts');
        }
        $postId = (int) ($_POST['post_id'] ?? 0);
        $db = Database::get();
        $db->prepare("UPDATE posts SET status = 'approved', approved_by = :admin_id, approved_at = NOW() WHERE id = :id")
            ->execute(['admin_id' => $_SESSION['user']['id'], 'id' => $postId]);
        Flash::success('Post approved.');
        $this->redirect('/public/index.php?route=admin/posts');
    }

    public function approveFeature()
    {
        $this->requireRole('admin');
        if (!Csrf::validate($_POST['csrf_token'] ?? '')) {
            Flash::error('Invalid CSRF token.');
            $this->redirect('/public/index.php?route=admin/posts');
        }
        $paymentId = (int) ($_POST['payment_id'] ?? 0);
        $db = Database::get();
        $db->prepare("UPDATE post_payments SET status = 'approved', featured_until = DATE_ADD(NOW(), INTERVAL 7 DAY), approved_by = :admin_id, approved_at = NOW() WHERE id = :id")
            ->execute(['admin_id' => $_SESSION['user']['id'], 'id' => $paymentId]);
        Flash::success('Post feature approved.');
        $this->redirect('/public/index.php?route=admin/posts');
    }
}

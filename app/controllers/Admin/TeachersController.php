<?php
namespace Admin;

use Controller;
use Database;
use Flash;
use Csrf;

class TeachersController extends Controller
{
    public function index()
    {
        $this->requireRole('admin');
        $teachers = Database::get()->query('SELECT * FROM teachers ORDER BY id DESC')->fetchAll();
        $this->view('admin/teachers', ['teachers' => $teachers]);
    }

    public function store()
    {
        $this->requireRole('admin');
        if (!Csrf::validate($_POST['csrf_token'] ?? '')) {
            Flash::error('Invalid CSRF token.');
            $this->redirect('/public/index.php?route=admin/teachers');
        }
        $data = [
            'name' => trim($_POST['name'] ?? ''),
            'email' => trim($_POST['email'] ?? ''),
            'mobile' => trim($_POST['mobile'] ?? ''),
            'password' => password_hash($_POST['password'] ?? 'password', PASSWORD_DEFAULT),
            'subscription_status' => 'inactive',
            'subscription_expiry' => null,
        ];
        $stmt = Database::get()->prepare('INSERT INTO teachers (name, email, mobile, password, subscription_status, subscription_expiry) VALUES (:name, :email, :mobile, :password, :subscription_status, :subscription_expiry)');
        $stmt->execute($data);
        Flash::success('Teacher created successfully.');
        $this->redirect('/public/index.php?route=admin/teachers');
    }
}

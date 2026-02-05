<?php
namespace Admin;

use Controller;
use Database;
use Flash;
use Csrf;

class StudentsController extends Controller
{
    public function index()
    {
        $this->requireRole('admin');
        $students = Database::get()->query('SELECT * FROM students ORDER BY id DESC')->fetchAll();
        $this->view('admin/students', ['students' => $students]);
    }

    public function store()
    {
        $this->requireRole('admin');
        if (!Csrf::validate($_POST['csrf_token'] ?? '')) {
            Flash::error('Invalid CSRF token.');
            $this->redirect('/public/index.php?route=admin/students');
        }
        $data = [
            'name' => trim($_POST['name'] ?? ''),
            'age' => (int) ($_POST['age'] ?? 0),
            'NIC' => trim($_POST['NIC'] ?? ''),
            'city' => trim($_POST['city'] ?? ''),
            'WhatsApp' => trim($_POST['WhatsApp'] ?? ''),
            'email' => trim($_POST['email'] ?? ''),
            'password' => password_hash($_POST['password'] ?? 'password', PASSWORD_DEFAULT),
            'approval_status' => 'approved',
        ];
        $stmt = Database::get()->prepare('INSERT INTO students (name, age, NIC, city, WhatsApp, email, password, approval_status) VALUES (:name, :age, :NIC, :city, :WhatsApp, :email, :password, :approval_status)');
        $stmt->execute($data);
        Flash::success('Student created successfully.');
        $this->redirect('/public/index.php?route=admin/students');
    }

    public function approve()
    {
        $this->requireRole('admin');
        if (!Csrf::validate($_POST['csrf_token'] ?? '')) {
            Flash::error('Invalid CSRF token.');
            $this->redirect('/public/index.php?route=admin/students');
        }
        $studentId = (int) ($_POST['student_id'] ?? 0);
        if ($studentId > 0) {
            Database::get()->prepare("UPDATE students SET approval_status = 'approved' WHERE id = :id")->execute(['id' => $studentId]);
            Flash::success('Student approved successfully.');
        }
        $this->redirect('/public/index.php?route=admin/students');
    }
}

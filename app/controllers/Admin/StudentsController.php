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
        ];
        $stmt = Database::get()->prepare('INSERT INTO students (name, age, NIC, city, WhatsApp, email, password) VALUES (:name, :age, :NIC, :city, :WhatsApp, :email, :password)');
        $stmt->execute($data);
        Flash::success('Student created successfully.');
        $this->redirect('/public/index.php?route=admin/students');
    }
}

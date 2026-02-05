<?php
namespace Admin;

use Controller;
use Database;
use Flash;
use Csrf;

class BatchesController extends Controller
{
    public function index()
    {
        $this->requireRole('admin');
        $db = Database::get();
        $batches = $db->query('SELECT batches.*, teachers.name AS teacher_name FROM batches LEFT JOIN teachers ON teachers.id = batches.teacher_id ORDER BY batches.id DESC')->fetchAll();
        $teachers = $db->query('SELECT id, name FROM teachers ORDER BY name')->fetchAll();
        $this->view('admin/batches', ['batches' => $batches, 'teachers' => $teachers]);
    }

    public function store()
    {
        $this->requireRole('admin');
        if (!Csrf::validate($_POST['csrf_token'] ?? '')) {
            Flash::error('Invalid CSRF token.');
            $this->redirect('/public/index.php?route=admin/batches');
        }
        $data = [
            'name' => trim($_POST['name'] ?? ''),
            'teacher_id' => (int) ($_POST['teacher_id'] ?? 0),
            'fee_amount' => (float) ($_POST['fee_amount'] ?? 0),
        ];
        $stmt = Database::get()->prepare('INSERT INTO batches (name, teacher_id, fee_amount) VALUES (:name, :teacher_id, :fee_amount)');
        $stmt->execute($data);
        Flash::success('Batch created successfully.');
        $this->redirect('/public/index.php?route=admin/batches');
    }
}

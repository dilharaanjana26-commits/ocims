<?php
namespace Admin;

use Controller;
use Database;
use Flash;
use Csrf;

class RemindersController extends Controller
{
    public function index()
    {
        $this->requireRole('admin');
        $reminders = Database::get()->query('SELECT * FROM reminders ORDER BY id DESC')->fetchAll();
        $this->view('admin/reminders', ['reminders' => $reminders]);
    }

    public function runJobs()
    {
        $this->requireRole('admin');
        if (!Csrf::validate($_POST['csrf_token'] ?? '')) {
            Flash::error('Invalid CSRF token.');
            $this->redirect('/public/index.php?route=admin/reminders');
        }
        require __DIR__ . '/../../jobs/sms_reminder_cron.php';
        require __DIR__ . '/../../jobs/email_reminder_cron.php';
        Flash::success('Reminder jobs executed.');
        $this->redirect('/public/index.php?route=admin/reminders');
    }
}

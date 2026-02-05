<?php
namespace Admin;

use Controller;
use Env;

class SetupController extends Controller
{
    public function index()
    {
        $this->requireRole('admin');
        $checks = [
            'pdo' => extension_loaded('pdo_mysql'),
            'uploads' => is_writable(__DIR__ . '/../../../public/assets/uploads'),
            'mail' => Env::get('SMTP_HOST') ? true : false,
            'sms' => Env::get('SMS_PROVIDER') ? true : false,
            'base_url' => Env::get('BASE_URL') ? true : false,
        ];
        $this->view('admin/setup_check', ['checks' => $checks]);
    }
}

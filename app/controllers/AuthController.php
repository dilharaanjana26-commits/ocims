<?php
class AuthController extends Controller
{
    public function login()
    {
        $this->view('auth/login');
    }

    public function handleLogin()
    {
        if (!Csrf::validate($_POST['csrf_token'] ?? '')) {
            Flash::error('Invalid CSRF token.');
            $this->redirect('/public/index.php?route=login');
        }
        $email = trim($_POST['email'] ?? '');
        $password = $_POST['password'] ?? '';
        $db = Database::get();

        $roles = [
            'admin' => 'admins',
            'teacher' => 'teachers',
            'student' => 'students',
        ];

        foreach ($roles as $role => $table) {
            $stmt = $db->prepare("SELECT * FROM {$table} WHERE email = :email LIMIT 1");
            $stmt->execute(['email' => $email]);
            $user = $stmt->fetch();
            if ($user && password_verify($password, $user['password'])) {
                Auth::login($user, $role);
                $this->redirect('/public/index.php?route=' . $role . '/dashboard');
            }
        }

        Flash::error('Invalid credentials.');
        $this->redirect('/public/index.php?route=login');
    }

    public function logout()
    {
        Auth::logout();
        $this->redirect('/public/index.php?route=login');
    }
}

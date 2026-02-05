<?php
class AuthController extends Controller
{
    public function login()
    {
        $this->view('auth/login');
    }

    public function signup()
    {
        $this->view('auth/signup');
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
                if (in_array($role, ['teacher', 'student'], true) && ($user['approval_status'] ?? 'pending') !== 'approved') {
                    Flash::error('Your account is pending admin approval. Please wait for confirmation.');
                    $this->redirect('/public/index.php?route=login');
                }
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

    public function registerTeacher()
    {
        if (!Csrf::validate($_POST['csrf_token'] ?? '')) {
            Flash::error('Invalid CSRF token.');
            $this->redirect('/public/index.php?route=signup');
        }
        $db = Database::get();
        $email = trim($_POST['email'] ?? '');

        if ($this->emailExists($db, $email)) {
            Flash::error('Email already exists. Please use another email.');
            $this->redirect('/public/index.php?route=signup');
        }

        $data = [
            'name' => trim($_POST['name'] ?? ''),
            'email' => $email,
            'mobile' => trim($_POST['mobile'] ?? ''),
            'password' => password_hash($_POST['password'] ?? 'password', PASSWORD_DEFAULT),
            'subscription_status' => 'inactive',
            'subscription_expiry' => null,
            'approval_status' => 'pending',
        ];
        $stmt = $db->prepare('INSERT INTO teachers (name, email, mobile, password, subscription_status, subscription_expiry, approval_status) VALUES (:name, :email, :mobile, :password, :subscription_status, :subscription_expiry, :approval_status)');
        $stmt->execute($data);
        Flash::success('Teacher registration submitted. Await admin approval.');
        $this->redirect('/public/index.php?route=login');
    }

    public function registerStudent()
    {
        if (!Csrf::validate($_POST['csrf_token'] ?? '')) {
            Flash::error('Invalid CSRF token.');
            $this->redirect('/public/index.php?route=signup');
        }
        $db = Database::get();
        $email = trim($_POST['email'] ?? '');

        if ($this->emailExists($db, $email)) {
            Flash::error('Email already exists. Please use another email.');
            $this->redirect('/public/index.php?route=signup');
        }

        $data = [
            'name' => trim($_POST['name'] ?? ''),
            'age' => (int) ($_POST['age'] ?? 0),
            'NIC' => trim($_POST['NIC'] ?? ''),
            'city' => trim($_POST['city'] ?? ''),
            'WhatsApp' => trim($_POST['WhatsApp'] ?? ''),
            'email' => $email,
            'password' => password_hash($_POST['password'] ?? 'password', PASSWORD_DEFAULT),
            'approval_status' => 'pending',
        ];
        $stmt = $db->prepare('INSERT INTO students (name, age, NIC, city, WhatsApp, email, password, approval_status) VALUES (:name, :age, :NIC, :city, :WhatsApp, :email, :password, :approval_status)');
        $stmt->execute($data);
        Flash::success('Student registration submitted. Await admin approval.');
        $this->redirect('/public/index.php?route=login');
    }

    private function emailExists($db, $email)
    {
        if ($email === '') {
            return false;
        }
        $roles = [
            'admins' => 'admins',
            'teachers' => 'teachers',
            'students' => 'students',
        ];
        foreach ($roles as $table) {
            $stmt = $db->prepare("SELECT id FROM {$table} WHERE email = :email LIMIT 1");
            $stmt->execute(['email' => $email]);
            if ($stmt->fetch()) {
                return true;
            }
        }
        return false;
    }
}

<?php
class Auth
{
    public static function check()
    {
        return isset($_SESSION['user']);
    }

    public static function user()
    {
        return $_SESSION['user'] ?? null;
    }

    public static function role()
    {
        return $_SESSION['user']['role'] ?? null;
    }

    public static function login($user, $role)
    {
        $_SESSION['user'] = [
            'id' => $user['id'],
            'name' => $user['name'],
            'email' => $user['email'],
            'role' => $role,
        ];
    }

    public static function logout()
    {
        unset($_SESSION['user']);
    }
}

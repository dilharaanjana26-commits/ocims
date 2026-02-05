<?php
class Database
{
    private static $instance;

    public static function init()
    {
        if (self::$instance) {
            return;
        }
        $host = Env::get('DB_HOST', '127.0.0.1');
        $db = Env::get('DB_NAME', 'ocims');
        $user = Env::get('DB_USER', 'root');
        $pass = Env::get('DB_PASS', '');
        $charset = 'utf8mb4';
        $dsn = "mysql:host={$host};dbname={$db};charset={$charset}";
        $options = [
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
        ];
        self::$instance = new PDO($dsn, $user, $pass, $options);
    }

    public static function get()
    {
        return self::$instance;
    }
}

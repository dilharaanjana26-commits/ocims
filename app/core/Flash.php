<?php
class Flash
{
    public static function success($message)
    {
        $_SESSION['flash_success'] = $message;
    }

    public static function error($message)
    {
        $_SESSION['flash_error'] = $message;
    }

    public static function getSuccess()
    {
        $message = $_SESSION['flash_success'] ?? null;
        unset($_SESSION['flash_success']);
        return $message;
    }

    public static function getError()
    {
        $message = $_SESSION['flash_error'] ?? null;
        unset($_SESSION['flash_error']);
        return $message;
    }
}

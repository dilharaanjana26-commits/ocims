<?php
class Helpers
{
    public static function e($value)
    {
        return htmlspecialchars($value ?? '', ENT_QUOTES, 'UTF-8');
    }

    public static function uploadFile($file, $destinationDir, $allowedExtensions)
    {
        if (!is_dir($destinationDir)) {
            mkdir($destinationDir, 0755, true);
        }
        $extension = strtolower(pathinfo($file['name'], PATHINFO_EXTENSION));
        if (!in_array($extension, $allowedExtensions, true)) {
            throw new Exception('Invalid file type.');
        }
        $filename = bin2hex(random_bytes(16)) . '.' . $extension;
        $target = rtrim($destinationDir, '/') . '/' . $filename;
        if (!move_uploaded_file($file['tmp_name'], $target)) {
            throw new Exception('File upload failed.');
        }
        return $target;
    }
}

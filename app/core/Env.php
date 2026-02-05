<?php
class Env
{
    public static function load($path)
    {
        if (!file_exists($path)) {
            return;
        }
        $lines = file($path, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
        foreach ($lines as $line) {
            if (str_starts_with(trim($line), '#')) {
                continue;
            }
            if (!str_contains($line, '=')) {
                continue;
            }
            [$key, $value] = array_map('trim', explode('=', $line, 2));
            if (!isset($_ENV[$key])) {
                $_ENV[$key] = trim($value, "\"");
            }
        }
    }

    public static function get($key, $default = null)
    {
        return $_ENV[$key] ?? $default;
    }
}

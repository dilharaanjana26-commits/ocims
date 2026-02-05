<?php
class Router
{
    private $routes = [];

    public function get($path, $handler)
    {
        $this->routes['GET'][$path] = $handler;
    }

    public function post($path, $handler)
    {
        $this->routes['POST'][$path] = $handler;
    }

    public function dispatch()
    {
        $method = $_SERVER['REQUEST_METHOD'] ?? 'GET';
        $uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
        $route = trim($uri, '/');

        if (isset($_GET['route'])) {
            $route = trim($_GET['route'], '/');
        }

        $handler = $this->routes[$method][$route] ?? null;
        if (!$handler) {
            http_response_code(404);
            echo '404 Not Found';
            return;
        }
        [$controller, $action] = $handler;
        if (!class_exists($controller)) {
            require_once __DIR__ . '/../controllers/' . str_replace('\\', '/', $controller) . '.php';
        }
        $instance = new $controller();
        $instance->$action();
    }
}

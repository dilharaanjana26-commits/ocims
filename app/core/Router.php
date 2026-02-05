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
        $params = [];
        if (!$handler) {
            [$handler, $params] = $this->matchDynamicRoute($method, $route);
        }
        if (!$handler) {
            http_response_code(404);
            echo '404 Not Found';
            return;
        }
        if ($params) {
            $_GET = array_merge($_GET, $params);
        }
        [$controller, $action] = $handler;
        if (!class_exists($controller)) {
            require_once __DIR__ . '/../controllers/' . str_replace('\\', '/', $controller) . '.php';
        }
        $instance = new $controller();
        $instance->$action();
    }

    private function matchDynamicRoute($method, $route)
    {
        foreach ($this->routes[$method] ?? [] as $path => $handler) {
            if (strpos($path, '{') === false) {
                continue;
            }
            $paramNames = [];
            $pattern = preg_replace_callback('/\{([^}]+)\}/', function ($matches) use (&$paramNames) {
                $paramNames[] = $matches[1];
                return '([^/]+)';
            }, $path);
            $pattern = '#^' . $pattern . '$#';
            if (!preg_match($pattern, $route, $matches)) {
                continue;
            }
            array_shift($matches);
            $params = [];
            foreach ($matches as $index => $value) {
                $params[$paramNames[$index]] = $value;
            }
            return [$handler, $params];
        }

        return [null, []];
    }
}

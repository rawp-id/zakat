<?php

namespace Routes;

class Router {
    private $routes = [];

    public function addRoute($path, $action, $method = 'GET') {
        $this->routes[] = new Route($path, $action, $method);
    }

    public function run() {
        $requestUri = $_SERVER['REQUEST_URI'];
        $requestMethod = $_SERVER['REQUEST_METHOD'];

        foreach ($this->routes as $route) {
            if ($route->path === $requestUri && $route->method === $requestMethod) {
                $action = explode('@', $route->action);
                $controllerName = "\\App\\Http\\Controller\\" . $action[0];
                $methodName = $action[1];

                if (class_exists($controllerName) && method_exists($controllerName, $methodName)) {
                    $controller = new $controllerName();
                    call_user_func_array([$controller, $methodName], []);
                    return;
                }
            }
        }

        header("HTTP/1.1 404 Not Found");
        require_once __DIR__ . '/../storage/404.html';
    }
}

<?php

namespace Routes;

class Router
{
    private $routes = [];
    // Menambahkan properti baru untuk views
    private $views = [];

    public function addRoute($path, $action, $method, $view = null)
    {
        if ($view) {
            // Jika ada view, tambahkan ke array views
            $this->views[$path] = $view;
        } else {
            // Jika tidak ada view, tambahkan ke array routes sebagai Route
            $this->routes[] = new Route($path, $action, $method);
        }
    }

    public function run()
    {
        $requestUri = $_SERVER['REQUEST_URI'];
        $requestMethod = $_SERVER['REQUEST_METHOD'];

        if (array_key_exists($requestUri, $this->views)) {
            $viewPath = __DIR__ . '/../views/' . $this->views[$requestUri];
            if (file_exists($viewPath)) {
                require_once $viewPath;
                return;
            }
        }

        if (array_key_exists($requestUri, $this->views)) {
            $viewPath = __DIR__ . $this->views[$requestUri];
            if (file_exists($viewPath)) {
                require_once $viewPath;
                return;
            }
        }

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

        foreach ($this->routes as $route) {
            if ($route->path === $requestUri && $route->method === $requestMethod) {
                $action = explode('@', $route->action);
                $controllerName = "\\App\\Http\\Controller\\Auth\\" . $action[0];
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

<?php

class Router
{
    private array $routes = [];


    public function get(string $path, array $handler): void
    {
        $this->routes['GET'][$path] = $handler;
    }


    public function post(string $path, array $handler): void
    {
        $this->routes['POST'][$path] = $handler;
    }


    public function dispatch(string $method, string $uri): void
    {
        $path = parse_url($uri, PHP_URL_PATH) ?: '/';


        $publicRoutes = [
            '/login',
            '/health',
            '/public-leads/create',
            '/public-leads'
        ];


        if (
            !isset($_SESSION['user']) &&
            !in_array($path, $publicRoutes)
        ) {

            header('Location: /login');
            exit;

        }


        if (isset($this->routes[$method][$path])) {

            [$controller, $action] = $this->routes[$method][$path];


            try {

                (new $controller())->$action();

            } catch (Throwable $e) {

                http_response_code(500);

                throw $e;

            }


            return;
        }


        http_response_code(404);
        view('errors/404');
    }
}
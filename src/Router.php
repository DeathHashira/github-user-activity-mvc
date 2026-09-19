<?php

namespace Src;

class Router
{
    static array $routes = [
        'get' => [],
        'post' => []
    ];

    public static function get(string $path, callable $func): void
    {
        Router::$routes['get'][$path] = $func;
    }

    public static function post(string $path, callable $func): void
    {
        Router::$routes['post'][$path] = $func;
    }

    private static function getMethod(): string
    {
        return strtolower($_SERVER["REQUEST_METHOD"]);
    }

    private static function getPath(): string
    {
        return parse_url($_SERVER["REQUEST_URI"])['path'];
    }

    public static function run(): void
    {
        $path = Router::getPath();
        $method = Router::getMethod();

        $callable = Router::$routes[$method][$path] ?? null;
        if (is_callable($callable)) {
            $callable();
        };
    }
}
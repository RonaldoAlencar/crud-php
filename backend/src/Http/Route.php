<?php

namespace App\Http;

class Route
{
    public static array $routes = [];

    public static function get(string $path, string $controller)
    {
        self::$routes[] = [
            'path' => $path,
            'action' => $controller,
            'method' => 'GET'
        ];
    }

    public static function post(string $path, string $controller)
    {
        self::$routes[] = [
            'path' => $path,
            'action' => $controller,
            'method' => 'POST'
        ];
    }

    public static function put(string $path, string $controller)
    {
        self::$routes[] = [
            'path' => $path,
            'action' => $controller,
            'method' => 'PUT'
        ];
    }

    public static function delete(string $path, string $controller)
    {
        self::$routes[] = [
            'path' => $path,
            'action' => $controller,
            'method' => 'DELETE'
        ];
    }

    public static function routes()
    {
        return self::$routes;
    }
}


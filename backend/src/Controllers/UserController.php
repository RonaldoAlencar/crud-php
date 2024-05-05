<?php

namespace App\Controllers;

use App\Http\Request;
use App\Http\Response;
use App\Services\UserService;

class UserController
{
    public function store(Request $request, Response $response)
    {
        $body = $request::body();
        $userService = UserService::create($body);

        $response::json([
            'error' => false,
            'success' => true,
            'data' => $userService,
        ]);
    }

    public function login(Request $request, Response $response)
    {
        $body = $request::body();
        $userService = UserService::auth($body);

        if (isset($userService['error'])) {
            $response::json([
                'error' => true,
                'success' => false,
                'message' => $userService['error'],
            ], 401);
            return;
        }

        $response::json([
            'error' => false,
            'success' => true,
            'jwt' => $userService,
        ]);
    }

    public function fetch(Request $request, Response $response)
    {
        $authorization = $request::authorization();
        $userService = UserService::fetch($authorization);

        if (isset($userService['error'])) {
            $response::json([
                'error' => true,
                'success' => false,
                'message' => $userService['error'],
            ], 401);
            return;
        }

        $response::json([
            'error' => false,
            'success' => true,
            'data' => $userService,
        ]);
    }

    public function delete(Request $request, Response $response, array $id)
    {
        $authorization = $request::authorization();
        $userService = UserService::delete($authorization, $id);

        if (isset($userService['error'])) {
            $response::json([
                'error' => true,
                'success' => false,
                'message' => $userService['error'],
            ], 401);
            return;
        }

        $response::json([
            'error' => false,
            'success' => true,
            'message' => $userService,
        ]);
    }
}

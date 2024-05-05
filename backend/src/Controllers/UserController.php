<?php

namespace App\Controllers;

use App\Http\Request;
use App\Http\Response;
use App\Services\UserService;
use App\Http\JWT;

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
        try {
            $tokenVerified = JWT::verify($request::authorization());
            if (isset($tokenVerified['error'])) {
                $response::json([
                    'error' => true,
                    'success' => false,
                    'message' => $tokenVerified['error'],
                ], 401);
                return;
            }

            $userService = UserService::fetch();
            $response::json([
                'error' => false,
                'success' => true,
                'data' => $userService,
            ]);
        } catch (\Exception $e) {
            $response::json([
                'error' => true,
                'success' => false,
                'message' => 'An error occurred. Error: ' . $e->getMessage(),
            ], 500);
        }
    }

    public function delete(Request $request, Response $response, array $id)
    {
        try {
            $tokenVerified = JWT::verify($request::authorization());
            if (isset($tokenVerified['error'])) {
                $response::json([
                    'error' => true,
                    'success' => false,
                    'message' => $tokenVerified['error'],
                ], 401);
                return;
            }
    
            $userService = UserService::delete($id);
            $response::json([
                'error' => false,
                'success' => true,
                'message' => $userService,
            ]);
        } catch (\Exception $e) {
            $response::json([
                'error' => true,
                'success' => false,
                'message' => 'An error occurred. Error: ' . $e->getMessage(),
            ], 500);
        }
    }
}

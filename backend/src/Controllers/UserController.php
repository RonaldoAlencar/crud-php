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
            JWT::verify($request::authorization());
            $userService = UserService::fetch();

            $response::json([
                'error' => false,
                'success' => true,
                'data' => $userService,
            ]);
        } catch (\Firebase\JWT\ExpiredException $e) {
            $response::json([
                'error' => true,
                'success' => false,
                'message' => 'The token provided has expired, please log in again. Error: ' . $e->getMessage(),
            ], 401);
        } catch (\UnexpectedValueException $e) {
            $response::json([
                'error' => true,
                'success' => false,
                'message' => 'The token providade is invalid. Error: ' . $e->getMessage(),
            ], 401);
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

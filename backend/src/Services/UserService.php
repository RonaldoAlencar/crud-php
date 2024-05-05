<?php

namespace App\Services;
use App\Utils\Validator;
use App\Models\User;
use App\Http\JWT;

class UserService
{
    public static function create(array $data)
    {
        try {
            $fields = Validator::validate([
                'name'     => $data['name'] ?? '',
                'email'    => $data['email'] ?? '',
                'password' => $data['password'] ?? '',
            ]);
            $userAlreadyExists = User::findByEmail($fields['email']);
            if ($userAlreadyExists) return ['error' => "the email {$fields['email']} is already in use."];

            $fields['password'] = password_hash($fields['password'], PASSWORD_DEFAULT);
            $user = User::save($fields);
            if (!$user) return ['error' => 'User not created. Please verify your data.'];

            return "User created successfully.";
        } catch (PDOException $e) {
            return ['error' => $e->errorInfo()];
        } catch (\Exception $e) {
            return ['error' => $e->getMessage()];
        }
    }

    public static function auth(array $data)
    {
        try {
            $fields = Validator::validate([
                'email'    => $data['email'] ?? '',
                'password' => $data['password'] ?? '',
            ]);

            $user = User::findByEmail($fields['email']);
            if (!$user || !password_verify($fields['password'], $user['senha'])) return ['error' => 'Invalid email or password.'];

            return JWT::generate(['id' => $user['id'], 'name' => $user['nome'], 'email' => $user['email']]);
        } catch (PDOException $e) {
            return ['error' => $e->errorInfo()];
        } catch (\Exception $e) {
            return ['error' => $e->getMessage()];
        }
    }

    public static function fetch()
    {
        try {
            $user = User::findAllUsers();
            return $user;
        } catch (PDOException $e) {
            return ['error' => $e->errorInfo()];
        } catch (\Exception $e) {
            return ['error' => $e->getMessage()];
        }
    }

    public static function delete(array $id)
    {
        try {    
            $user = User::delete($id[0]);
            if (!$user) return ['error' => 'User not found.'];

            return "User deleted successfully.";
        } catch (PDOException $e) {
            return ['error' => $e->errorInfo()];
        } catch (\Exception $e) {
            return ['error' => $e->getMessage()];
        }
    }
}
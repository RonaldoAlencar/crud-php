<?php 

namespace App\Http;
use Firebase\JWT\JWT as FirebaseJWT;
use Firebase\JWT\Key;
use Firebase\JWT\ExpiredException;
use Firebase\JWT\UnexpectedValueException;

class JWT 
{
    private static string $secret = "secret-key";

    public static function generate(array $data = [])
    {
        $issuedAt = time(); // Tempo atual em que o token foi emitido
        $expirationTime = $issuedAt + 3600; // Token expira em 1 hora (3600 segundos)

        $payload = [
            'iat' => $issuedAt, // Issued at: tempo em que o token foi gerado
            'exp' => $expirationTime, // Expiration time: tempo em que o token expira
        ] + $data;

        return FirebaseJWT::encode($payload, self::$secret, 'HS256');
    }

    public static function verify(string $jwt)
    {
        try {
            $decoded = FirebaseJWT::decode($jwt, new Key(self::$secret, 'HS256'));
            return (array) $decoded;
        } catch (\Firebase\JWT\ExpiredException $e) {
            return ['error' => 'The token provided has expired, please log in again. Error: ' . $e->getMessage()];
        } catch (\Exception $e) {
            return ['error' => 'The token provided is invalid. Error: ' . $e->getMessage()];
        } 
    }
}
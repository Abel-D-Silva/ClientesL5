<?php

namespace App\Helpers;

use Firebase\JWT\JWT;
use Firebase\JWT\Key;
use CodeIgniter\Config\Services;

class JwtHelper
{
    private static $key = "SEU_SECRET_KEY_AQUI"; // Substitua por uma chave segura

    public static function generateToken($user)
    {
        $payload = [
            'iat' => time(), // Data de emissão
            'exp' => time() + 3600, // Expira em 1 hora
            'uid' => $user['id'],
            'email' => $user['email']
        ];

        return JWT::encode($payload, self::$key, 'HS256');
    }

    public static function validateToken($token)
    {
        try {
            return JWT::decode($token, new Key(self::$key, 'HS256'));
        } catch (\Exception $e) {
            return false;
        }
    }

    public static function getTokenFromHeader()
    {
        $authHeader = service('request')->getHeaderLine('Authorization');
        if (!$authHeader || !preg_match('/Bearer\s(\S+)/', $authHeader, $matches)) {
            return null;
        }
        return $matches[1];
    }
}

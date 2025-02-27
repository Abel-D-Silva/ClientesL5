<?php

namespace App\Filters;

use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use CodeIgniter\Filters\FilterInterface;
use App\Helpers\JwtHelper;
use Exception;

class JwtFilter implements FilterInterface
{
    public function before(RequestInterface $request, $arguments = null)
    {
        $token = $request->getHeaderLine('Authorization');

        if (!$token || !preg_match('/Bearer\s(\S+)/', $token, $matches)) {
            return service('response')->setJSON([
                "cabecalho" => [
                    "status" => 401,
                    "mensagem" => "Token JWT não encontrado na requisição."
                ],
                "retorno" => []
            ])->setStatusCode(401);
        }

        try {
            $decoded = JwtHelper::validateToken($matches[1]);
            if (!$decoded) {
                return service('response')->setJSON([
                    "cabecalho" => [
                        "status" => 401,
                        "mensagem" => "Token inválido ou expirado."
                    ],
                    "retorno" => []
                ])->setStatusCode(401);
            }
        } catch (Exception $e) {
            return service('response')->setJSON([
                "cabecalho" => [
                    "status" => 401,
                    "mensagem" => "Erro ao validar o token: " . $e->getMessage()
                ],
                "retorno" => []
            ])->setStatusCode(401);
        }
    }

    public function after(RequestInterface $request, ResponseInterface $response, $arguments = null)
    {
        // Nenhuma ação necessária após a requisição
    }
}

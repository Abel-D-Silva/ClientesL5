<?php

namespace App\Controllers;

use CodeIgniter\RESTful\ResourceController;
use App\Models\UsuariosModel;
use App\Helpers\JwtHelper;

class AuthController extends ResourceController
{
    public function login()
    {
        $requestData = $this->request->getJSON(true);

        // Verifica se o campo "parametros" está presente
        if (!isset($requestData['parametros'])) {
            return $this->respond([
                "cabecalho" => [
                    "status" => 400,
                    "mensagem" => "O campo 'parametros' é obrigatório na requisição."
                ],
                "retorno" => []
            ], 400);
        }

        $data = $requestData['parametros'];

        // Verifica se os campos foram enviados
        if (!isset($data['email']) || !isset($data['password'])) {
            return $this->respond([
                "cabecalho" => [
                    "status" => 400,
                    "mensagem" => "E-mail e senha são obrigatórios."
                ],
                "retorno" => []
            ], 400);
        }

        $model = new UsuariosModel();
        $user = $model->where('email', $data['email'])->first();

        // Verifica se o usuário foi encontrado
        if (!$user) {
            return $this->respond([
                "cabecalho" => [
                    "status" => 401,
                    "mensagem" => "Usuário não encontrado no banco."
                ],
                "retorno" => []
            ], 401);
        }

        // Verifica a senha
        if (!password_verify($data['password'], $user['password'])) {
            return $this->respond([
                "cabecalho" => [
                    "status" => 401,
                    "mensagem" => "Senha incorreta."
                ],
                "retorno" => []
            ], 401);
        }

        // Gera um token JWT
        $token = JwtHelper::generateToken($user);

        return $this->respond([
            "cabecalho" => [
                "status" => 200,
                "mensagem" => "Login realizado com sucesso"
            ],
            "retorno" => [
                "token" => $token
            ]
        ], 200);
    }
}

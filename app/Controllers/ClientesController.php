<?php

namespace App\Controllers;

use CodeIgniter\RESTful\ResourceController;
use App\Models\ClientesModel;

class ClientesController extends ResourceController
{
    protected $modelName = 'App\Models\ClientesModel';
    protected $format    = 'json';

    // GET /clientes
    public function index()
    {
        $clientes = $this->model->findAll();

        return $this->respond([
            "cabecalho" => [
                "status" => 200,
                "mensagem" => "Lista de clientes retornada com sucesso"
            ],
            "retorno" => $clientes
        ], 200);
    }

    public function show($id = null)
    {
        // Busca o cliente pelo ID
        $cliente = $this->model->find($id);

        // Se o cliente não for encontrado, retorna erro 404
        if (!$cliente) {
            return $this->respond([
                "cabecalho" => [
                    "status" => 404,
                    "mensagem" => "Cliente não encontrado."
                ],
                "retorno" => []
            ], 404);
        }

        // Retorna os dados do cliente com status 200
        return $this->respond([
            "cabecalho" => [
                "status" => 200,
                "mensagem" => "Cliente encontrado com sucesso."
            ],
            "retorno" => $cliente
        ], 200);
    }

    // POST /clientes
    public function create()
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

        if (!$this->model->insert($data)) {
            return $this->respond([
                "cabecalho" => [
                    "status" => 400,
                    "mensagem" => "Erro ao cadastrar cliente."
                ],
                "retorno" => $this->model->errors()
            ], 400);
        }

        return $this->respond([
            "cabecalho" => [
                "status" => 201,
                "mensagem" => "Cliente cadastrado com sucesso"
            ],
            "retorno" => [
                "id_cliente" => $this->model->insertID()
            ]
        ], 201);
    }
}

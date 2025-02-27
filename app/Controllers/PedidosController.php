<?php

namespace App\Controllers;

use CodeIgniter\RESTful\ResourceController;
use App\Models\PedidosModel;

class PedidosController extends ResourceController
{
    protected $modelName = 'App\Models\PedidosModel';
    protected $format    = 'json';

    // GET /pedidos
    public function index()
    {
        $pedidos = $this->model->findAll();

        return $this->respond([
            "cabecalho" => [
                "status" => 200,
                "mensagem" => "Lista de pedidos retornada com sucesso"
            ],
            "retorno" => $pedidos
        ], 200);
    }

    public function show($id = null)
    {
        $pedido = $this->model->find($id);

        if (!$pedido) {
            return $this->failNotFound("Pedido não encontrado.");
        }

        return $this->respond([
            "cabecalho" => [
                "status" => 200,
                "mensagem" => "Pedido retornado com sucesso."
            ],
            "retorno" => $pedido
        ]);
    }


    // POST /pedidos
    public function create()
    {
        $requestData = $this->request->getJSON(true);

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
                    "mensagem" => "Erro ao cadastrar pedido."
                ],
                "retorno" => $this->model->errors()
            ], 400);
        }

        return $this->respond([
            "cabecalho" => [
                "status" => 201,
                "mensagem" => "Pedido cadastrado com sucesso"
            ],
            "retorno" => [
                "id_pedido" => $this->model->insertID()
            ]
        ], 201);
    }
}

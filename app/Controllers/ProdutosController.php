<?php

namespace App\Controllers;

use CodeIgniter\RESTful\ResourceController;
use App\Models\ProdutosModel;

class ProdutosController extends ResourceController
{
    protected $modelName = 'App\Models\ProdutosModel';
    protected $format    = 'json';

    // GET /produtos
    public function index()
    {
        $produtos = $this->model->findAll();

        return $this->respond([
            "cabecalho" => [
                "status" => 200,
                "mensagem" => "Lista de produtos retornada com sucesso"
            ],
            "retorno" => $produtos
        ], 200);
    }

    // GET /produtos/{id}
    public function show($id = null)
    {
        $produto = $this->model->find($id);

        if (!$produto) {
            return $this->respond([
                "cabecalho" => [
                    "status" => 404,
                    "mensagem" => "Produto não encontrado"
                ],
                "retorno" => []
            ], 404);
        }

        return $this->respond([
            "cabecalho" => [
                "status" => 200,
                "mensagem" => "Produto encontrado com sucesso"
            ],
            "retorno" => $produto
        ], 200);
    }

    // POST /produtos
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
                    "mensagem" => "Erro ao cadastrar produto."
                ],
                "retorno" => $this->model->errors()
            ], 400);
        }

        return $this->respond([
            "cabecalho" => [
                "status" => 201,
                "mensagem" => "Produto cadastrado com sucesso"
            ],
            "retorno" => [
                "id_produto" => $this->model->insertID()
            ]
        ], 201);
    }
}

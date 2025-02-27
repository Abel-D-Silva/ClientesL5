<?php

namespace App\Models;

use CodeIgniter\Model;

class PedidosModel extends Model
{
    protected $table            = 'pedidos';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = ['cliente_id', 'produto_id', 'quantidade', 'status', 'created_at', 'updated_at'];

    protected bool $allowEmptyInserts = false;

    // Dates
    protected $useTimestamps = true;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';

    // Validações
    protected $validationRules = [
        'cliente_id' => 'required|integer',
        'produto_id' => 'required|integer',
        'quantidade' => 'required|integer|greater_than[0]',
        'status'     => 'required|in_list[Em Aberto,Pago,Cancelado]'
    ];

    protected $validationMessages = [
        'cliente_id' => [
            'required' => 'O campo Cliente é obrigatório.',
            'integer'  => 'O Cliente deve ser um número válido.'
        ],
        'produto_id' => [
            'required' => 'O campo Produto é obrigatório.',
            'integer'  => 'O Produto deve ser um número válido.'
        ],
        'quantidade' => [
            'required' => 'A Quantidade é obrigatória.',
            'integer'  => 'A Quantidade deve ser um número inteiro.',
            'greater_than' => 'A Quantidade deve ser maior que zero.'
        ],
        'status' => [
            'required' => 'O campo Status é obrigatório.',
            'in_list'  => 'O Status deve ser "Em Aberto", "Pago" ou "Cancelado".'
        ]
    ];

    protected $skipValidation = false;

    // Callbacks
    protected $allowCallbacks = true;

    public function clienteExiste($id)
    {
        return (bool) $this->db->table('clientes')->where('id', $id)->countAllResults();
    }

    public function produtoExiste($id)
    {
        return (bool) $this->db->table('produtos')->where('id', $id)->countAllResults();
    }
}

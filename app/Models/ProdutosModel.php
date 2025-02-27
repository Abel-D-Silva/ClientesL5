<?php

namespace App\Models;

use CodeIgniter\Model;

class ProdutosModel extends Model
{
    protected $table            = 'produtos';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = ['nome', 'descricao', 'preco', 'created_at', 'updated_at'];

    protected bool $allowEmptyInserts = false;

    // Dates
    protected $useTimestamps = true;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';

    // Validation
    protected $validationRules = [
        'nome'       => 'required|min_length[3]|max_length[100]',
        'descricao'  => 'permit_empty|string',
        'preco'      => 'required|decimal|greater_than[0]',
    ];

    protected $validationMessages = [
        'nome' => [
            'required'    => 'O campo Nome é obrigatório.',
            'min_length'  => 'O Nome deve ter pelo menos 3 caracteres.',
            'max_length'  => 'O Nome deve ter no máximo 100 caracteres.'
        ],
        'preco' => [
            'required'    => 'O campo Preço é obrigatório.',
            'decimal'     => 'O Preço deve estar em um formato válido (ex: 99.99).',
            'greater_than' => 'O Preço deve ser maior que zero.'
        ]
    ];

    protected $skipValidation = false;
    protected $cleanValidationRules = true;

    // Callbacks
    protected $allowCallbacks = true;
}

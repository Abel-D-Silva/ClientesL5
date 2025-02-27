<?php

namespace App\Models;

use CodeIgniter\Model;

class ClientesModel extends Model
{
    protected $table            = 'clientes';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;


    protected $allowedFields    = ['nome', 'cpf', 'created_at', 'updated_at'];

    protected bool $allowEmptyInserts = false; // Impede inserções vazias

    // Dates
    protected $useTimestamps = true;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';

    // Validações 
    protected $validationRules      = [
        'nome' => 'required|min_length[3]|max_length[50]',
        'cpf'  => 'required|exact_length[11]|is_unique[clientes.cpf]'
    ];
    protected $validationMessages   = [
        'cpf' => [
            'is_unique' => 'Este CPF já está cadastrado.'
        ]
    ];
    protected $skipValidation       = false;

    // Callbacks 
    protected $allowCallbacks = true;
}

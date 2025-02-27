<?php

namespace App\Models;

use CodeIgniter\Model;

class UsuariosModel extends Model
{
    protected $table            = 'usuarios';  // Nome da tabela no banco de dados
    protected $primaryKey       = 'id';  // Chave primária

    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;

    protected $allowedFields    = ['nome', 'email', 'password', 'created_at', 'updated_at'];

    // Datas
    protected $useTimestamps = true;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';

    // Validações
    protected $validationRules = [
        'nome'     => 'required|min_length[3]|max_length[100]',
        'email'    => 'required|valid_email|is_unique[usuarios.email]',
        'password' => 'required|min_length[6]'
    ];

    protected $validationMessages = [
        'nome' => [
            'required'   => 'O campo Nome é obrigatório.',
            'min_length' => 'O Nome deve ter pelo menos 3 caracteres.',
            'max_length' => 'O Nome deve ter no máximo 100 caracteres.'
        ],
        'email' => [
            'required'    => 'O campo E-mail é obrigatório.',
            'valid_email' => 'O E-mail deve ser válido.',
            'is_unique'   => 'Este e-mail já está cadastrado.'
        ],
        'password' => [
            'required'   => 'O campo Senha é obrigatório.',
            'min_length' => 'A Senha deve ter pelo menos 6 caracteres.'
        ]
    ];

    protected $skipValidation = false;
}

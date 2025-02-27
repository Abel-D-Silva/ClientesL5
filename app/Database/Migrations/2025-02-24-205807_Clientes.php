<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Clientes extends Migration
{
    public function up()
    {
        // Criando as colunas da tabela 'clientes'
        $this->forge->addField([
            'id' => [
                'type'           => 'INT',
                'auto_increment' => true,
                'unsigned'       => true
            ],
            'nome' => [
                'type'       => 'VARCHAR',
                'constraint' => 50,
                'null'       => false
            ],
            'cpf' => [
                'type'       => 'VARCHAR',
                'constraint' => 11,
                'null'       => false,
                'unique'     => true //evitar cpf iguais 
            ],
            'created_at' => [
                'type'    => 'DATETIME',
                'null'    => true
            ],
            'updated_at' => [
                'type'    => 'DATETIME',
                'null'    => true
            ]
        ]);

        //Chave primária
        $this->forge->addPrimaryKey('id');

        // Criar a tabela no banco de dados
        $this->forge->createTable('clientes');
    }

    public function down()
    {

        $this->forge->dropTable('clientes');
    }
}

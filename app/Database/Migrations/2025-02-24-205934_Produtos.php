<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Produtos extends Migration
{
    public function up()
    {
        // Criando as colunas da tabela 'produtos'
        $this->forge->addField([
            'id' => [
                'type'           => 'INT',
                'auto_increment' => true,
                'unsigned'       => true
            ],
            'nome' => [
                'type'       => 'VARCHAR',
                'constraint' => 100,
                'null'       => false
            ],
            'descricao' => [
                'type' => 'TEXT',
                'null' => true
            ],
            'preco' => [
                'type'       => 'DECIMAL',
                'constraint' => '10,2', // Permitindo valores como '99999999.99'
                'null'       => false
            ],
            'created_at' => [
                'type' => 'DATETIME',
                'null' => true
            ],
            'updated_at' => [
                'type' => 'DATETIME',
                'null' => true
            ]
        ]);

        //chave primária
        $this->forge->addPrimaryKey('id');

        // Criar a tabela no banco de dados
        $this->forge->createTable('produtos');
    }

    public function down()
    {

        $this->forge->dropTable('produtos');
    }
}

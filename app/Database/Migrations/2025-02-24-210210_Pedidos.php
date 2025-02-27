<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Pedidos extends Migration
{
    public function up()
    {
        // Criando as colunas da tabela 'pedidos'
        $this->forge->addField([
            'id' => [
                'type'           => 'INT',
                'auto_increment' => true,
                'unsigned'       => true
            ],
            'cliente_id' => [
                'type'       => 'INT',
                'unsigned'   => true,
                'null'       => false
            ],
            'produto_id' => [
                'type'       => 'INT',
                'unsigned'   => true,
                'null'       => false
            ],
            'quantidade' => [
                'type'       => 'INT',
                'null'       => false
            ],
            'status' => [
                'type'       => 'ENUM',
                'constraint' => ['Em Aberto', 'Pago', 'Cancelado'],
                'default'    => 'Em Aberto'
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

        //Chave primária
        $this->forge->addPrimaryKey('id');

        //Chaves estrangeiras para relacionamento
        $this->forge->addForeignKey('cliente_id', 'clientes', 'id', 'CASCADE', 'CASCADE');
        $this->forge->addForeignKey('produto_id', 'produtos', 'id', 'CASCADE', 'CASCADE');

        // Criar a tabela no banco de dados
        $this->forge->createTable('pedidos');
    }

    public function down()
    {

        $this->forge->dropTable('pedidos');
    }
}

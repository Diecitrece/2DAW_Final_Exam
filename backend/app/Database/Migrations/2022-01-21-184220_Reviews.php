<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Reviews extends Migration
{
    public function up()
    {
        $this->db->disableForeignKeyChecks();
        $this->forge->addField([
            'id' => [
                'type'           => 'INT',
                'constraint'     => 5,
                'unsigned'       => true,
                'auto_increment' => true,
            ],
            'description' => [
                'type'          => 'VARCHAR',
                'constraint'    => '500',
            ],
            'punctuation' => [
                'type'          => 'DECIMAL',
                'constraint'    => '10,2',
            ],
            'email' => [
                'type'      => 'VARCHAR',
                'constraint'=> '255'
            ],
            'created_at' => [
                'type' => 'DATETIME',
                'null' => false,
            ],
            'updated_at' => [
                'type' => 'DATETIME',
                'null' => true
            ],
            'deleted_at' => [
                'type' => 'DATETIME',
                'null' => true
            ],
            'restaurant_id' => [
                'type'           => 'INT',
                'constraint'     => 5,
                'unsigned'       => true,
                'null' => true,
            ]
        ]);
        $this->forge->addKey('id', true);
        $this->forge->addForeignKey('restaurant_id', 'restaurants', 'id', 'CASCADE', 'SET NULL');
        $this->forge->createTable('reviews');

        $this->db->enableForeignKeyChecks();
    }

    public function down()
    {
        $this->forge->dropTable('reviews');
    }
}

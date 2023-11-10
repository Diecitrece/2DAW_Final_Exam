<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Videos extends Migration
{
    public function up()
    {
        // $this->db->disableForeignKeyChecks();
        $this->forge->addField([
            'id' => [
                'type'           => 'INT',
                'constraint'     => 5,
                'unsigned'       => true,
                'auto_increment' => true,
            ],
            'title' => [
                'type'       => 'VARCHAR',
                'constraint' => '255',
            ],
            'description' => [
                'type'       => 'VARCHAR',
                'constraint' => '500',
            ],
            'pubDate' => [
                'type'      => 'DATETIME',
                'null'      => false,
            ],
            'url' => [
                'type'      => 'VARCHAR',
                'constraint'=> '255'
            ],
            'guid' => [
                'type'           => 'INT',
                'constraint'     => 5,
            ],
            'img' => [
                'type'          => 'VARCHAR',
                'constraint'    => '500'
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
            ]
        ]);
        $this->forge->addKey('id', true);
        // $this->forge->addForeignKey('category_id', 'categories', 'id', 'CASCADE', 'SET NULL');
        $this->forge->createTable('videos');

        // $this->db->enableForeignKeyChecks();
    }

    public function down()
    {
        $this->forge->dropTable('videos');
    }
}

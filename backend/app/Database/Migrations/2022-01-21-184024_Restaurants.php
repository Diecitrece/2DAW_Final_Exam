<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Restaurants extends Migration
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
            'name' => [
                'type'       => 'VARCHAR',
                'constraint' => '255',
            ],
            'description' => [
                'type'      => 'VARCHAR',
                'constraint'=> '500',
            ],
            'address' => [
                'type'      => 'VARCHAR',
                'constraint'=> '255'
            ],
            'latitude' => [
                'type'      => 'DECIMAL',
                'constraint'=> '10,2'
            ],
            'longitude' => [
                'type'      => 'DECIMAL',
                'constraint'=> '10,2'
            ],
            'reviewAverage' => [
                'type'      => 'DECIMAL',
                'constraint'=> '10,2'
            ],
            'numReviews' => [
                'type'      => 'INT',
                'constraint'=> 10
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
        $this->forge->createTable('restaurants');

        // $this->db->enableForeignKeyChecks();
    }

    public function down()
    {
        $this->forge->dropTable('restaurants');
    }
}

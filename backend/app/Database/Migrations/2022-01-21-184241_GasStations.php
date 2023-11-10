<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class GasStations extends Migration
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
            'label' => [
                'type'       => 'VARCHAR',
                'constraint' => '255',
            ],
            'address' => [
                'type'      => 'VARCHAR',
                'constraint'=> '255'
            ],
            'latitude' => [
                'type'      => 'DECIMAL',
                'constraint'=> '10,10'
            ],
            'longitude' => [
                'type'      => 'DECIMAL',
                'constraint'=> '10,10'
            ],
            'ideess' => [
                'type'           => 'INT',
                'constraint'     => 5,
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
        $this->forge->createTable('gas_stations');

        // $this->db->enableForeignKeyChecks();
    }

    public function down()
    {
        $this->forge->dropTable('gas_stations');
    }
}

<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;
use CodeIgniter\I18n\Time;
use Faker\Factory;

class Roles extends Seeder
{
    public function run()
    {
        $this->db->table('roles')->where("id > " ,0)->delete();
        $this->db->query("ALTER TABLE roles AUTO_INCREMENT = 1");

        $faker = Factory::create();
        
        $Builder = $this->db->table('roles');

        $roles = [
            [
                'name' => 'administrador',
                "created_at" => new Time('now'),
            ],
        ];
        $Builder -> insertBatch($roles);
    }
}

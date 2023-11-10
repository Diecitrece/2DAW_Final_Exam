<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;
use CodeIgniter\I18n\Time;
use Faker\Factory;

class Users extends Seeder
{
    public function run()
    {
        $this->db->table('users')->where("id > " ,0)->delete();
        $this->db->query("ALTER TABLE users AUTO_INCREMENT = 1");

        $faker = Factory::create();
        
        $Builder = $this->db->table('users');

        $users = [
            [
                "username" => 'root',
                "email" => $faker->email,
                "password" => password_hash("1234", PASSWORD_DEFAULT),
                "name" => $faker->name,
                "surname" => $faker->name,
                "created_at" => new Time('now'),
                "role_id" => 1
            ],
        ];
        $Builder -> insertBatch($users);
    }
}

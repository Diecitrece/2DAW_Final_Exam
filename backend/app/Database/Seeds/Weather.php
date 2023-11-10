<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;
use CodeIgniter\I18n\Time;
use Faker\Factory;

class Weather extends Seeder
{
    public function run()
    {
        $this->db->table('weather')->where("id > " ,0)->delete();
        $this->db->query("ALTER TABLE weather AUTO_INCREMENT = 1");

        $faker = Factory::create();
        
        $Builder = $this->db->table('weather');

        $weather = [
            [
                'main' => 'prueba',
                'description' => 'prueba',
                "created_at" => new Time('now'),
            ],
        ];
        $Builder -> insertBatch($weather);
    }
}

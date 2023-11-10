<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;
use CodeIgniter\I18n\Time;
use Faker\Factory;

class Reviews extends Seeder
{
    public function run()
    {
        $this->db->table('reviews')->where("id > " ,0)->delete();
        $this->db->query("ALTER TABLE reviews AUTO_INCREMENT = 1");

        $faker = Factory::create();
        
        $Builder = $this->db->table('reviews');

        $reviews = [
            [
                'description' => 'prueba',
                'punctuation' => '5',
                'email' => 'prueba@gmail.com',
                "created_at" => new Time('now'),
                'restaurant_id' => 1
            ],
        ];
        $Builder -> insertBatch($reviews);
    }
}

<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;
use CodeIgniter\I18n\Time;
use Faker\Factory;

class Restaurants extends Seeder
{
    public function run()
    {
        $this->db->table('restaurants')->where("id > " ,0)->delete();
        $this->db->query("ALTER TABLE restaurants AUTO_INCREMENT = 1");

        $faker = Factory::create();
        
        $Builder = $this->db->table('restaurants');

        $restaurants = [
            [
                'name' => 'Temprado19',
                'description' => 'Comida mediterránea, española y saludable',
                'address' => 'Calle Temprado No 19, 12002, Castellón de la Plana España',
                'latitude' => 39.98347577392107,
                'longitude' => -0.03689445867882332,
                'reviewAverage' => 0,
                'numReviews' => 0,
                "created_at" => new Time('now'),
            ],
            [
                'name' => 'Izakaya Tasca Japonesa',
                'description' => 'Comida japonesa, asiática, saludable',
                'address' => 'Calle Temprado 2, 12002, Castellón de la Plana España',
                'latitude' => 39.98397273136151,
                'longitude' => -0.03693564703077509,
                'reviewAverage' => 0,
                'numReviews' => 0,
                "created_at" => new Time('now'),
            ]
        ];
        $Builder -> insertBatch($restaurants);
    }
}

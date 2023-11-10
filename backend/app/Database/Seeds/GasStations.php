<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;
use Faker\Factory;
use CodeIgniter\I18n\Time;

class GasStations extends Seeder
{
    public function run()
    {
        $this->db->table('gas_stations')->where("id > " ,0)->delete();
        $this->db->query("ALTER TABLE gas_stations AUTO_INCREMENT = 1");

        $faker = Factory::create();
        
        $Builder = $this->db->table('gas_stations');

        $gas_stations = [
            [
                'label'     => 'Gasolinera',
                'address'   => $faker->city,
                'latitude'  => 2.00,
                'longitude' => 2.00,
                'ideess' => 13547,
                "created_at" => new Time('now'),
            ],
            [
                'label'     => 'Gasolinera Huevos',
                'address'   => $faker->city,
                'latitude'  => 2.00,
                'longitude' => 2.00,
                'ideess' => 13548,
                "created_at" => new Time('now'),
            ],
        ];
        $Builder -> insertBatch($gas_stations);

    }
}

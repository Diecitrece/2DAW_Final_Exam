<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class AllSeeder extends Seeder
{
    public function run()
    {
        $this->call('GasStations');
        $this->call('News');
        $this->call('Restaurants');
        $this->call('Reviews');
        $this->call('Roles');
        $this->call('Users');
        $this->call('Videos');
        $this->call('Weather');
    }
}

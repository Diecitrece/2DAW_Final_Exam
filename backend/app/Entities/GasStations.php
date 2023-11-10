<?php

namespace App\Entities;

use CodeIgniter\Entity\Entity;

class GasStations extends Entity
{
    protected $attributes = 
    [
        'id' => null,
        'label' => null,
        'address' => null,
        'latitude' => null,
        'longitude' => null,
        'ideess' => null,
    ];

    protected $datamap = [];
    protected $dates   = ['created_at', 'updated_at', 'deleted_at'];
    protected $casts   = [];
}

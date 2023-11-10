<?php

namespace App\Entities;

use CodeIgniter\Entity\Entity;

class Weather extends Entity
{
    protected $attributes = 
    [
        'id' => null,
        'main' => null,
        'description' => null,
        'icon' => null,
    ];

    protected $datamap = [];
    protected $dates   = ['created_at', 'updated_at', 'deleted_at'];
    protected $casts   = [];
}

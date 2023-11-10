<?php

namespace App\Entities;

use CodeIgniter\Entity\Entity;

class Restaurants extends Entity
{
    protected $attributes = 
    [
        'id' => null,
        'name' => null,
        'description' => null,
        'address' => null,
        'latitude' => null,
        'longitude' => null,
        'reviewAverage' => null,
        'numReviews' => null,
    ];

    protected $datamap = [];
    protected $dates   = ['created_at', 'updated_at', 'deleted_at'];
    protected $casts   = [];
}

<?php

namespace App\Entities;

use CodeIgniter\Entity\Entity;

class Reviews extends Entity
{
    protected $attributes = 
    [
        'id' => null,
        'description' => null,
        'punctuation' => null,
        'email' => null,
        'restaurant_id' => null,
    ];

    protected $datamap = [];
    protected $dates   = ['created_at', 'updated_at', 'deleted_at'];
    protected $casts   = [];
}

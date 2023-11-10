<?php

namespace App\Entities;

use CodeIgniter\Entity\Entity;

class News extends Entity
{
    protected $attributes = 
    [
        'id' => null,
        'title' => null,
        'description' => null,
        'pubDate' => null,
        'url' => null,
        'guid' => null, 
        'img' => null,
    ];

    protected $datamap = [];
    protected $dates   = ['created_at', 'updated_at', 'deleted_at'];
    protected $casts   = [];
}

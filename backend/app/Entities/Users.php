<?php

namespace App\Entities;

use CodeIgniter\Entity\Entity;

class Users extends Entity
{
    protected $attributes = 
    [
        'id' => null,
        'username' => null,
        'email' => null,
        'password' => null,
        'name' => null,
        'surname' => null,
        'role_id' => null,
    ];

    protected $datamap = [];
    protected $dates   = ['created_at', 'updated_at', 'deleted_at'];
    protected $casts   = [];
}

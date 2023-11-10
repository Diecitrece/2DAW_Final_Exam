<?php

namespace App\Models;

use App\Entities\Weather;
use CodeIgniter\Model;

class WeatherModel extends Model
{
    protected $table            = 'weather';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    
    protected $returnType       = Weather::class;
    
    protected $allowedFields    = ['main', 'description', 'icon'];

    protected $useSoftDeletes   = true;

    // Dates
    protected $useTimestamps = true;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'deleted_at';

    // Callbacks
    protected $allowCallbacks = true;
    protected $beforeInsert   = [];
    protected $afterInsert    = [];
    protected $beforeUpdate   = [];
    protected $afterUpdate    = [];
    protected $beforeFind     = [];
    protected $afterFind      = [];
    protected $beforeDelete   = [];
    protected $afterDelete    = [];

    public function findWeather()
    {
        return $this->findAll();
    }
    public function findRecentWeather()
    {
        return $this->orderBy('created_at', 'desc')->first();
    }
}

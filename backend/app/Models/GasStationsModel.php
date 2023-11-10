<?php

namespace App\Models;

use App\Entities\GasStations;
use CodeIgniter\Model;

class GasStationsModel extends Model
{
    protected $table            = 'gas_stations';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    
    protected $returnType       = GasStations::class;
    
    protected $allowedFields    = ['label', 'address', 'latitude', 'longitude', 'ideess'];

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

    public function findGasStations($id=null)
    {
        if (is_null($id))
        {
            return $this->findAll();
        }

        return $this->where(['id' => $id])->first();
    }
    public function findGasStationsByIDEESS($ideess)
    {
        return $this->where(['ideess' => $ideess])->first();
    }
}

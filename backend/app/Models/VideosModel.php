<?php

namespace App\Models;

use App\Entities\Videos;
use CodeIgniter\Model;

class VideosModel extends Model
{
    protected $table            = 'videos';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    
    protected $returnType       = Videos::class;
    
    protected $allowedFields    = ['title', 'description', 'pubDate', 'url', 'guid', 'img'];

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

    public function findVideos($id=null)
    {
        if (is_null($id))
        {
            return $this->findAll();
        }

        return $this->where(['id' => $id])->first();
    }
    public function findVideoByGUID($guid)
    {
        return $this->where(['guid' => $guid])->first();
    }
}

<?php

namespace App\Models;

use App\Entities\News;
use CodeIgniter\Model;

class NewsModel extends Model
{
    protected $table            = 'news';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    
    protected $returnType       = News::class;
    
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

    public function findNews($id=null)
    {
        if (is_null($id))
        {
            return $this->findAll();
        }

        return $this->where(['id' => $id])->first();
    }
    public function findNewsByGUID($guid)
    {
        return $this->where(['guid' => $guid])->first();
    }
}

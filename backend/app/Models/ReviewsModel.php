<?php

namespace App\Models;

use App\Entities\Reviews;
use CodeIgniter\Model;

class ReviewsModel extends Model
{
    protected $table            = 'reviews';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    
    protected $returnType       = Reviews::class;
    
    protected $allowedFields    = ['description', 'punctuation', 'email', 'restaurant_id'];

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

    public function findReview($id)
    {
        return $this->where(['id' => $id])->first();
    }
    public function findReviewsByRestaurant($idRestaurant)
    {
        return $this->where(['restaurant_id' => $idRestaurant])->orderBy('created_at', 'desc')->findAll();
    }
    public function findReviewsByRestaurantAndEmail($idRestaurant, $email)
    {
        return $this->where(['restaurant_id' => $idRestaurant, 'email' => $email])->orderBy('created_at', 'desc')->findAll();
    }
}

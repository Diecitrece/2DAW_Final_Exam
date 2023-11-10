<?php

namespace App\Models;

use App\Entities\Restaurants;
use CodeIgniter\Model;

class RestaurantsModel extends Model
{
    protected $table            = 'restaurants';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    
    protected $returnType       = Restaurants::class;
    
    protected $allowedFields    = ['name', 'description', 'address', 'latitude', 'longitude', 'reviewAverage', 'numReviews'];

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

    public function findRestaurants($id=null)
    {
        if (is_null($id))
        {
            return $this->findAll();
        }

        return $this->where(['id' => $id])->first();
    }


    
    public function updateReviewAverage($id)
    {
        $reviewsModel = new ReviewsModel();
        $reviews = $reviewsModel->findReviewsByRestaurant($id);
        $punctuations = [];
        foreach($reviews as $review)
        {
            array_push($punctuations, $review->punctuation);
        }
        $totalReviews = count($punctuations);
        $reviewAverage = array_sum($punctuations) / $totalReviews;
        $updatedRestaurant =  
            [
                "id" => $id,
                "reviewAverage" => $reviewAverage,
            ];
        $this->save($updatedRestaurant);
    }
    public function updateReviewNumber($id)
    {
        $reviewsModel = new ReviewsModel();
        $reviews = $reviewsModel->findReviewsByRestaurant($id);
        $updatedRestaurant =  
        [
            "id" => $id,
            "numReviews" => count($reviews),
        ];
        $this->save($updatedRestaurant);
        $this->updateReviewAverage($id);
    }
}

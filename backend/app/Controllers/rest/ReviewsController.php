<?php

namespace App\Controllers\Rest;

use App\Controllers\BaseController;
use App\Models\RestaurantsModel;
use CodeIgniter\RESTful\ResourceController;

class ReviewsController extends ResourceController
{
    protected $modelName = 'App\Models\ReviewsModel';
    protected $format = 'json';

    public function getReviews($id="")
    {
        try
        {
            if($id == "")
            {
                return $this->respond(null, 400, "No se ha especificado la reseña");
            }
            else
            {
                $review = $this->model->findReview($id);
                if ($review != null)
                {
                    return $this->respond($review);
                }
                else
                {
                    return $this->respond(null, 404, "No se ha encontrado la reseña especificada");
                }
            }
        }catch(\Exception $e)
        {
            return $this->respond($e->getMessage(), 500, "Error interno");
        }
    }
    public function getReviewsByRestaurant($idRestaurant="")
    {
        try
        {
            $restaurantsModel = new RestaurantsModel();
            if($idRestaurant == "")
            {
                return $this->respond(null, 400, "No se ha especificado el restaurante");
            }
            else
            {
                $restaurant = $restaurantsModel->findRestaurants($idRestaurant);
                if ($restaurant != null)
                {
                    $reviews = $this->model->findReviewsByRestaurant($idRestaurant);
                    return $this->respond($reviews);
                }
                else
                {
                    return $this->respond(null, 404, "No se ha encontrado el restaurante especificado");
                }
            }
        }catch(\Exception $e)
        {
            return $this->respond($e->getMessage(), 500, "Error interno");
        }
    }

    public function getReviewsByRestaurantAndEmail($idRestaurant="", $email="")
    {
        try
        {
            $restaurantsModel = new RestaurantsModel();
            if($idRestaurant == "")
            {
                return $this->respond(null, 400, "No se ha especificado el restaurante");
            }
            else if($email == "")
            {
                return $this->respond(null, 400, "No se ha especificado el email");
            }
            else
            {
                $restaurant = $restaurantsModel->findRestaurants($idRestaurant);
                if ($restaurant != null)
                {
                    $reviews = $this->model->findReviewsByRestaurantAndEmail($idRestaurant, $email);
                    return $this->respond($reviews);
                }
                else
                {
                    return $this->respond(null, 404, "No se ha encontrado el restaurante especificado");
                }
            }
        }catch(\Exception $e)
        {
            return $this->respond($e->getMessage(), 500, "Error interno");
        }
    }
    public function create_update_review()
    {
        try
        {
            $restaurantsModel = new RestaurantsModel();
            $request = $this->request;
            $data = $request->getJSON();
            if (!isset($data->restaurant_id) || !isset($data->email) || !isset($data->description) || !isset($data->punctuation))
            {
                return $this->respond(null, 400, "Los parámetros enviados no son correctos");
            }
            if (isset($data->review_id))
            {
                $id = $data->review_id;
                $reviewExists = $this->model->findReview($id);
                if($reviewExists)
                {
                    $review = 
                    [
                        'id' => $id,
                        'description' => $data->description,
                        'punctuation' => $data->punctuation,
                        'email' => $data->email,
                        'restaurant_id' => $data->restaurant_id   
                    ];
                }
                else
                {
                    return $this->respond(null, 404, "La reseña especificada no existe");
                }
            }
            else
            {
                $review = 
                    [
                        'description' => $data->description,
                        'punctuation' => $data->punctuation,
                        'email' => $data->email,
                        'restaurant_id' => $data->restaurant_id
                    ];
            }
            $this->model->save($review);
            $restaurantsModel->updateReviewNumber($data->restaurant_id);
            return $this->respond(null, 200, "Reseña guardada correctamente");
        }catch(\Exception $e)
        {
            return $this->respond($e->getMessage(), 500, "Todo mal");
        }
    }
    public function deleteReview($id="")
    {
        try
        {
            $restaurantsModel = new RestaurantsModel();
            if($id == "")
            {
                return $this->respond(null, 400, "No se ha especificado la reseña");
            }
            else
            {
                $review = $this->model->findReview($id);
                if ($review != null)
                {
                    $restaurant_id = $review->restaurant_id;
                    $this->model->delete($id);
                    $restaurantsModel->updateReviewNumber($restaurant_id);
                    return $this->respond(null, 200, "Reseña especificada eliminada con éxito");
                }
                else
                {
                    return $this->respond(null, 404, "No se ha encontrado la reseña especificada");
                }
            }
        }catch(\Exception $e)
        {
            return $this->respond($e->getMessage(), 500, "Error interno");
        }
    }
}

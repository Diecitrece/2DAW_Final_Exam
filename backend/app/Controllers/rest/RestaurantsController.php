<?php

namespace App\Controllers\Rest;

use App\Controllers\BaseController;
use CodeIgniter\RESTful\ResourceController;

class RestaurantsController extends ResourceController
{
    protected $modelName = 'App\Models\RestaurantsModel';
    protected $format = 'json';

    public function getRestaurants($id="")
    {
        try
        {
            if($id == "")
            {
                $restaurants = $this->model->findRestaurants();
                return $this->respond($restaurants);
            }
            else
            {
                $restaurant = $this->model->findRestaurants($id);
                if ($restaurant != null)
                {
                    return $this->respond($restaurant);
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
}

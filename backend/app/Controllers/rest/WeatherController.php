<?php

namespace App\Controllers\Rest;

use App\Controllers\BaseController;
use CodeIgniter\RESTful\ResourceController;

class WeatherController extends ResourceController
{
    protected $modelName = 'App\Models\WeatherModel';
    protected $format = 'json';

    public function getWeather()
    {
        try
        {
            $weather = $this->model->findWeather();
            if ($weather != null)
            {
                $weather = $this->model->findRecentWeather();   
                return $this->respond($weather);
            }
            else
            {
                return $this->respond(null, 404, "No hay registro del clima");
            }
        
        }catch(\Exception $e)
        {
            return $this->respond($e->getMessage(), 500, "Error interno");
        }
    }

}

<?php

namespace App\Controllers\Rest;

use App\Controllers\BaseController;
use CodeIgniter\RESTful\ResourceController;

class GasStationsController extends ResourceController
{
    protected $modelName = 'App\Models\GasStationsModel';
    protected $format = 'json';

    public function getGasStations($id="")
    {
        try
        {
            if($id == "")
            {
                $gas_stations = $this->model->findGasStations();
                return $this->respond($gas_stations);
            }
            else
            {
                $gas_station = $this->model->findGasStations($id);
                if ($gas_station != null)
                {
                    return $this->respond($gas_station);
                }
                else
                {
                    return $this->respond(null, 404, "No se ha encontrado la gasolinera especificada");
                }
            }
        }catch(\Exception $e)
        {
            return $this->respond($e->getMessage(), 500, "Error interno");
        }
    }
}

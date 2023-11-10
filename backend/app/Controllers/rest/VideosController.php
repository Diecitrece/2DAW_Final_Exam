<?php

namespace App\Controllers\Rest;

use App\Controllers\BaseController;
use CodeIgniter\RESTful\ResourceController;

class VideosController extends ResourceController
{
    protected $modelName = 'App\Models\VideosModel';
    protected $format = 'json';

    public function getVideos($id="")
    {
        try
        {
            if($id == "")
            {
                $videos = $this->model->findVideos();
                return $this->respond($videos);
            }
            else
            {
                $video = $this->model->findVideos($id);
                if ($video != null)
                {
                    return $this->respond($video);
                }
                else
                {
                    return $this->respond(null, 404, "No se ha encontrado el vídeo especificado");
                }
            }
        }catch(\Exception $e)
        {
            return $this->respond($e->getMessage(), 500, "Error interno");
        }
    }
}

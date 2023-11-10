<?php

namespace App\Controllers\Rest;

use App\Controllers\BaseController;
use CodeIgniter\RESTful\ResourceController;

class NewsController extends ResourceController
{
    protected $modelName = 'App\Models\NewsModel';
    protected $format = 'json';

    public function getNews($id="")
    {
        try
        {
            if($id == "")
            {
                $news = $this->model->findNews();
                return $this->respond($news);
            }
            else
            {
                $new = $this->model->findNews($id);
                if ($new != null)
                {
                    return $this->respond($new);
                }
                else
                {
                    return $this->respond(null, 404, "No se ha encontrado la noticia especificada");
                }
            }
        }catch(\Exception $e)
        {
            return $this->respond($e->getMessage(), 500, "Error interno");
        }
    }
}

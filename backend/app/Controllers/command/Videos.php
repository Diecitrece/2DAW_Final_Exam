<?php

namespace App\Controllers\Command;

use App\Controllers\BaseController;
use App\Models\VideosModel;
use CodeIgniter\CLI\CLI;
use DOMDocument;
use SimpleXMLElement;

class Videos extends BaseController
{
    public function loadVideos()
    {
        CLI::write('----- INICIO obtener Videos -----');
        $arrContextOptions = 
        [
            "ssl"=>
            [
                "verify_peer"=> false,
                "verify_peer_name"=> false
            ]
        ];
        CLI::write('Realizando petición...');
        $response = file_get_contents("https://www.youtube.com/feeds/videos.xml?channel_id=UCw1a58odDDr5k-iyGvq5LpA", false, stream_context_create($arrContextOptions));
        $response = str_replace("<media:group>","<mediaGroup>",$response);
        $response = str_replace("</media:group>","</mediaGroup>",$response);
        $response = str_replace("media:thumbnail","mediaThumbnail",$response);
        $response = str_replace("media:description","mediaDescription",$response);
        $data = new SimpleXmlElement($response);
        $items = $data->entry;

        $videosM = new VideosModel();

        $savedVideos = $videosM->findVideos();
        $savedGUID = [];
        foreach($savedVideos as $video)
        {
            array_push($savedGUID, strval($video->guid));
        }
        $img = "";
        $description = "none";
        foreach($items as $item)
        {
            $img = $item->mediaGroup->mediaThumbnail['url'];
            $description = $item->mediaGroup->mediaDescription;
            if($description=="")
            {
                $description = "none";
            }
            //format data
            
            $dataArray = explode("T", $item->published);
            $formatedDate = $dataArray[0];
            //now data is correctly formated

            if(in_array($item->id, $savedGUID))
            {
                $video = [
                    'id' => $videosM->findVideoByGUID($item->id),
                    'title' => $item->title,
                    'description' => $description,
                    'pubDate' => $formatedDate,
                    'url' => $item->link["href"],
                    'guid' => $item->id,
                    'img' => $img
                ];
            }
            else
            {
                $video = [
                    'title' => $item->title,
                    'description' => $description,
                    'pubDate' => $formatedDate,
                    'url' => $item->link["href"],
                    'guid' => $item->id,
                    'img' => $img
                ];
            }
            $videosM->save($video);
        }
        CLI::write('¡¡¡Petición realizada correctamente!!!');

        CLI::write('----- Fin del comando -----');
    }
}

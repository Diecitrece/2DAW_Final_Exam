<?php

namespace App\Controllers\Command;

use App\Controllers\BaseController;
use App\Models\NewsModel;
use CodeIgniter\CLI\CLI;
use DOMDocument;
use SimpleXMLElement;

class News extends BaseController
{
    public function loadNews()
    {
        CLI::write('----- INICIO obtener Noticias -----');
        $arrContextOptions = 
        [
            "ssl"=>
            [
                "verify_peer"=> false,
                "verify_peer_name"=> false
            ]
        ];
        CLI::write('Realizando petición...');
        $response = file_get_contents("https://www.elperiodic.com/feed/rss_castellon.xml", false, stream_context_create($arrContextOptions));
        $response = str_replace("<content:encoded>","<contentEncoded>",$response);
        $response = str_replace("</content:encoded>","</contentEncoded>",$response);
        $data = new SimpleXmlElement($response);
        $items = $data->channel->item;

        $newsM = new NewsModel();

        $savedNews = $newsM->findNews();
        $savedGUID = [];
        foreach($savedNews as $new)
        {
            array_push($savedGUID, strval($new->guid));
        }
        
        foreach($items as $item)
        {
            $dom = new DOMDocument();
            $dom->loadHTML($item->contentEncoded);
            $image = $dom->getElementsByTagName('img');
            $img = "";
            foreach($image as $i)
            {
                $img = $i->getAttribute('src');
            }

            //format data
            
            $dataArray = explode(" ", $item->pubDate);
            $day = $dataArray[1];
            $year = $dataArray[3];
            $month = $dataArray[2];
            $monthAbbList = [
                "Jan" => "01",
                "Feb" => "02",
                "Mar" => "03",
                "Apr" => "04",
                "May" => "05",
                "Jun" => "06",
                "Jul" => "07",
                "Aug" => "08",
                "Sep" => "09",
                "Sept" => "09",
                "Oct" => "10",
                "Nov" => "11" ,
                "Dec" => "12"
            ];
            foreach($monthAbbList as $monthKey => $monthValue)
            {
                if($month == $monthKey)
                {
                    $month = $monthValue;
                }
            }
            $formatedDate = $year."-".$month."-".$day;

            //now data is correctly formated

            if(in_array($item->link, $savedGUID))
            {
                $new = [
                    'id' => $newsM->findNewsByGUID($item->link),
                    'title' => $item->title,
                    'description' => $item->description,
                    'pubDate' => $formatedDate,
                    'url' => $item->link,
                    'guid' => $item->link,
                    'img' => $img
                ];
            }
            else
            {
                $new = [
                    'title' => $item->title,
                    'description' => $item->description,
                    'pubDate' => $formatedDate,
                    'url' => $item->link,
                    'guid' => $item->link,
                    'img' => $img
                ];
            }
            $newsM->save($new);
        }
        CLI::write('¡¡¡Petición realizada correctamente!!!');

        CLI::write('----- Fin del comando -----');
    }
}

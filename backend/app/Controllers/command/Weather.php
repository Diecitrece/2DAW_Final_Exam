<?php

namespace App\Controllers\Command;

use App\Controllers\BaseController;
use App\Models\WeatherModel;
use CodeIgniter\CLI\CLI;
use SimpleXMLElement;

class Weather extends BaseController
{
    public function loadWeather()
    {
        CLI::write('----- INICIO obtener clima -----');
        $client = service("curlrequest");
        CLI::write('Realizando petición...');

        $weatherM = new WeatherModel();

        $response = $client->request('GET', 'https://api.openweathermap.org/data/2.5/weather?zip=12001,es&appid=putyouropenweatherkeyhere', []);
        $response->getStatusCode();
        $body = $response->getBody();
        $body = json_decode($body, true);
        $weather = [
            "main" => $body['weather']['0']['main'],
            "description" => $body['weather']['0']['description'],
            "icon" => $body['weather']['0']['icon']
        ];
        $weatherM->save($weather);
        CLI::write('¡¡¡Petición realizada correctamente!!!');
        CLI::write('Información guardada:');
        CLI::write('Estado: ' . $weather["main"]);
        CLI::write('Descripción: ' . $weather["description"]);
        //http://openweathermap.org/img/wn/"+ icon +"@4x.png
    }
}

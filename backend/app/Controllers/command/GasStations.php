<?php

namespace App\Controllers\Command;

use App\Controllers\BaseController;
use App\Models\GasStationsModel;
use CodeIgniter\CLI\CLI;
use SimpleXMLElement;

class GasStations extends BaseController
{
    public function loadGasStations()
    {
        CLI::write('----- INICIO obtener gasolineras -----');
        $client = service("curlrequest");
        CLI::write('Realizando petición...');

        $gasM = new GasStationsModel();

        $savedStations = $gasM->findGasStations();
        $savedIDEESS = [];
        foreach($savedStations as $station)
        {
            array_push($savedIDEESS, strval($station->ideess));
        }

        $response = $client->request('GET', 'https://sedeaplicaciones.minetur.gob.es/ServiciosRESTCarburantes/PreciosCarburantes/EstacionesTerrestres/', []);
        $response->getStatusCode();
        $body = $response->getBody();
        $body = json_decode($body, true);
               
        $newCounter = 0;
        $editCounter = 0;
        foreach($body["ListaEESSPrecio"] as $gasStation)
        {
            if(strcmp($gasStation["Localidad"], "CASTELLON DE LA PLANA") == 0)
            {

                if(in_array($gasStation["IDEESS"], $savedIDEESS))
                {
                    $gasolinera = [
                        "id" => $gasM->findGasStationsByIDEESS($gasStation["IDEESS"])->id,
                        "ideess" => $gasStation["IDEESS"],
                        "label" => $gasStation["Rótulo"],
                        "address" => $gasStation["Dirección"],
                        "latitude" => $gasStation["Latitud"],
                        "longitude" => $gasStation["Longitud (WGS84)"],
                    ];
                    $editCounter++;
                }
                else
                {
                    $gasolinera = [
                        "ideess" => $gasStation["IDEESS"],
                        "label" => $gasStation["Rótulo"],
                        "address" => $gasStation["Dirección"],
                        "latitude" => $gasStation["Latitud"],
                        "longitude" => $gasStation["Longitud (WGS84)"],
                    ];
                    $newCounter++;
                }
                $gasM->save($gasolinera);
            }
        }

        CLI::write('¡¡¡Petición realizada correctamente!!!');
        CLI::write('Gasolineras nuevas añadidas: ' . $newCounter);
        CLI::write('Gasolineras actualizadas: ' . $editCounter);

        CLI::write('----- Fin del comando -----');
    }
}

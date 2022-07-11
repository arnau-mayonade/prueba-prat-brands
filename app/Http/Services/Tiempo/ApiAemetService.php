<?php

namespace App\Http\Services\Tiempo;

use App\Models\Municipios;
use GuzzleHttp\Client;

class ApiAemetService
{
    public function getPrediccionDiariaPorMunicipio(Municipios $municipio): array
    {
        $codigoIne = $municipio->id_provincia . str_pad($municipio->cod_municipio,3,"0",STR_PAD_LEFT);
        $client = new Client(); 
        try {
            $respuestaApi = $client->request('GET', env('API_AEMET').'/prediccion/especifica/municipio/diaria/'.$codigoIne, [
                'headers' => [
                    'api_key' => env('API_KEY')
                    ]
                ]
            );
            $respuestaJson = json_decode($respuestaApi->getBody()->getContents(), true);
            if($respuestaJson['estado'] !== 200){
                return ['error' => 'Error en la peticion'];
            }
            return $respuestaJson;
        } catch (\Exception $e) {
            return $e;
        }
    }

    public function getDatos(string $url): array
    {
        try{
            $client = new Client();
            $respuestaApi = $client->request('GET', $url);
            $respuestaJson = json_decode( preg_replace('/[\x00-\x1F\x80-\xFF]/', '', $respuestaApi->getBody()->getContents()), true);
            $respuestaJson  = array_shift($respuestaJson);
            return $respuestaJson;
        } catch (\Exception $e) {
            return $e;
        }
        
    }
}
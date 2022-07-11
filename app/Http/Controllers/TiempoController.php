<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;

use GuzzleHttp\Client;
use App\Models\Municipios;
use App\Http\Services\Tiempo\ApiAemetService;

class TiempoController extends Controller
{
    public function index(){
        return view('tiempo/index');
    }

    public function getTiempoAemet(Request $request, ApiAemetService $aemetService):JsonResponse
    {
        $request->validate([
            'municipio'=> 'required'
        ]);

        $data = $request->all();
        
        $municipio = Municipios::where('nombre', $data['municipio'])->first();
        if($municipio instanceof Municipios){
            $respuestaPrediccion = $aemetService->getPrediccionDiariaPorMunicipio($municipio);
            $respuestaDatos = $aemetService->getDatos($respuestaPrediccion["datos"]);

            $respuesta = array();
            $i = 0;
            foreach($respuestaDatos['prediccion']['dia'] as $dia){
                $fecha = new \DateTime($dia['fecha']);
                $respuesta[$i]['dia'] = ($fecha instanceof \DateTime) ? $fecha->format('d/m/Y') : '-';
                $respuesta[$i]['estadoCielo'] = $dia['estadoCielo'][0]['descripcion']!== '' ? $dia['estadoCielo'][0]['descripcion'] : '-';
                $respuesta[$i]['temperaturaMax'] = $dia['temperatura']['maxima'];
                $respuesta[$i]['temperaturaMin'] = $dia['temperatura']['minima'];
                $respuesta[$i]['vientoVelocidad'] = $dia['viento'][0]['velocidad'] !== '' ? $dia['viento'][0]['velocidad'] : '-';
                $respuesta[$i]['vientoDireccion'] = $dia['viento'][0]['direccion'] !== '' ? $dia['viento'][0]['direccion'] : '-';
                $respuesta[$i]['humedadMax'] = $dia['humedadRelativa']['maxima'];
                $respuesta[$i]['humedadMin'] = $dia['humedadRelativa']['minima'];
                $respuesta[$i]['probPrecipitacion'] = $dia['probPrecipitacion'][0]['value']  !== '' ? $dia['probPrecipitacion'][0]['value'] : '-';
                $respuesta[$i]['cotaNieve'] = $dia['cotaNieveProv'][0]['value'] !== '' ? $dia['cotaNieveProv'][0]['value'] : '-';            
                $i++;
            }
            return new JsonResponse($respuesta);
        } else {
            return new JsonResponse([
                'error' => 'No se ha encontrado el municipio'
            ], 404);       
        }

    }
}

<?php

namespace App\Http\Controllers\API\GestionOrdenes;
use Illuminate\Support\Facades\DB;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\GestionOrdenes\PlacasVehiculos;

class PlacasVehiculosController extends Controller
{
    //
    public function listar_placasvehiculos(){  
        try {
          
            $data = DB::select("SELECT t0.*
            FROM  placasvehiculos as t0"
            
        );
  
            $response['data'] = $data;
            // $response['data'] = $data1;
            $response['message'] = "load successful";
            $response['success'] = true;
      
        } catch (\Exception $e) {
            $response['message'] = $e->getMessage();
            $response['success'] = false;
        }
            return $response;
      }
}

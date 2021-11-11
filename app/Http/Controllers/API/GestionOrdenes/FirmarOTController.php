<?php

namespace App\Http\Controllers\API\GestionOrdenes;
use Illuminate\Support\Facades\DB;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\GestionOrdenes\FirmarOT;

class FirmarOTController extends Controller
{
    //
    public function create(Request $request){
        try { 
          $insert['id_fir']           = $request['id_fir'];
          $insert['imagen_fir']       = $request['imagen_fir'];
          $insert['firmatecnico_fir'] = 0;
          $insert['nombre_fir']       = $request['nombre_fir'];
          $insert['fechafirma_fir']   = $request['fechafirma_fir'];
          $insert['observacion_fir']  = $request['observacion_fir'];
              
          FirmarOT::insert($insert);
      
          $response['message'] = "Firma OT Grabada de forma correcta";
          $response['success'] = true;

          
      
        } catch (\Exception $e) {
            $response['message'] = $e->getMessage();
            $response['success'] = false;
        }
        return $response;
      }

      public function listar_firmasOT($id_fir){  
        try {
          
            $data = DB::select("SELECT t0.*
            FROM  firmarot as t0
            WHERE t0.id_fir = $id_fir");
  
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
    
      public function update(Request $request, $id_fir){
        try {
          $data['id_fir']           = $request['id_fir'];
          $data['imagen_fir']       = $request['imagen_fir'];
          $data['firmatecnico_fir'] = 0;
          $data['nombre_fir']       = $request['nombre_fir'];
          $data['fechafirma_fir']   = $request['fechafirma_fir'];
          $data['observacion_fir']  = $request['observacion_fir'];
       
          $res = FirmarOT::where("id_fir",$id_fir)->update($data);
    
          $response['res'] = $res;
          $response['message'] = "Updated successful";
          $response['success'] = true;
        } catch (\Exception $e) {
          $response['message'] = $e->getMessage();
          $response['success'] = false;
        }
        return $response;
      }
    
      public function delete($v){ 
        try {
          $res = FirmarOT::where("id_fir",$id_fir)->delete($id_fir);
          $response['res'] = $res;
    
          $response['message'] = "Deleted successful";
          $response['success'] = true; 
        } catch (\Exception $e) {
          $response['message'] = $e->getMessage();
          $response['success'] = false;
        }
          return $response;
      }
}

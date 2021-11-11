<?php

namespace App\Http\Controllers\API\GestionOrdenes;
use Illuminate\Support\Facades\DB;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Parameters\Empresa;
use App\Models\Parameters\Estados;
use App\Models\GestionOrdenes\TipoOperacion;

class TipoOperacionController extends Controller
{
    //
    public function create(Request $request){
        try { 
          $insert['descripcion_tope']         = $request['descripcion_tope'];
          $insert['empresa_tope']             = $request['empresa_tope'];
          $insert['estado_tope']              = $request['estado_tope'];
              
          TipoOperacion::insert($insert);
      
          $response['message'] = "Tipo de Operación Grabada de forma correcta";
          $response['success'] = true;
      
        } catch (\Exception $e) {
            $response['message'] = $e->getMessage();
            $response['success'] = false;
        }
        return $response;
      }
    
      public function listar_tipooperacion(){  
        try {
          
          $data = DB::select("SELECT t0.*, t1.nombre_emp, t2.nombre_est
          FROM tipooperacion as t0 INNER JOIN empresa as t1 INNER JOIN estados as t2
          WHERE t0.empresa_tope = t1.id_emp and t0.estado_tope = t2.id_est ");
  
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

      public function listar_tipooperacionestados(){  
        try {
          
          $data = DB::select("SELECT t0.*, t1.nombre_emp, t2.nombre_est
          FROM tipooperacion as t0 INNER JOIN empresa as t1 INNER JOIN estados as t2
          WHERE t0.empresa_tope = t1.id_emp and t0.estado_tope = t2.id_est and (t0.id_tope IN (2,5,7)) ");
  
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

      public function listar_tipooperacionchequeo(){
        try {
          
          $data = DB::select("SELECT t0.*, t1.nombre_emp, t2.nombre_est
          FROM tipooperacion as t0 INNER JOIN empresa as t1 INNER JOIN estados as t2
          WHERE t0.empresa_tope = t1.id_emp and t0.estado_tope = t2.id_est and (t0.id_tope IN (3,4,6)) ");
  
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
    
      public function get($id_tope){
        try { 
          $data = DB::select("SELECT t0.*, t1.nombre_emp, t2.nombre_est
          FROM tipooperacion as t0 INNER JOIN empresa as t1 INNER JOIN estados as t2
          WHERE t0.id_tope = $id_tope and t0.empresa_tope = t1.id_emp and t0.estado_tope = t2.id_est");
      
          if ($data) {
              $response['data'] = $data;
              $response['message'] = "Load successful";
              $response['success'] = true;
          }
          else {
              $response['data'] = null;
              $response['message'] = "Not found data id_tope => $id_tope";
              $response['success'] = false;
          }
          } catch (\Exception $e) {
              $response['message'] = $e->getMessage();
              $response['success'] = false;
          }
          return $response;
      }
    
      public function update(Request $request, $id_tope){
        try {
          $data['descripcion_tope']        = $request['descripcion_tope'];
          $data['empresa_tope']            = $request['empresa_tope'];
          $data['estado_tope']             = $request['estado_tope'];
    
          $res = TipoOperacion::where("id_tope",$id_tope)->update($data);
    
          $response['res'] = $res;
          $response['message'] = "Updated successful";
          $response['success'] = true;
        } catch (\Exception $e) {
          $response['message'] = $e->getMessage();
          $response['success'] = false;
        }
        return $response;
      }
    
      public function delete($id_tope){ 
        try {
          $res = TipoOperacion::where("id_tope",$id_tope)->delete($id_tope);
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

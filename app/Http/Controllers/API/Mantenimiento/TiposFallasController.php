<?php

namespace App\Http\Controllers\API\Mantenimiento;
use Illuminate\Support\Facades\DB;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Parameters\Empresa;
use App\Models\Parameters\Estados;
use App\Models\Mantenimiento\TiposFallas;

class TiposFallasController extends Controller
{
    //
    public function create(Request $request){
        try { 
          $insert['descripcion_tfa']  = $request['descripcion_tfa'];
          $insert['empresa_tfa'] = $request['empresa_tfa'];
          $insert['estado_tfa']  = $request['estado_tfa'];
              
          TiposFallas::insert($insert);
      
          $response['message'] = "Tipo de Falla Grabada de forma correcta";
          $response['success'] = true;
      
        } catch (\Exception $e) {
            $response['message'] = $e->getMessage();
            $response['success'] = false;
        }
        return $response;
    }
    
    public function listar_tiposfallas(){  
        try {
          
          $data = DB::select("SELECT t0.*, t1.nombre_emp, t2.nombre_est
          FROM tiposdefallas as t0 INNER JOIN empresa as t1 INNER JOIN estados as t2
          WHERE t0.empresa_tfa = t1.id_emp and t0.estado_tfa = t2.id_est ");
  
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
    
    public function get($id_tfa){
        try { 
          $data = DB::select("SELECT t0.*, t1.nombre_emp, t2.nombre_est
          FROM tiposdefallas as t0 INNER JOIN empresa as t1 INNER JOIN estados as t2
          WHERE t0.id_tfa = $id_tfa and t0.empresa_tfa = t1.id_emp and t0.estado_tfa = t2.id_est");
      
          if ($data) {
              $response['data'] = $data;
              $response['message'] = "Load successful";
              $response['success'] = true;
          }
          else {
              $response['data'] = null;
              $response['message'] = "Not found data id_tfa => $id_tfa";
              $response['success'] = false;
          }
          } catch (\Exception $e) {
              $response['message'] = $e->getMessage();
              $response['success'] = false;
          }
          return $response;
    }
    
    public function update(Request $request, $id_tfa){
        try {
          $data['descripcion_tfa']  = $request['descripcion_tfa'];
          $data['empresa_tfa']      = $request['empresa_tfa'];
          $data['estado_tfa']       = $request['estado_tfa'];
    
          $res = TiposFallas::where("id_tfa",$id_tfa)->update($data);
    
          $response['res'] = $res;
          $response['message'] = "Updated successful";
          $response['success'] = true;
        } catch (\Exception $e) {
          $response['message'] = $e->getMessage();
          $response['success'] = false;
        }
        return $response;
    }
    
    public function delete($id_tfa){ 
        try {
          $res = TiposFallas::where("id_tfa",$id_tfa)->delete($id_tfa);
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

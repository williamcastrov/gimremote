<?php

namespace App\Http\Controllers\API\Mantenimiento;
use Illuminate\Support\Facades\DB;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Parameters\Empresa;
use App\Models\Parameters\Estados;
use App\Models\Mantenimiento\Marcas;

class MarcasController extends Controller
{
    //
    public function create(Request $request){
        try { 
          $insert['descripcion_mar']  = $request['descripcion_mar'];
          $insert['empresa_mar'] = $request['empresa_mar'];
          $insert['estado_mar']  = $request['estado_mar'];
              
          Marcas::insert($insert);
      
          $response['message'] = "Marca Grabada de forma correcta";
          $response['success'] = true;
      
        } catch (\Exception $e) {
            $response['message'] = $e->getMessage();
            $response['success'] = false;
        }
        return $response;
    }
    
    public function listar_marcas(){  
        try {
          
          $data = DB::select("SELECT t0.*, t1.nombre_emp, t2.nombre_est
          FROM marcas as t0 INNER JOIN empresa as t1 INNER JOIN estados as t2
          WHERE t0.empresa_mar = t1.id_emp and t0.estado_mar = t2.id_est ");
  
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
    
    public function get($id_mar){
        try { 
          $data = DB::select("SELECT t0.*, t1.nombre_emp, t2.nombre_est
          FROM marcas as t0 INNER JOIN empresa as t1 INNER JOIN estados as t2
          WHERE t0.id_mar = $id_mar and t0.empresa_mar = t1.id_emp and t0.estado_mar = t2.id_est");
      
          if ($data) {
              $response['data'] = $data;
              $response['message'] = "Load successful";
              $response['success'] = true;
          }
          else {
              $response['data'] = null;
              $response['message'] = "Not found data id_mar => $id_mar";
              $response['success'] = false;
          }
          } catch (\Exception $e) {
              $response['message'] = $e->getMessage();
              $response['success'] = false;
          }
          return $response;
    }
    
    public function update(Request $request, $id_mar){
        try {
          $data['descripcion_mar']  = $request['descripcion_mar'];
          $data['empresa_mar']      = $request['empresa_mar'];
          $data['estado_mar']       = $request['estado_mar'];
    
          $res = Marcas::where("id_mar",$id_mar)->update($data);
    
          $response['res'] = $res;
          $response['message'] = "Updated successful";
          $response['success'] = true;
        } catch (\Exception $e) {
          $response['message'] = $e->getMessage();
          $response['success'] = false;
        }
        return $response;
    }
    
    public function delete($id_mar){ 
        try {
          $res = Marcas::where("id_mar",$id_mar)->delete($id_mar);
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

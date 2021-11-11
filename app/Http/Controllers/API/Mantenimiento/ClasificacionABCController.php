<?php

namespace App\Http\Controllers\API\Mantenimiento;
use Illuminate\Support\Facades\DB;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Parameters\Empresa;
use App\Models\Parameters\Estados;
use App\Models\Mantenimiento\ClasificacionABC;

class ClasificacionABCController extends Controller
{
    //
    
    public function create(Request $request){
        try { 
          $insert['codigo_abc']       = $request['codigo_abc'];
          $insert['descripcion_abc']  = $request['descripcion_abc'];
          $insert['empresa_abc']      = $request['empresa_abc'];
          $insert['estado_abc']       = $request['estado_abc'];
              
          ClasificacionABC::insert($insert);
      
          $response['message'] = "Claisificación ABC Grabado de forma correcta";
          $response['success'] = true;
      
        } catch (\Exception $e) {
            $response['message'] = $e->getMessage();
            $response['success'] = false;
        }
        return $response;
    }
    
    public function listar_clasificacionabc(){  
        try {
          
          $data = DB::select("SELECT t0.*, t1.nombre_emp, t2.nombre_est
          FROM clasificacionABC as t0 INNER JOIN empresa as t1 INNER JOIN estados as t2
          WHERE t0.empresa_abc = t1.id_emp and t0.estado_abc = t2.id_est ");
  
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
    
    public function get($id_abc){
        try { 
          $data = DB::select("SELECT t0.*, t1.nombre_emp, t2.nombre_est
          FROM clasificacionABC as t0 INNER JOIN empresa as t1 INNER JOIN estados as t2
          WHERE t0.id_abc = $id_abc and t0.empresa_abc = t1.id_emp and t0.estado_abc = t2.id_est");
      
          if ($data) {
              $response['data'] = $data;
              $response['message'] = "Load successful";
              $response['success'] = true;
          }
          else {
              $response['data'] = null;
              $response['message'] = "Not found data id_abc => $id_abc";
              $response['success'] = false;
          }
          } catch (\Exception $e) {
              $response['message'] = $e->getMessage();
              $response['success'] = false;
          }
          return $response;
    }
    
    public function update(Request $request, $id_abc){
        try {
          $data['codigo_abc']  = $request['codigo_abc'];
          $data['nombre_abc']  = $request['nombre_abc'];
          $data['empresa_abc'] = $request['empresa_abc'];
          $data['estado_abc']  = $request['estado_abc'];
    
          $res = clasificacionABC::where("id_abc",$id_abc)->update($data);
    
          $response['res'] = $res;
          $response['message'] = "Updated successful";
          $response['success'] = true;
        } catch (\Exception $e) {
          $response['message'] = $e->getMessage();
          $response['success'] = false;
        }
        return $response;
    }
    
    public function delete($id_abc){ 
        try {
          $res = clasificacionABC::where("id_abc",$id_abc)->delete($id_abc);
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

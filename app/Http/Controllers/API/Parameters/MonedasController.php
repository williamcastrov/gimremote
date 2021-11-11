<?php

namespace App\Http\Controllers\API\Parameters;
use Illuminate\Support\Facades\DB;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Parameters\Empresa;
use App\Models\Parameters\Estados;
use App\Models\Parameters\Monedas;

class MonedasController extends Controller
{
    //
    public function create(Request $request){
        try { 
          $insert['descripcion_mon']  = $request['descripcion_mon'];
          $insert['empresa_mon'] = $request['empresa_mon'];
          $insert['estado_mon']  = $request['estado_mon'];
              
          Monedas::insert($insert);
      
          $response['message'] = "Tipo de Moneda Grabada de forma correcta";
          $response['success'] = true;
      
        } catch (\Exception $e) {
            $response['message'] = $e->getMessage();
            $response['success'] = false;
        }
        return $response;
      }
    
      public function listar_monedas(){  
        try {
          
          $data = DB::select("SELECT t0.*, t1.nombre_emp, t2.nombre_est
          FROM monedas as t0 INNER JOIN empresa as t1 INNER JOIN estados as t2
          WHERE t0.empresa_mon = t1.id_emp and t0.estado_mon = t2.id_est ");
  
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
    
      public function get($id_mon){
        try { 
          $data = DB::select("SELECT t0.*, t1.nombre_emp, t2.nombre_est
          FROM monedas as t0 INNER JOIN empresa as t1 INNER JOIN estados as t2
          WHERE t0.id_mon = $id_mon and t0.empresa_mon = t1.id_emp and t0.estado_mon = t2.id_est");
      
          if ($data) {
              $response['data'] = $data;
              $response['message'] = "Load successful";
              $response['success'] = true;
          }
          else {
              $response['data'] = null;
              $response['message'] = "Not found data id_mon => $id_mon";
              $response['success'] = false;
          }
          } catch (\Exception $e) {
              $response['message'] = $e->getMessage();
              $response['success'] = false;
          }
          return $response;
      }
    
      public function update(Request $request, $id_mon){
        try {
          $data['descripcion_mon']  = $request['descripcion_mon'];
          $data['empresa_mon'] = $request['empresa_mon'];
          $data['estado_mon']  = $request['estado_mon'];
    
          $res = Monedas::where("id_mon",$id_mon)->update($data);
    
          $response['res'] = $res;
          $response['message'] = "Updated successful";
          $response['success'] = true;
        } catch (\Exception $e) {
          $response['message'] = $e->getMessage();
          $response['success'] = false;
        }
        return $response;
      }
    
      public function delete($id_mon){ 
        try {
          $res = Monedas::where("id_mon",$id_mon)->delete($id_mon);
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

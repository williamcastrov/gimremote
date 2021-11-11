<?php

namespace App\Http\Controllers\API\Parameters;
use Illuminate\Support\Facades\DB;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Parameters\Empresa;
use App\Models\Parameters\Estados;
use App\Models\Parameters\Unidades;

class UnidadesController extends Controller
{
    //
    public function create(Request $request){
        try { 
          $insert['descripcion_und'] = $request['descripcion_und'];
          $insert['tipo_und']        = $request['tipo_und'];
          $insert['empresa_und']     = $request['empresa_und'];
          $insert['estado_und']      = $request['estado_und'];
              
          Unidades::insert($insert);
      
          $response['message'] = "Unidad Grabada de forma correcta";
          $response['success'] = true;
      
        } catch (\Exception $e) {
            $response['message'] = $e->getMessage();
            $response['success'] = false;
        }
        return $response;
      }
    
      public function listar_unidades(){  
        try {
          
          $data = DB::select("SELECT t0.*, t1.nombre_emp, t2.nombre_est
          FROM unidades as t0 INNER JOIN empresa as t1 INNER JOIN estados as t2
          WHERE t0.empresa_und = t1.id_emp and t0.estado_und = t2.id_est ");
  
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

      public function listar_tipopartes(){  
        try {
          
          $data = DB::select("SELECT t0.*, t1.nombre_emp, t2.nombre_est
          FROM unidades as t0 INNER JOIN empresa as t1 INNER JOIN estados as t2
          WHERE (t0.tipo_und = 'EQM' or t0.tipo_und = 'ACM' or t0.tipo_und = 'CCT' or t0.tipo_und = 'CSG') 
            and t0.empresa_und = t1.id_emp and t0.estado_und = t2.id_est ");
  
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

      public function listar_tipousuarios(){  
        try {
          
          $data = DB::select("SELECT t0.*, t1.nombre_emp, t2.nombre_est
          FROM unidades as t0 INNER JOIN empresa as t1 INNER JOIN estados as t2
          WHERE t0.tipo_und = 'USU' and t0.empresa_und = t1.id_emp and t0.estado_und = t2.id_est ");
  
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
    
      public function get($id_und){
        try { 
          $data = DB::select("SELECT t0.*, t1.nombre_emp, t2.nombre_est
          FROM unidades as t0 INNER JOIN empresa as t1 INNER JOIN estados as t2
          WHERE t0.id_und = $id_und and t0.empresa_und = t1.id_emp and t0.estado_und = t2.id_est");
      
          if ($data) {
              $response['data'] = $data;
              $response['message'] = "Load successful";
              $response['success'] = true;
          }
          else {
              $response['data'] = null;
              $response['message'] = "Not found data id_und => $id_und";
              $response['success'] = false;
          }
          } catch (\Exception $e) {
              $response['message'] = $e->getMessage();
              $response['success'] = false;
          }
          return $response;
      }
    
      public function update(Request $request, $id_und){
        try {
          $data['descripcion_und'] = $request['descripcion_und'];
          $data['tipo_und']        = $request['tipo_und'];
          $data['empresa_und']     = $request['empresa_und'];
          $data['estado_und']      = $request['estado_und'];
    
          $res = Unidades::where("id_und",$id_und)->update($data);
    
          $response['res'] = $res;
          $response['message'] = "Updated successful";
          $response['success'] = true;
        } catch (\Exception $e) {
          $response['message'] = $e->getMessage();
          $response['success'] = false;
        }
        return $response;
      }
    
      public function delete($id_und){ 
        try {
          $res = Unidades::where("id_und",$id_und)->delete($id_und);
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

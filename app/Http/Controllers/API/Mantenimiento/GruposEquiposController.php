<?php

namespace App\Http\Controllers\API\Mantenimiento;
use Illuminate\Support\Facades\DB;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Parameters\Empresa;
use App\Models\Parameters\Estados;
use App\Models\Mantenimiento\GruposEquipos;

class GruposEquiposController extends Controller
{
    //
    public function create(Request $request){
        try { 
          $insert['codigogrupo_grp']  = $request['codigogrupo_grp'];
          $insert['descripcion_grp']  = $request['descripcion_grp'];
          $insert['empresa_grp']      = $request['empresa_grp'];
          $insert['estado_grp']       = $request['estado_grp'];
              
          GruposEquipos::insert($insert);
      
          $response['message'] = "Tipo de Equipo Grabado de forma correcta";
          $response['success'] = true;
      
        } catch (\Exception $e) {
            $response['message'] = $e->getMessage();
            $response['success'] = false;
        }
        return $response;
    }
    
    public function listar_gruposequipos(){  
        try {
          
          $data = DB::select("SELECT t0.*, t1.nombre_emp, t2.nombre_est
          FROM gruposequipos as t0 INNER JOIN empresa as t1 INNER JOIN estados as t2
          WHERE t0.empresa_grp = t1.id_emp and t0.estado_grp = t2.id_est ");
  
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
    
    public function get($id_tequ){
        try { 
          $data = DB::select("SELECT t0.*, t1.nombre_emp, t2.nombre_est
          FROM gruposequipos as t0 INNER JOIN empresa as t1 INNER JOIN estados as t2
          WHERE t0.id_grp = $id_grp and t0.empresa_grp = t1.id_emp and t0.estado_grp = t2.id_est");
      
          if ($data) {
              $response['data'] = $data;
              $response['message'] = "Load successful";
              $response['success'] = true;
          }
          else {
              $response['data'] = null;
              $response['message'] = "Not found data id_tequ => $id_grp";
              $response['success'] = false;
          }
          } catch (\Exception $e) {
              $response['message'] = $e->getMessage();
              $response['success'] = false;
          }
          return $response;
    }
    
    public function update(Request $request, $id_grp){
        try {
          $data['codigogrupo_grp']  = $request['codigogrupo_grp'];
          $data['descripcion_grp']  = $request['descripcion_grp'];
          $data['empresa_grp']      = $request['empresa_grp'];
          $data['estado_grp']       = $request['estado_grp'];
    
          $res = GruposEquipos::where("id_grp",$id_grp)->update($data);
    
          $response['res'] = $res;
          $response['message'] = "Updated successful";
          $response['success'] = true;
        } catch (\Exception $e) {
          $response['message'] = $e->getMessage();
          $response['success'] = false;
        }
        return $response;
    }
    
    public function delete($id_grp){ 
        try {
          $res = GruposEquipos::where("id_grp",$id_grp)->delete($id_grp);
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

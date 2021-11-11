<?php

namespace App\Http\Controllers\API\Mantenimiento;
use Illuminate\Support\Facades\DB;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Parameters\Estados;
use App\Models\Parameters\Ciudades;
use App\Models\Interlocutores\Interlocutores_cli;
use App\Models\Mantenimiento\Remision;

class RemisionController extends Controller
{
    //
    public function create(Request $request){
        try { 
          $insert['cliente_rem']          = $request['cliente_rem'];
          $insert['ordencompra_rem']      = $request['ordencompra_rem'];
          $insert['ciudad_rem']           = $request['ciudad_rem'];
          $insert['direccion_rem']        = $request['direccion_rem'];
          $insert['contacto_rem']         = $request['contacto_rem'];
          $insert['telefono_rem']         = $request['telefono_rem'];
          $insert['fechacreacion_rem']    = $request['fechacreacion_rem'];
          $insert['horometro_rem']        = $request['horometro_rem'];
          $insert['estado_rem']           = $request['estado_rem'];
          $insert['equipo1_rem']          = $request['equipo1_rem'];
          $insert['equipo2_rem']          = $request['equipo2_rem'];
          $insert['equipo3_rem']          = $request['equipo3_rem'];
          $insert['equipo4_rem']          = $request['equipo4_rem'];
          $insert['lucesdetrabajo_rem']   = $request['lucesdetrabajo_rem'];
          $insert['luzstrober_rem']       = $request['luzstrober_rem'];
          $insert['camara_rem']           = $request['camara_rem'];
          $insert['sensordeimpacto_rem']  = $request['sensordeimpacto_rem'];
          $insert['alarmadereservsa_rem'] = $request['alarmadereservsa_rem'];
          $insert['camasdebateria_rem']   = $request['camasdebateria_rem'];

          Remision::insert($insert);
      
          $response['message'] = "Remisión del Equipo Grabada de forma correcta";
          $response['success'] = true;
      
        } catch (\Exception $e) {
            $response['message'] = $e->getMessage();
            $response['success'] = false;
        }
        return $response;
    }
    
    public function listar_remision(){  
        try {   
          $data = DB::select("SELECT t0.*, t1.nombre_ciu, t2.nombre_est, t3.razonsocial_cli, t4.nombre_dep
          FROM remision as t0 INNER JOIN ciudades      as t1 INNER JOIN estados as t2 INNER JOIN interlocutores_cli as t3
                              INNER JOIN departamentos as t4
          WHERE t0.ciudad_rem = t1.id_ciu and t0.estado_rem = t2.id_est and t0.cliente_rem = t3.id_cli and
                t4.codigo_dep = t1.departamento_ciu");
  
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
    
    public function get($id_rem){
        try { 
            $data = DB::select("SELECT t0.*, t1.nombre_ciu, t2.nombre_est, t3.razonsocial_cli
            FROM remision as t0 INNER JOIN ciudades as t1 INNER JOIN estados as t2 INNER JOIN interlocutores_cli as t3
            WHERE t0.ciudad_rem = t1.id_ciu and t0.estado_rem = t2.id_est and t0.cliente_rem = t3.id_cli and
                  t0.id_rem = $id_rem");
      
          if ($data) {
              $response['data'] = $data;
              $response['message'] = "Load successful";
              $response['success'] = true;
          }
          else {
              $response['data'] = null;
              $response['message'] = "Not found data id_rem => $id_rem";
              $response['success'] = false;
          }
          } catch (\Exception $e) {
              $response['message'] = $e->getMessage();
              $response['success'] = false;
          }
          return $response;
    }
    
    public function update(Request $request, $id_rem){
        try {
            $data['cliente_rem']          = $request['cliente_rem'];
            $data['ordencompra_rem']      = $request['ordencompra_rem'];
            $data['ciudad_rem']           = $request['ciudad_rem'];
            $data['direccion_rem']        = $request['direccion_rem'];
            $data['contacto_rem']         = $request['contacto_rem'];
            $data['telefono_rem']         = $request['telefono_rem'];
            $data['fechacreacion_rem']    = $request['fechacreacion_rem'];
            $data['horometro_rem']        = $request['horometro_rem'];
            $data['estado_rem']           = $request['estado_rem'];
            $data['equipo1_rem']          = $request['equipo1_rem'];
            $data['equipo2_rem']          = $request['equipo2_rem'];
            $data['equipo3_rem']          = $request['equipo3_rem'];
            $data['equipo4_rem']          = $request['equipo4_rem'];
            $data['lucesdetrabajo_rem']   = $request['lucesdetrabajo_rem'];
            $data['luzstrober_rem']       = $request['luzstrober_rem'];
            $data['camara_rem']           = $request['camara_rem'];
            $data['sensordeimpacto_rem']  = $request['sensordeimpacto_rem'];
            $data['alarmadereservsa_rem'] = $request['alarmadereservsa_rem'];
            $data['camasdebateria_rem']   = $request['camasdebateria_rem'];
    
          $res = Remision::where("id_rem",$id_rem)->update($data);
    
          $response['res'] = $res;
          $response['message'] = "Updated successful";
          $response['success'] = true;
        } catch (\Exception $e) {
          $response['message'] = $e->getMessage();
          $response['success'] = false;
        }
        return $response;
    }
    
    public function delete($id_rem){ 
        try {
          $res = Remision::where("id_rem",$id_rem)->delete($id_rem);
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

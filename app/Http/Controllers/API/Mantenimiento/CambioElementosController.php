<?php

namespace App\Http\Controllers\API\Mantenimiento;
use Illuminate\Support\Facades\DB;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Parameters\Estados;
use App\Models\Parameters\Ciudades;
use App\Models\Interlocutores\Interlocutores_cli;
use App\Models\Mantenimiento\CambioElementos;

class CambioElementosController extends Controller
{
    //
    public function create(Request $request){
        try { 
          $insert['cliente_cel']        = $request['cliente_cel'];
          $insert['ciudad_cel']         = $request['ciudad_cel'];
          $insert['direccion_cel']      = $request['direccion_cel'];
          $insert['fechacreacion_cel']  = $request['fechacreacion_cel'];
          $insert['estado_cel']         = $request['estado_cel'];
          $insert['equipoentrega1_cel'] = $request['equipoentrega1_cel'];
          $insert['equiporecibe1_cel']  = $request['equiporecibe1_cel'];
          $insert['equipoentrega2_cel'] = $request['equipoentrega2_cel'];
          $insert['equiporecibe2_cel']  = $request['equiporecibe2_cel'];
          $insert['equipoentrega3_cel'] = $request['equipoentrega3_cel'];
          $insert['equiporecibe3_cel']  = $request['equiporecibe3_cel'];

          CambioElementos::insert($insert);
      
          $response['message'] = "Cambio de Elementos Grabado de forma correcta";
          $response['success'] = true;
      
        } catch (\Exception $e) {
            $response['message'] = $e->getMessage();
            $response['success'] = false;
        }
        return $response;
    }
    
    public function listar_cambioelementos(){  
        try {   
          $data = DB::select("SELECT t0.*, t1.nombre_ciu, t2.nombre_est, t3.razonsocial_cli, t4.nombre_dep
          FROM cambioelementos as t0 INNER JOIN ciudades      as t1 INNER JOIN estados as t2 INNER JOIN interlocutores_cli as t3
                                     INNER JOIN departamentos as t4
          WHERE t0.ciudad_cel = t1.id_ciu and t0.estado_cel = t2.id_est and t0.cliente_cel = t3.id_cli and t4.id_dep = t1.departamento_ciu");
  
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
    
    public function get($id_cel){
        try { 
            $data = DB::select("SELECT t0.*, t1.nombre_ciu, t2.nombre_est, t3.razonsocial_cli
            FROM cambioelementos as t0 INNER JOIN ciudades as t1 INNER JOIN estados as t2 INNER JOIN interlocutores_cli as t3
            WHERE t0.ciudad_cel = t1.id_ciu and t0.estado_cel = t2.id_est and t0.cliente_cel = t3.id_cli and
                  t0.id_cel = $id_cel");
      
          if ($data) {
              $response['data'] = $data;
              $response['message'] = "Load successful";
              $response['success'] = true;
          }
          else {
              $response['data'] = null;
              $response['message'] = "Not found data id_cel => $id_cel";
              $response['success'] = false;
          }
          } catch (\Exception $e) {
              $response['message'] = $e->getMessage();
              $response['success'] = false;
          }
          return $response;
    }
    
    public function update(Request $request, $id_cel){
        try {
            $data['cliente_cel']        = $request['cliente_cel'];
            $data['ciudad_cel']         = $request['ciudad_cel'];
            $data['direccion_cel']      = $request['direccion_cel'];
            $data['fechacreacion_cel']  = $request['fechacreacion_cel'];
            $data['estado_cel']         = $request['estado_cel'];
            $data['equipoentrega1_cel'] = $request['equipoentrega1_cel'];
            $data['equiporecibe1_cel']  = $request['equiporecibe1_cel'];
            $data['equipoentrega2_cel'] = $request['equipoentrega2_cel'];
            $data['equiporecibe2_cel']  = $request['equiporecibe2_cel'];
            $data['equipoentrega3_cel'] = $request['equipoentrega3_cel'];
            $data['equiporecibe3_cel']  = $request['equiporecibe3_cel'];

    
          $res = CambioElementos::where("id_cel",$id_cel)->update($data);
    
          $response['res'] = $res;
          $response['message'] = "Updated successful";
          $response['success'] = true;
        } catch (\Exception $e) {
          $response['message'] = $e->getMessage();
          $response['success'] = false;
        }
        return $response;
    }
    
    public function delete($id_cel){ 
        try {
          $res = CambioElementos::where("id_cel",$id_cel)->delete($id_cel);
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

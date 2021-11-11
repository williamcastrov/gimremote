<?php

namespace App\Http\Controllers\API\Interlocutores;
use Illuminate\Support\Facades\DB;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Interlocutores\Interlocutores;
use App\Models\Parameters\Empresa;
use App\Models\Parameters\Estados;
use App\Models\Parameters\Ciudades;
use App\Models\Interlocutores\TipoInterlocutores;
use App\Models\Interlocutores\Especialidades;

class InterlocutoresController extends Controller
{
    //
    public function create(Request $request){
        try { 
          $insert['codigo_tipo_int']        = $request['codigo_tipo_int'];
          $insert['nit_int']                = $request['nit_int'];
          $insert['estado_int']             = $request['estado_int'];
          $insert['primer_nombre_int']      = $request['primer_nombre_int'];
          $insert['segundo_nombre_int']     = $request['segundo_nombre_int'];
          $insert['primer_apellido_int']    = $request['primer_apellido_int'];
          $insert['segundo_apellido_int']    = $request['segundo_apellido_int'];
          $insert['razonsocial_int']        = $request['razonsocial_int'];
          $insert['ciudad_int']             = $request['ciudad_int'];
          $insert['direccion_int']          = $request['direccion_int'];
          $insert['telefono_int']           = $request['telefono_int'];
          $insert['email_int']              = $request['email_int'];
          $insert['empresa_int']            = $request['empresa_int'];
          $insert['fecha_creacion_int']     = $request['fecha_creacion_int'];
          $insert['fecha_modificacion_int'] = $request['fecha_modificacion_int'];
          $insert['especialidad_int']       = $request['especialidad_int'];
              
          Interlocutores::insert($insert);
      
          $response['message'] = "Interlocutor Grabado de forma correcta";
          $response['success'] = true;
      
        } catch (\Exception $e) {
            $response['message'] = $e->getMessage();
            $response['success'] = false;
        }
        return $response;
      }
    
      public function listar_interlocutores(){  
        try {
          //Muestra Unicamente los tipos de Interlocutores PROVEEDORES = 1
          $data = DB::select("SELECT t0.*, t1.nombre_emp, t2.nombre_est, t3.nombre_ciu, t4.nombre_esp,  t5.nombre_tint
          FROM interlocutores as t0 INNER JOIN empresa as t1 INNER JOIN estados as t2 INNER JOIN ciudades as t3
          INNER JOIN especialidades_int as t4  INNER JOIN tipo_interlocutor as t5
          WHERE t0.codigo_tipo_int = 1 and t0.empresa_int = t1.id_emp and t0.estado_int = t2.id_est 
          and t0.ciudad_int = t3.id_ciu and t0.especialidad_int = t4.id_esp and t0.codigo_tipo_int = t5.id_tint
          and t0.ciudad_cli = t3.id_ciu and t0.especialidad_cli = t4.id_esp and t0.codigo_tipo_cli = t5.id_tint
          ORDER BY razonsocial_int ASC");
  
    
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
    
      public function get($id_int){
        try { 
          //$data = Frecuencias::find($id_fre);
          $data = DB::select("SELECT t0.*, t1.nombre_emp, t2.nombre_est, t3.nombre_ciu, t4.nombre_esp,  t5.nombre_tint
          FROM interlocutores as t0 INNER JOIN empresa as t1 INNER JOIN estados as t2 INNER JOIN ciudades as t3
          INNER JOIN especialidades_int as t4  INNER JOIN tipo_interlocutor as t5
          WHERE t0.id_int = $id_int and t0.empresa_int = t1.id_emp and t0.estado_int = t2.id_est 
          and t0.ciudad_int = t3.id_ciu and t0.especialidad_int = t4.id_esp and t0.codigo_tipo_int = t5.id_tint");
      
          if ($data) {
              $response['data'] = $data;
              $response['message'] = "Load successful";
              $response['success'] = true;
          }
          else {
              $response['data'] = null;
              $response['message'] = "Not found data id_int => $id_int";
              $response['success'] = false;
          }
          } catch (\Exception $e) {
              $response['message'] = $e->getMessage();
              $response['success'] = false;
          }
          return $response;
      }
    
      public function update(Request $request, $id_int){
        try {
          $data['codigo_tipo_int']        = $request['codigo_tipo_int'];
          $data['nit_int']                = $request['nit_int'];
          $data['estado_int']             = $request['estado_int'];
          $data['primer_nombre_int']      = $request['primer_nombre_int'];
          $data['segundo_nombre_int']     = $request['segundo_nombre_int'];
          $data['primer_apellido_int']    = $request['primer_apellido_int'];
          $data['segundo_apellido_int']   = $request['segundo_apellido_int'];
          $data['razonsocial_int']        = $request['razonsocial_int'];
          $data['ciudad_int']             = $request['ciudad_int'];
          $data['direccion_int']          = $request['direccion_int'];
          $data['telefono_int']           = $request['telefono_int'];
          $data['email_int']              = $request['email_int'];
          $data['empresa_int']            = $request['empresa_int'];
          $data['fecha_creacion_int']     = $request['fecha_creacion_int'];
          $data['fecha_modificacion_int'] = $request['fecha_modificacion_int'];
          $data['especialidad_int']       = $request['especialidad_int'];
    
          $res = Interlocutores::where("id_int",$id_int)->update($data);
    
          $response['res'] = $res;
          $response['message'] = "Updated successful";
          $response['success'] = true;
        } catch (\Exception $e) {
          $response['message'] = $e->getMessage();
          $response['success'] = false;
        }
        return $response;
      }
    
      public function delete($id_int){ 
        try {
          $res = Interlocutores::where("id_int",$id_int)->delete($id_int);
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

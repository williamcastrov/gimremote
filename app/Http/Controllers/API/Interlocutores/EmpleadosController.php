<?php

namespace App\Http\Controllers\API\Interlocutores;
use Illuminate\Support\Facades\DB;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Interlocutores\Interlocutores_emp;
use App\Models\Parameters\Empresa;
use App\Models\Parameters\Estados;
use App\Models\Parameters\Ciudades;
use App\Models\Interlocutores\TipoInterlocutores;
use App\Models\Interlocutores\Especialidades;

class EmpleadosController extends Controller
{
    //
    public function create(Request $request){
        try { 
          $insert['codigo_tipo_emp']        = $request['codigo_tipo_emp'];
          $insert['nit_emp']                = $request['nit_emp'];
          $insert['digitochequeo_emp']      = $request['digitochequeo_emp'];
          $insert['estado_emp']             = $request['estado_emp'];
          $insert['primer_nombre_emp']      = $request['primer_nombre_emp'];
          $insert['segundo_nombre_emp']     = $request['segundo_nombre_emp'];
          $insert['primer_apellido_emp']    = $request['primer_apellido_emp'];
          $insert['segundo_apellido_emp']   = $request['segundo_apellido_emp'];
          $insert['razonsocial_emp']        = $request['razonsocial_emp'];
          $insert['ciudad_emp']             = $request['ciudad_emp'];
          $insert['direccion_emp']          = $request['direccion_emp'];
          $insert['telefono_emp']           = $request['telefono_emp'];
          $insert['email_emp']              = $request['email_emp'];
          $insert['empresa_emp']            = $request['empresa_emp'];
          $insert['fecha_creacion_emp']     = $request['fecha_creacion_emp'];
          $insert['fecha_modificacion_emp'] = $request['fecha_modificacion_emp'];
          $insert['especialidad_emp']       = $request['especialidad_emp'];
              
          Interlocutores_emp::insert($insert);
      
          $response['message'] = "Empleado Grabado de forma correcta";
          $response['success'] = true;
      
        } catch (\Exception $e) {
            $response['message'] = $e->getMessage();
            $response['success'] = false;
        }
        return $response;
      }
    
      public function listar_empleados(){  
        try {
          //Muestra Unicamente los tipos de Interlocutores EMPLEADOS = 2
          $data = DB::select("SELECT t0.*, t1.nombre_emp, t2.nombre_est, t3.nombre_ciu, t4.descripcion_esp,  t5.descripcion_tint
          FROM interlocutores_emp as t0 INNER JOIN empresa as t1 INNER JOIN estados as t2 INNER JOIN ciudades as t3
          INNER JOIN especialidades_int as t4  INNER JOIN tipo_interlocutor as t5
          WHERE t0.codigo_tipo_emp = 3 and t0.empresa_emp = t1.id_emp and t0.estado_emp = t2.id_est 
          and t0.ciudad_emp = t3.id_ciu and t0.especialidad_emp = t4.id_esp and t0.codigo_tipo_emp = t5.id_tint");
  
    
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

      public function listar_empleadosOT(){  
        try {
          //Muestra Unicamente los tipos de Interlocutores EMPLEADOS = 2
          $data = DB::select("SELECT t0.*, t1.nombre_emp, t2.nombre_est, t3.nombre_ciu, t4.descripcion_esp,  t5.descripcion_tint
          FROM interlocutores_emp as t0 INNER JOIN empresa as t1 INNER JOIN estados as t2 INNER JOIN ciudades as t3
          INNER JOIN especialidades_int as t4  INNER JOIN tipo_interlocutor as t5
          WHERE t0.codigo_tipo_emp  = 3         and t0.empresa_emp      = t1.id_emp and t0.estado_emp     = t2.id_est 
            and t0.ciudad_emp       = t3.id_ciu and t0.especialidad_emp = t4.id_esp and t0.codigo_tipo_emp = t5.id_tint 
            and t0.especialidad_emp = 6");
    
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

      public function listar_empleadoscomercial(){  
        try {
          //Muestra Unicamente los tipos de Interlocutores EMPLEADOS = 2
          $data = DB::select("SELECT t0.*, t1.nombre_emp, t2.nombre_est, t3.nombre_ciu, t4.descripcion_esp,  t5.descripcion_tint
          FROM interlocutores_emp as t0 INNER JOIN empresa as t1 INNER JOIN estados as t2 INNER JOIN ciudades as t3
          INNER JOIN especialidades_int as t4  INNER JOIN tipo_interlocutor as t5
          WHERE t0.codigo_tipo_emp  = 3         and t0.empresa_emp      = t1.id_emp and t0.estado_emp     = t2.id_est 
            and t0.ciudad_emp       = t3.id_ciu and t0.especialidad_emp = t4.id_esp and t0.codigo_tipo_emp = t5.id_tint 
            and t0.especialidad_emp = 5");
    
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
    
      public function get($id_emp){
        try { 
          //$data = Frecuencias::find($id_fre);
          $data = DB::select("SELECT t0.*, t1.nombre_emp, t2.nombre_est, t3.nombre_ciu, t4.descripcion_esp,  t5.descripcion_tint
          FROM interlocutores_emp as t0 INNER JOIN empresa as t1 INNER JOIN estados as t2 INNER JOIN ciudades as t3
          INNER JOIN especialidades_int as t4  INNER JOIN tipo_interlocutor as t5
          WHERE t0.codigo_tipo_emp = 3 and t0.id_emp = $id_emp and t0.empresa_emp = t1.id_emp and t0.estado_emp = t2.id_est 
          and t0.ciudad_emp = t3.id_ciu and t0.especialidad_emp = t4.id_esp and t0.codigo_tipo_emp = t5.id_tint");
      
          if ($data) {
              $response['data'] = $data;
              $response['message'] = "Load successful";
              $response['success'] = true;
          }
          else {
              $response['data'] = null;
              $response['message'] = "Not found data id_emp => $id_emp";
              $response['success'] = false;
          }
          } catch (\Exception $e) {
              $response['message'] = $e->getMessage();
              $response['success'] = false;
          }
          return $response;
      }
    
      public function update(Request $request, $id_emp){
        try {
          $data['codigo_tipo_emp']        = $request['codigo_tipo_emp'];
          $data['nit_emp']                = $request['nit_emp'];
          $data['digitochequeo_emp']      = $request['digitochequeo_emp'];
          $data['estado_emp']             = $request['estado_emp'];
          $data['primer_nombre_emp']      = $request['primer_nombre_emp'];
          $data['segundo_nombre_emp']     = $request['segundo_nombre_emp'];
          $data['primer_apellido_emp']    = $request['primer_apellido_emp'];
          $data['segundo_apellido_emp']   = $request['segundo_apellido_emp'];
          $data['razonsocial_emp']        = $request['razonsocial_emp'];
          $data['ciudad_emp']             = $request['ciudad_emp'];
          $data['direccion_emp']          = $request['direccion_emp'];
          $data['telefono_emp']           = $request['telefono_emp'];
          $data['email_emp']              = $request['email_emp'];
          $data['empresa_emp']            = $request['empresa_emp'];
          $data['fecha_creacion_emp']     = $request['fecha_creacion_emp'];
          $data['fecha_modificacion_emp'] = $request['fecha_modificacion_emp'];
          $data['especialidad_emp']       = $request['especialidad_emp'];
    
          $res = Interlocutores_emp::where("id_emp",$id_emp)->update($data);
    
          $response['res'] = $res;
          $response['message'] = "Updated successful";
          $response['success'] = true;
        } catch (\Exception $e) {
          $response['message'] = $e->getMessage();
          $response['success'] = false;
        }
        return $response;
      }
    
      public function delete($id_emp){ 
        try {
          $res = Interlocutores_emp::where("id_emp",$id_emp)->delete($id_emp);
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

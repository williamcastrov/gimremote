<?php

namespace App\Http\Controllers\API;
use Illuminate\Support\Facades\DB;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Usuarios;
use App\Models\Parameters\Ciudades;
use App\Models\Parameters\Estados;
use App\Models\Parameters\Unidades;

class UsuariosController extends Controller
{
    //
    public function create(Request $request){
        try {
          $insert['id_usu']          = $request['id_usu'];
          $insert['cedula_usu']      = $request['cedula_usu'];
          $insert['nombre_usu']      = $request['nombre_usu'];
          $insert['email_usu']       = $request['email_usu'];
          $insert['pais_usu']        = $request['pais_usu'];
          $insert['ciudad_usu']      = $request['ciudad_usu'];
          $insert['uidfirebase_usu'] = $request['uidfirebase_usu'];
          $insert['tipo_usu']        = $request['tipo_usu'];
          $insert['foto_usu']        = $request['foto_usu'];
          $insert['celular_usu']     = $request['celular_usu'];
          $insert['dashboard_usu']   = $request['dashboard_usu'];
          $insert['estado_usu']      = $request['estado_usu']; 

            Usuarios::insert($insert);
  
            $response['message'] = "Usuario Grabado de forma correcta";
            $response['success'] = true;

        } catch (\Exception $e) {
            $response['message'] = $e->getMessage();
            $response['success'] = true;
        }
        return $response;
    }

    public function listar_usuarios(){
  
      try {

        //$data = Usuarios::get();

        $data = DB::select("SELECT t0.*, t1.nombre_est, t2.nombre_ciu, t3.descripcion_und
        FROM usuarios as t0 INNER JOIN estados as t1 INNER JOIN ciudades as t2  INNER JOIN unidades as t3
        WHERE t0.estado_usu = t1.id_est and t0.ciudad_usu = t2.id_ciu and t0.tipo_usu IN (10,11,12,13) and t0.tipo_usu = t3.id_und");

        $response['data'] = $data;
        $response['message'] = "load successful";
        $response['success'] = true;

      } catch (\Exception $e) {
        $response['message'] = $e->getMessage();
        $response['success'] = false;
      }
      return $response;
    }

    public function leer_usuario($uidfirebase_usu){
      try {
        $data = DB::select("SELECT t0.*, t1.nombre_est, t2.nombre_ciu, t3.descripcion_und
        FROM usuarios as t0 INNER JOIN estados as t1 INNER JOIN ciudades as t2  INNER JOIN unidades as t3
        WHERE t0.estado_usu = t1.id_est and t0.ciudad_usu = t2.id_ciu and t0.tipo_usu IN (10,11,12,13,17) and t0.tipo_usu = t3.id_und and
              t0.uidfirebase_usu like $uidfirebase_usu");

        if ($data) {
            $response['data'] = $data;
            $response['message'] = "Load successful";
            $response['success'] = true;
        }
        else {
            $response['data'] = null;
            $response['message'] = "Not found data uidfirebase_usu => $uidfirebase_usu";
            $response['success'] = false;
        }

      } catch (\Exception $e) {
          $response['message'] = $e->getMessage();
          $response['success'] = false;
      }
      return $response;
    }

    public function get($id_usu){
      try {
        $data = DB::select("SELECT t0.*, t1.nombre_est, t2.nombre_ciu, t3.descripcion_und
        FROM usuarios as t0 INNER JOIN estados as t1 INNER JOIN ciudades as t2  INNER JOIN unidades as t3
        WHERE t0.estado_usu = t1.id_est and t0.ciudad_usu = t2.id_ciu and t0.tipo_usu IN (10,11,12,13) and t0.tipo_usu = t3.id_und and
              t0.id_usu = $id_usu");

        if ($data) {
          $response['data'] = $data;
          $response['message'] = "Load successful";
          $response['success'] = true;
        }
        else {
          $response['data'] = null;
          $response['message'] = "Not found data id_usu => $id_usu";
          $response['success'] = false;
        }

      } catch (\Exception $e) {
        $response['message'] = $e->getMessage();
        $response['success'] = false;
      }
      return $response;
    }

    public function update(Request $request, $id_usu){

      try {
        $data['cedula_usu']      = $request['cedula_usu'];
        $data['nombre_usu']      = $request['nombre_usu'];
        $data['email_usu']       = $request['email_usu'];
        $data['pais_usu']        = $request['pais_usu'];
        $data['ciudad_usu']      = $request['ciudad_usu'];
        $data['uidfirebase_usu'] = $request['uidfirebase_usu'];
        $data['tipo_usu']        = $request['tipo_usu'];
        $data['foto_usu']        = $request['foto_usu'];
        $data['celular_usu']     = $request['celular_usu'];
        $data['dashboard_usu']   = $request['dashboard_usu'];
        $data['estado_usu']      = $request['estado_usu'];
        //Console::info('mymessage');

        $res = Usuarios::where("id_usu",$id_usu)->update($data);

        $response['res'] = $res;
        $response['message'] = "Updated successful";
        $response['success'] = true;

      } catch (\Exception $e) {
        $response['message'] = $e->getMessage();
        $response['success'] = false;
      }
      return $response;

    }

    public function delete($id_usu){

      try {
        $res = Usuarios::where("id_usu",$id_usu)->delete($id_usu);
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

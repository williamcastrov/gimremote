<?php

namespace App\Http\Controllers\API\Interlocutores;
use Illuminate\Support\Facades\DB;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Interlocutores\Contactos;
use App\Models\Parameters\Estados;
use App\Models\Parameters\Ciudades;

class ContactosController extends Controller
{
    //
    public function create(Request $request){
        try { 
          $insert['id_con']                 = $request['id_con'];
          $insert['idinterlocutor_con']     = $request['idinterlocutor_con'];
          $insert['identificacion_con']     = $request['identificacion_con'];
          $insert['primer_nombre_con']      = $request['primer_nombre_con'];
          $insert['segundo_nombre_con']     = $request['segundo_nombre_con'];
          $insert['primer_apellido_con']    = $request['primer_apellido_con'];
          $insert['segundo_apellido_con']   = $request['segundo_apellido_con'];
          $insert['ciudad_con']             = $request['ciudad_con'];
          $insert['direccion_con']          = $request['direccion_con'];
          $insert['telefono_con']           = $request['telefono_con'];
          $insert['email_con']              = $request['email_con'];
          $insert['fecha_creacion_con']     = $request['fecha_creacion_con'];
          $insert['fecha_modificacion_con'] = $request['fecha_modificacion_con'];
          $insert['estado_con']             = $request['estado_con'];
              
          Contactos::insert($insert);
      
          $response['message'] = "Contacto Grabado de forma correcta";
          $response['success'] = true;
      
        } catch (\Exception $e) {
            $response['message'] = $e->getMessage();
            $response['success'] = false;
        }
        return $response;
      }
    
      public function listar_contactos(){  
        try {
          //Muestra Unicamente los tipos de Contactos PROVEEDORES = 1
          $data = DB::select("SELECT t0.*, t1.nombre_est, t2.nombre_ciu
          FROM contactos as t0 INNER JOIN estados as t1 INNER JOIN ciudades as t2
          WHERE t0.estado_con = t1.id_est and t0.ciudad_con = t2.id_ciu");
  
    
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

      public function contactosinterlocutor($idinterlocutor_con){
        try { 
          //$data = Frecuencias::find($id_fre);
          $data = DB::select("SELECT t0.*, t1.nombre_est, t2.nombre_ciu
          FROM contactos as t0 INNER JOIN estados as t1 INNER JOIN ciudades as t2
          WHERE t0.estado_con = t1.id_est and t0.ciudad_con = t2.id_ciu and t0.idinterlocutor_con = $idinterlocutor_con");
  
          if ($data) {
              $response['data'] = $data;
              $response['message'] = "Load successful";
              $response['success'] = true;
          }
          else {
              $response['data'] = null;
              $response['message'] = "Not found data id_con => $id_con";
              $response['success'] = false;
          }
          } catch (\Exception $e) {
              $response['message'] = $e->getMessage();
              $response['success'] = false;
          }
          return $response;
      }
    
      public function get($id_con){
        try { 
          //$data = Frecuencias::find($id_fre);
          $data = DB::select("SELECT t0.*, t1.nombre_est, t2.nombre_ciu
          FROM contactos as t0 INNER JOIN estados as t1 INNER JOIN ciudades as t2
          WHERE t0.estado_con = t1.id_est and t0.ciudad_con = t2.id_ciu and t0.id_con = $id_con");
  
          if ($data) {
              $response['data'] = $data;
              $response['message'] = "Load successful";
              $response['success'] = true;
          }
          else {
              $response['data'] = null;
              $response['message'] = "Not found data id_con => $id_con";
              $response['success'] = false;
          }
          } catch (\Exception $e) {
              $response['message'] = $e->getMessage();
              $response['success'] = false;
          }
          return $response;
      }
    
      public function update(Request $request, $id_con){
        try {
          $data['id_con']                 = $request['id_con'];
          $data['idinterlocutor_con']     = $request['idinterlocutor_con'];
          $data['identificacion_con']     = $request['identificacion_con'];
          $data['primer_nombre_con']      = $request['primer_nombre_con'];
          $data['segundo_nombre_con']     = $request['segundo_nombre_con'];
          $data['primer_apellido_con']    = $request['primer_apellido_con'];
          $data['segundo_apellido_con']   = $request['segundo_apellido_con'];
          $data['ciudad_con']             = $request['ciudad_con'];
          $data['direccion_con']          = $request['direccion_con'];
          $data['telefono_con']           = $request['telefono_con'];
          $data['email_con']              = $request['email_con'];
          $insert['fecha_creacion_con']   = $request['fecha_creacion_con'];
          $data['fecha_modificacion_con'] = $request['fecha_modificacion_con'];
          $data['estado_con']             = $request['estado_con'];
    
          $res = Contactos::where("id_con",$id_con)->update($data);
    
          $response['res'] = $res;
          $response['message'] = "Updated successful";
          $response['success'] = true;
        } catch (\Exception $e) {
          $response['message'] = $e->getMessage();
          $response['success'] = false;
        }
        return $response;
      }
    
      public function delete($id_con){ 
        try {
          $res = Contactos::where("id_con",$id_con)->delete($id_con);
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

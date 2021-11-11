<?php

namespace App\Http\Controllers\API\Mantenimiento;
use Illuminate\Support\Facades\DB;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Mantenimiento\DatosHorometro;
use App\Models\Mantenimiento\Equipos;

class DatosHorometroController extends Controller
{
    //
        //
        public function create(Request $request){
            try { 
              $insert['id_dhr']             = $request['id_dhr'];
              $insert['codigoequipo_dhr']   = $request['codigoequipo_dhr'];
              $insert['valorhorometro_dhr'] = $request['valorhorometro_dhr'];
                  
              DatosHorometro::insert($insert);
          
              $response['message'] = "Datos Horometro Grabado de forma correcta";
              $response['success'] = true;
          
            } catch (\Exception $e) {
                $response['message'] = $e->getMessage();
                $response['success'] = false;
            }
            return $response;
        }
        
        public function listar_datoshorometro(){  
            try {
              
              $data = DB::select("SELECT t0.*, t1.codigo_equ, t1.descripcion_equ
              FROM datoshorometro as t0 INNER JOIN equipos as t1
              WHERE t0.codigoequipo_dhr = t1.id_equ");
      
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
        
        public function get($codigoequipo_dhr){
            try { 
              $data = DB::select("SELECT t0.*, t1.codigo_equ, t1.descripcion_equ
              FROM datoshorometro as t0 INNER JOIN equipos as t1
              WHERE t0.codigoequipo_dhr = t1.id_equ and t0.codigoequipo_dhr = $codigoequipo_dhr");
          
              if ($data) {
                  $response['data'] = $data;
                  $response['message'] = "Load successful";
                  $response['success'] = true;
              }
              else {
                  $response['data'] = null;
                  $response['message'] = "Not found data codigoequipo_dhr => $codigoequipo_dhr";
                  $response['success'] = false;
              }
              } catch (\Exception $e) {
                  $response['message'] = $e->getMessage();
                  $response['success'] = false;
              }
              return $response;
        }
        
        public function update(Request $request, $id_dhr){
            try {
              $data['id_dhr']             = $request['id_dhr'];
              $data['codigoequipo_dhr']   = $request['codigoequipo_dhr'];
              $data['valorhorometro_dhr'] = $request['valorhorometro_dhr'];
        
              $res = DatosHorometro::where("id_dhr",$id_dhr)->update($data);
        
              $response['res'] = $res;
              $response['message'] = "Updated successful";
              $response['success'] = true;
            } catch (\Exception $e) {
              $response['message'] = $e->getMessage();
              $response['success'] = false;
            }
            return $response;
        }
        
        public function delete($id_dhr){ 
            try {
              $res = DatosHorometro::where("id_dhr",$id_dhr)->delete($id_dhr);
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


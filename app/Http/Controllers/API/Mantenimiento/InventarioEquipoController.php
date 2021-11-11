<?php

namespace App\Http\Controllers\API\Mantenimiento;
use Illuminate\Support\Facades\DB;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Mantenimiento\InventarioEquipo;
use App\Models\Mantenimiento\Equipos;

class InventarioEquipoController extends Controller
{
    //
    public function create(Request $request){

        try {   
                $insert['id_inve']                   = $request['id_inve'];
                $insert['fechainventario_inve']      = $request['fechainventario_inve'];
                $insert['codigoequipo_inve']         = $request['codigoequipo_inve'];
                $insert['serieequipo_inve']          = $request['serieequipo_inve'];
                $insert['estadoequipo_inve']         = $request['estadoequipo_inve'];
                $insert['observacionequipo_inve']    = $request['observacionequipo_inve'];
                $insert['codigobateria_inve']        = $request['codigobateria_inve'];
                $insert['seriebateria_inve']         = $request['seriebateria_inve'];
                $insert['estadobateria_inve']        = $request['estadobateria_inve'];
                $insert['observacionbateria_inve']   = $request['observacionbateria_inve'];
                $insert['codigocargador_inve']       = $request['codigocargador_inve'];
                $insert['seriecargador_inve']        = $request['seriecargador_inve'];
                $insert['estadocargador_inve']       = $request['estadocargador_inve'];
                $insert['observacioncargador_inve']  = $request['observacioncargador_inve'];
  
                InventarioEquipo::insert($insert);
    
                $response['message'] = "Inventario Grabado de forma correcta";
                $response['success'] = true;
            }   catch (\Exception $e) {
                $response['message'] = $e->getMessage();
                $response['success'] = false;
        }       
        return $response;
    }
  
        public function listar_inventarioequipo(){
  
          try {
  
            $data = InventarioEquipo::get();
  
            $response['data'] = $data;
            $response['message'] = "load successful";
            $response['success'] = true;
    
          } catch (\Exception $e) {
            $response['message'] = $e->getMessage();
            $response['success'] = false;
          }
          return $response;
      }

      public function leerinventarioequipo($equipo_inve){
        try { 
          $data = DB::select("SELECT t0.*, t1.nombre_estcal, t2.descripcion_equ, t2.codigo_equ, t3.codigo_equ as codbateria,
                                     t4.codigo_equ as codcargador, t5.nombre_estcal as estadobateria, t6.nombre_estcal as estadocargador
          FROM inventarioequipo as t0 INNER JOIN estadoscalidad as t1 INNER JOIN equipos as t2 
                                      INNER JOIN vista_equiposbaterias   as t3 INNER JOIN vista_estadosbaterias   as t5
                                      INNER JOIN vista_equiposcargadores as t4 INNER JOIN vista_estadoscargadores as t6
          WHERE t0.codigoequipo_inve = $equipo_inve and t0.estadoequipo_inve = t1.id_estcal and t0.codigoequipo_inve = t2.id_equ 
            and t0.codigobateria_inve  = t3.id_equ    and t0.codigocargador_inve = t4.id_equ 
            and t0.estadocargador_inve = t6.id_estcal and t0.estadobateria_inve = t5.id_estcal");
      
          if ($data) {
              $response['data'] = $data;
              $response['message'] = "Load successful";
              $response['success'] = true;
          }
          else {
              $response['data'] = null;
              $response['message'] = "Not found data equipo_inve => $equipo_inve";
              $response['success'] = false;
          }
          } catch (\Exception $e) {
              $response['message'] = $e->getMessage();
              $response['success'] = false;
          }
          return $response;
      }
  
        public function get($codigoequipo_inve){
  
          try {
    
            $data = InventarioEquipo::find($codigoequipo_inve);
    
            if ($data) {
              $response['data'] = $data;
              $response['message'] = "Load successful";
              $response['success'] = true;
            }
            else {
              $response['data'] = null;
              $response['message'] = "Not found data codigoequipo_inve => $codigoequipo_inve";
              $response['success'] = false;
            }
    
          } catch (\Exception $e) {
            $response['message'] = $e->getMessage();
            $response['success'] = false;
          }
          return $response;
        }
  
        public function update(Request $request, $id_inve){
  
          try {
            $data['id_inve']                   = $request['id_inve'];
            $data['fechainventario_inve']      = $request['fechainventario_inve'];
            $data['codigoequipo_inve']         = $request['codigoequipo_inve'];
            $data['serieequipo_inve']          = $request['serieequipo_inve'];
            $data['estadoequipo_inve']         = $request['estadoequipo_inve'];
            $data['observacionequipo_inve']    = $request['observacionequipo_inve'];
            $data['codigobateria_inve']        = $request['codigobateria_inve'];
            $data['seriebateria_inve']         = $request['seriebateria_inve'];
            $data['estadobateria_inve']        = $request['estadobateria_inve'];
            $data['observacionbateria_inve']   = $request['observacionbateria_inve'];
            $data['codigocargador_inve']       = $request['codigocargador_inve'];
            $data['seriecargador_inve']        = $request['seriecargador_inve'];
            $data['estadocargador_inve']       = $request['estadocargador_inve'];
            $data['observacioncargador_inve']  = $request['observacioncargador_inve'];

            $res = InventarioEquipo::where("id_inve", $id_inve)->update($data);
  
            $response['res'] = $res;
            $response['message'] = "Updated successful";
            $response['success'] = true;
    
          } catch (\Exception $e) {
            $response['message'] = $e->getMessage();
            $response['success'] = false;
          }
          return $response;
    
        }
  
        public function delete($id_inve){
  
        try {
                $res = InventarioEquipo::where("id_inve",$id_inve)->delete($id_inve);
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

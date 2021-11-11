<?php

namespace App\Http\Controllers\API\Mantenimiento;
use Illuminate\Support\Facades\DB;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Mantenimiento\EstadosCalidad;
use App\Models\Parameters\Empresa;

class EstadosCalidadController extends Controller
{
    //
    public function create(Request $request){

        try {
            $insert['nombre_estcal']      = $request['nombre_estcal'];
            $insert['empresa_estcal']     = $request['empresa_estcal'];
            $insert['observacion_estcal'] = $request['observacion_estcal'];
  
            EstadosCalidad::insert($insert);
    
            $response['message'] = "Estado de Calidad Grabado de forma correcta";
            $response['success'] = true;
    
          } catch (\Exception $e) {
            $response['message'] = $e->getMessage();
            $response['success'] = false;
          }
           
          return $response;
        }
  
        public function listar_estadoscalidad(){
  
          try {
  
            $data = DB::select("SELECT t0.*, t1.nombre_emp
            FROM estadoscalidad as t0 INNER JOIN empresa as t1
            WHERE t0.empresa_estcal = t1.id_emp");
  
            $response['data'] = $data;
            $response['message'] = "load successful";
            $response['success'] = true;
    
          } catch (\Exception $e) {
            $response['message'] = $e->getMessage();
            $response['success'] = false;
          }
          return $response;
        }
  
        public function get($id_estcal){
  
          try {
    
            $data = DB::select("SELECT t0.*, t1.nombre_emp
            FROM estadoscalidad t0 INNER JOIN empresa as t1
            WHERE t0.empresa_estcal = t1.id_emp and t0.id_estcal = $id_estcal");
    
            if ($data) {
              $response['data'] = $data;
              $response['message'] = "Load successful";
              $response['success'] = true;
            }
            else {
              $response['data'] = null;
              $response['message'] = "Not found data id_estcal => $id_estcal";
              $response['success'] = false;
            }
    
          } catch (\Exception $e) {
            $response['message'] = $e->getMessage();
            $response['success'] = false;
          }
          return $response;
        }
  
        public function update(Request $request, $id_estcal){
  
          try {
            $data['nombre_estcal']      = $request['nombre_estcal'];
            $data['empresa_estcal']     = $request['empresa_estcal'];
            $data['observacion_estcal'] = $request['observacion_estcal'];
            //Console::info('mymessage');
  
            $res = EstadosCalidad::where("id_estcal",$id_estcal)->update($data);
  
            $response['res'] = $res;
            $response['message'] = "Updated successful";
            $response['success'] = true;
    
          } catch (\Exception $e) {
            $response['message'] = $e->getMessage();
            $response['success'] = false;
          }
          return $response;
    
        }
  
        public function delete($id_estcal){
  
          try {
            $res = EstadosCalidad::where("id_estcal",$id_estcal)->delete($id_estcal);
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

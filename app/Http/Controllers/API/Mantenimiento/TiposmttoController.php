<?php

namespace App\Http\Controllers\API\Mantenimiento;
use Illuminate\Support\Facades\DB;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Mantenimiento\Tiposmtto;
use App\Models\Parameters\Empresa;
use App\Models\Parameters\Estados;

class TiposmttoController extends Controller
{
    //
    public function create(Request $request){

        try {     
            $insert['descripcion_tmt']  = $request['descripcion_tmt'];
            $insert['empresa_tmt']      = $request['empresa_tmt'];
            $insert['estado_tmt']       = $request['estado_tmt'];
           
            Tiposmtto::insert($insert);
    
            $response['message'] = "Tipo de Mantenimiento Grabado de forma correcta";
            $response['success'] = true;
    
          } catch (\Exception $e) {
            $response['message'] = $e->getMessage();
            $response['success'] = false;
          }
           
          return $response;
        }
  
        public function listar_tiposmtto(){
  
          try {
            //$data = Tiposmtto::with("empresa")->get();
            $data = DB::select("SELECT t0.*, t1.nombre_emp, t2.nombre_est
            FROM tiposmantenimiento as t0 INNER JOIN empresa as t1 INNER JOIN estados as t2
            WHERE t0.empresa_tmt = t1.id_emp and t0.estado_tmt = t2.id_est ");
  
            $response['data'] = $data;
            $response['message'] = "load successful";
            $response['success'] = true;
    
          } catch (\Exception $e) {
            $response['message'] = $e->getMessage();
            $response['success'] = false;
          }
          return $response;
        }

        public function listar_tiposmttoOT(){
          try {
            //$data = Tiposmtto::with("empresa")->get();
            $data = DB::select("SELECT t0.*, t1.nombre_emp, t2.nombre_est
            FROM tiposmantenimiento as t0 INNER JOIN empresa as t1 INNER JOIN estados as t2
            WHERE t0.empresa_tmt = t1.id_emp and t0.estado_tmt = t2.id_est and id_tmt IN (2,3)");
  
            $response['data'] = $data;
            $response['message'] = "load successful";
            $response['success'] = true;
    
          } catch (\Exception $e) {
            $response['message'] = $e->getMessage();
            $response['success'] = false;
          }
          return $response;
        }

        public function listar_tiposmttoalistamiento(){
          try {
            //$data = Tiposmtto::with("empresa")->get();
            $data = DB::select("SELECT t0.*, t1.nombre_emp, t2.nombre_est
            FROM tiposmantenimiento as t0 INNER JOIN empresa as t1 INNER JOIN estados as t2
            WHERE t0.empresa_tmt = t1.id_emp and t0.estado_tmt = t2.id_est and id_tmt IN (1)");
  
            $response['data'] = $data;
            $response['message'] = "load successful";
            $response['success'] = true;
    
          } catch (\Exception $e) {
            $response['message'] = $e->getMessage();
            $response['success'] = false;
          }
          return $response;
        }
  
        public function get($id_tmt){
  
          try {
            //$data = Tiposmtto::find($id_tmt);
            $data = DB::select("SELECT t0.*, t1.nombre_emp, t2.nombre_est
            FROM tiposmantenimiento as t0 INNER JOIN empresa as t1 INNER JOIN estados as t2
            WHERE t0.id_tmt = $id_tmt and t0.empresa_tmt = t1.id_emp and t0.estado_tmt = t2.id_est");
    
            if ($data) {
              $response['data'] = $data;
              $response['message'] = "Load successful";
              $response['success'] = true;
            }
            else {
              $response['data'] = null;
              $response['message'] = "Not found data id_tmt => $id_tmt";
              $response['success'] = false;
            }
    
          } catch (\Exception $e) {
            $response['message'] = $e->getMessage();
            $response['success'] = false;
          }
          return $response;
        }
  
        public function update(Request $request, $id_tmt){
  
          try {
            $data['descripcion_tmt'] = $request['descripcion_tmt'];
            $data['empresa_tmt']     = $request['empresa_tmt'];
            $data['estado_tmt']      = $request['estado_tmt'];
  
            //Console::info('mymessage');
  
            $res = Tiposmtto::where("id_tmt",$id_tmt)->update($data);
  
            $response['res'] = $res;
            $response['message'] = "Updated successful";
            $response['success'] = true;
    
          } catch (\Exception $e) {
            $response['message'] = $e->getMessage();
            $response['success'] = false;
          }
          return $response;
    
        }
  
        public function delete($id_tmt){
  
          try {
            $res = Tiposmtto::where("id_tmt",$id_tmt)->delete($id_tmt);
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

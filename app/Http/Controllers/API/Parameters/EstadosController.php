<?php

namespace App\Http\Controllers\API\Parameters;
use Illuminate\Support\Facades\DB;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Parameters\Estados;
use App\Models\GestionOrdenes\TipoOperacion;

class EstadosController extends Controller
{
    //
    public function create(Request $request){

        try {
            $insert['nombre_est']        = $request['nombre_est'];
            $insert['tipooperacion_est'] = $request['tipooperacion_est'];
            $insert['empresa_est']       = $request['empresa_est'];
            $insert['observacion_est']   = $request['observacion_est'];
  
            Estados::insert($insert);
    
            $response['message'] = "Estado Grabado de forma correcta";
            $response['success'] = true;
    
          } catch (\Exception $e) {
            $response['message'] = $e->getMessage();
            $response['success'] = false;
          }
           
          return $response;
        }
  
        public function listar_estados(){
  
          try {
  
            $data = DB::select("SELECT t0.*, t1.nombre_emp, t2.descripcion_test
            FROM estados as t0 INNER JOIN empresa as t1 INNER JOIN tiposdeestados as t2
            WHERE t0.empresa_est = t1.id_emp and t0.tipooperacion_est = t2.id_test");
  
            $response['data'] = $data;
            $response['message'] = "load successful";
            $response['success'] = true;
    
          } catch (\Exception $e) {
            $response['message'] = $e->getMessage();
            $response['success'] = false;
          }
          return $response;
        }

        public function listar_estadosgenerales(){  
          try {
            
            $data = DB::select("SELECT t0.*, t1.nombre_emp, t2.descripcion_test
            FROM estados as t0 INNER JOIN empresa as t1 INNER JOIN tiposdeestados as t2
            WHERE t0.empresa_est = t1.id_emp and t0.tipooperacion_est = t2.id_test and t0.tipooperacion_est = 3");
    
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

        public function listar_estadospendientes(){  
          try {
            
            $data = DB::select("SELECT t0.*, t1.nombre_emp, t2.descripcion_test
            FROM estados as t0 INNER JOIN empresa as t1 INNER JOIN tiposdeestados as t2
            WHERE t0.empresa_est = t1.id_emp and t0.tipooperacion_est = t2.id_test and t0.tipooperacion_est = 9");
    
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

        public function listar_estadosOT(){  
          try {
            
            $data = DB::select("SELECT t0.*, t1.nombre_emp, t2.descripcion_test
            FROM estados as t0 INNER JOIN empresa as t1  INNER JOIN tiposdeestados as t2
            WHERE t0.empresa_est = t1.id_emp and t0.tipooperacion_est = t2.id_test and t0.tipooperacion_est = 1");
    
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

        public function listar_estadoscontratos(){  
          try {
            
            $data = DB::select("SELECT t0.*, t1.nombre_emp, t2.descripcion_test
            FROM estados as t0 INNER JOIN empresa as t1  INNER JOIN tiposdeestados as t2
            WHERE t0.empresa_est = t1.id_emp and t0.tipooperacion_est = t2.id_test and t0.tipooperacion_est = 4");
    
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

        public function listar_estadosseguros(){  
          try {
            
            $data = DB::select("SELECT t0.*, t1.nombre_emp, t2.descripcion_test
            FROM estados as t0 INNER JOIN empresa as t1  INNER JOIN tiposdeestados as t2
            WHERE t0.empresa_est = t1.id_emp and t0.tipooperacion_est = t2.id_test and t0.tipooperacion_est = 5");
    
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
  
  
        public function listar_estadosequipos(){  
          try {
            
            $data = DB::select("SELECT t0.*, t1.nombre_emp, t2.descripcion_test
            FROM estados as t0 INNER JOIN empresa as t1  INNER JOIN tiposdeestados as t2
            WHERE t0.empresa_est = t1.id_emp and t0.tipooperacion_est = t2.id_test and t0.tipooperacion_est = 2");
    
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

        public function listar_estadosequipooperacion(){  
          try {
            
            $data = DB::select("SELECT t0.*, t1.nombre_emp, t2.descripcion_test
            FROM estados as t0 INNER JOIN empresa as t1  INNER JOIN tiposdeestados as t2
            WHERE t0.empresa_est = t1.id_emp and t0.tipooperacion_est = t2.id_test and t0.tipooperacion_est = 8");
    
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
  
        public function get($id_est){
  
          try {
    
            $data = DB::select("SELECT t0.*, t1.nombre_emp, t2.descripcion_test
            FROM estados as t0 INNER JOIN empresa as t1 INNER JOIN tiposdeestados as t2
            WHERE t0.empresa_est = t1.id_emp and t0.tipooperacion_est = t2.id_test and t0.id_est = $id_est");
    
            if ($data) {
              $response['data'] = $data;
              $response['message'] = "Load successful";
              $response['success'] = true;
            }
            else {
              $response['data'] = null;
              $response['message'] = "Not found data id_est => $id_est";
              $response['success'] = false;
            }
    
          } catch (\Exception $e) {
            $response['message'] = $e->getMessage();
            $response['success'] = false;
          }
          return $response;
        }
  
        public function update(Request $request, $id_est){
  
          try {
            $data['nombre_est']        = $request['nombre_est'];
            $data['tipooperacion_est'] = $request['tipooperacion_est'];
            $data['empresa_est']       = $request['empresa_est'];
            $data['observacion_est']   = $request['observacion_est'];
  
            //Console::info('mymessage');
  
            $res = Estados::where("id_est",$id_est)->update($data);
  
            $response['res'] = $res;
            $response['message'] = "Updated successful";
            $response['success'] = true;
    
          } catch (\Exception $e) {
            $response['message'] = $e->getMessage();
            $response['success'] = false;
          }
          return $response;
    
        }
  
        public function delete($id_est){
  
          try {
            $res = Estados::where("id_est",$id_est)->delete($id_est);
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

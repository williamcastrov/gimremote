<?php

namespace App\Http\Controllers\API\Mantenimiento;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Mantenimiento\EstadosMtto;

class EstadosMttoController extends Controller
{
    //
    public function create(Request $request){

        try {
            $insert['nombre_estmtto']      = $request['nombre_estmtto'];
            $insert['empresa_estmtto']     = $request['empresa_estmtto'];
            $insert['observacion_estmtto'] = $request['observacion_estmtto'];
  
            EstadosMtto::insert($insert);
    
            $response['message'] = "Estado de Mantenimiento Grabado de forma correcta";
            $response['success'] = true;
    
          } catch (\Exception $e) {
            $response['message'] = $e->getMessage();
            $response['success'] = false;
          }
           
          return $response;
    }
  
    public function listar_estadosmtto(){
  
        try {
  
            $data = EstadosMtto::with("empresa")->get();
  
            $response['data'] = $data;
            $response['message'] = "load successful";
            $response['success'] = true;
    
        } catch (\Exception $e) {
            $response['message'] = $e->getMessage();
            $response['success'] = false;
        }
          return $response;
    }
  
    public function get($id_estmtto){
  
        try {
    
            $data = EstadosMtto::find($id_estmtto);
    
            if ($data) {
              $response['data'] = $data;
              $response['message'] = "Load successful";
              $response['success'] = true;
            }
            else {
              $response['data'] = null;
              $response['message'] = "Not found data id_estmtto => $id_estmtto";
              $response['success'] = false;
            }
    
            } catch (\Exception $e) {
                $response['message'] = $e->getMessage();
                $response['success'] = false;
            }
            return $response;
        }
  
        public function update(Request $request, $id_estmtto){
  
            try {
                $data['nombre_estmtto']      = $request['nombre_estmtto'];
                $data['empresa_estmtto']     = $request['empresa_estmtto'];
                $data['observacion_estmtto'] = $request['observacion_estmtto'];
  
                $res = EstadosMtto::where("id_estmtto",$id_estmtto)->update($data);
  
                $response['res'] = $res;
                $response['message'] = "Updated successful";
                $response['success'] = true;
    
            } catch (\Exception $e) {
                $response['message'] = $e->getMessage();
                $response['success'] = false;
            }
            return $response;
        }
  
    public function delete($id_estmtto){
  
        try {
            $res = EstadosMtto::where("id_estmtto",$id_estmtto)->delete($id_estmtto);
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

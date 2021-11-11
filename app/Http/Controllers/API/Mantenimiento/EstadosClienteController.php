<?php

namespace App\Http\Controllers\API\Mantenimiento;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Mantenimiento\EstadosCliente;

class EstadosClienteController extends Controller
{
    //
    public function create(Request $request){

        try {
            $insert['nombre_estcli']      = $request['nombre_estcli'];
            $insert['empresa_estcli']     = $request['empresa_estcli'];
            $insert['observacion_estcli'] = $request['observacion_estcli'];
  
            EstadosCliente::insert($insert);
    
            $response['message'] = "Estado del Cliente Grabado de forma correcta";
            $response['success'] = true;
    
          } catch (\Exception $e) {
            $response['message'] = $e->getMessage();
            $response['success'] = false;
          }
           
          return $response;
    }
  
    public function listar_estadosclientes(){
  
        try {
  
            $data = EstadosCliente::with("empresa")->get();
  
            $response['data'] = $data;
            $response['message'] = "load successful";
            $response['success'] = true;
    
        } catch (\Exception $e) {
            $response['message'] = $e->getMessage();
            $response['success'] = false;
        }
          return $response;
    }
  
    public function get($id_estcli){
  
        try {
    
            $data = EstadosCliente::find($id_estcli);
    
            if ($data) {
              $response['data'] = $data;
              $response['message'] = "Load successful";
              $response['success'] = true;
            }
            else {
              $response['data'] = null;
              $response['message'] = "Not found data id_estcli => $id_estcli";
              $response['success'] = false;
            }
    
            } catch (\Exception $e) {
                $response['message'] = $e->getMessage();
                $response['success'] = false;
            }
            return $response;
        }
  
        public function update(Request $request, $id_estcli){
  
            try {
                $data['nombre_estcli']      = $request['nombre_estcli'];
                $data['empresa_estcli']     = $request['empresa_estcli'];
                $data['observacion_estcli'] = $request['observacion_estcli'];
  
            //Console::info('mymessage');
  
                $res = EstadosCliente::where("id_estcli",$id_estcli)->update($data);
  
                $response['res'] = $res;
                $response['message'] = "Updated successful";
                $response['success'] = true;
    
            } catch (\Exception $e) {
                $response['message'] = $e->getMessage();
                $response['success'] = false;
            }
            return $response;
        }
  
    public function delete($id_estcli){
  
        try {
            $res = EstadosCliente::where("id_estcli",$id_estcli)->delete($id_estcli);
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

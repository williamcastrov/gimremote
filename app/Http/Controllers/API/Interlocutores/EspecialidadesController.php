<?php

namespace App\Http\Controllers\API\Interlocutores;
use Illuminate\Support\Facades\DB;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Interlocutores\Especialidades;
use App\Models\Parameters\Empresa;
use App\Models\Parameters\Estados;

class EspecialidadesController extends Controller
{
    //
    public function create(Request $request){

        try {
            $insert['descripcion_esp'] = $request['descripcion_esp'];
            $insert['empresa_esp'] = $request['empresa_esp'];
            $insert['estado_esp'] = $request['estado_esp'];
  
            Especialidades::insert($insert);
    
            $response['message'] = "Especialidad del Interlocutor Grabada de forma correcta";
            $response['success'] = true;
    
          } catch (\Exception $e) {
            $response['message'] = $e->getMessage();
            $response['success'] = false;
          }
           
          return $response;
    }
  
    public function listar_especialidades(){
  
        try {
            //$data = Especialidades::with("empresa")->get();
            $data = DB::select("SELECT t0.*, t1.nombre_emp, t2.nombre_est 
            FROM especialidades_int as t0 INNER JOIN empresa as t1 INNER JOIN estados as t2 
            WHERE t0.empresa_esp = t1.id_emp and t0.estado_esp = t2.id_est" );
  
            $response['data'] = $data;
            $response['message'] = "load successful";
            $response['success'] = true;
    
        } catch (\Exception $e) {
            $response['message'] = $e->getMessage();
            $response['success'] = false;
        }
        return $response;
    }
  
    public function get($id_esp){
  
        try {    
            //$data = Especialidades::find($id_esp);
            $data = DB::select("SELECT t0.*, t1.nombre_emp, t2.nombre_est 
            FROM especialidades_int as t0 INNER JOIN empresa as t1 INNER JOIN estados as t2 
            WHERE t0.id_esp = $id_esp and t0.empresa_esp = t1.id_emp and t0.estado_esp = t2.id_est" );
    
            if ($data) {
              $response['data'] = $data;
              $response['message'] = "Load successful";
              $response['success'] = true;
            }
            else {
              $response['data'] = null;
              $response['message'] = "Not found data id_esp => $id_esp";
              $response['success'] = false;
            }
    
        } catch (\Exception $e) {
            $response['message'] = $e->getMessage();
            $response['success'] = false;
        }
        return $response;
    }
  
    public function update(Request $request, $id_esp){
  
          try {
            $data['descripcion_esp'] = $request['descripcion_esp'];
            $data['empresa_esp'] = $request['empresa_esp'];
            $data['estado_esp'] = $request['estado_esp'];
  
            //Console::info('mymessage');
  
            $res = Especialidades::where("id_esp",$id_esp)->update($data);
  
            $response['res'] = $res;
            $response['message'] = "Updated successful";
            $response['success'] = true;
    
          } catch (\Exception $e) {
            $response['message'] = $e->getMessage();
            $response['success'] = false;
          }
          return $response;
    
        }
  
        public function delete($id_esp){
  
          try {
            $res = Especialidades::where("id_esp",$id_esp)->delete($id_esp);
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

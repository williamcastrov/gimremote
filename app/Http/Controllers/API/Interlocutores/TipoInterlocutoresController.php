<?php

namespace App\Http\Controllers\API\Interlocutores;
use Illuminate\Support\Facades\DB;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Interlocutores\TipoInterlocutores;
use App\Models\Parameters\Empresa;
use App\Models\Parameters\Estados;

class TipoInterlocutoresController extends Controller
{
    //
    public function create(Request $request){

        try {
            $insert['descripcion_tint'] = $request['descripcion_tint'];
            $insert['empresa_tint']     = $request['empresa_tint'];
            $insert['estado_tint']      = $request['estado_tint'];
  
            TipoInterlocutores::insert($insert);
    
            $response['message'] = "Tipo de Interlocutor Creado de forma correcta";
            $response['success'] = true;
    
          } catch (\Exception $e) {
            $response['message'] = $e->getMessage();
            $response['success'] = false;
          }
           
          return $response;
        }
  
        public function listar_tipointerlocutor(){
  
          try {
            //$data = TipoInterlocutores::with("empresa")->get();

            $data = DB::select("SELECT t0.*, t1.nombre_emp, t2.nombre_est 
            FROM tipo_interlocutor as t0 INNER JOIN empresa as t1 INNER JOIN estados as t2 
            WHERE t0.empresa_tint = t1.id_emp and t0.estado_tint = t2.id_est" );
  
            $response['data'] = $data;
            $response['message'] = "load successful";
            $response['success'] = true;
    
          } catch (\Exception $e) {
            $response['message'] = $e->getMessage();
            $response['success'] = false;
          }
          return $response;
      }
  
        public function get($id_tint){
  
          try {
            //$data = TipoInterlocutores::find($id_tint);
            
            $data = DB::select("SELECT t0.*, t1.nombre_emp, t2.nombre_est 
            FROM tipo_interlocutor as t0 INNER JOIN empresa as t1 INNER JOIN estados as t2 
            WHERE t0.id_tint = $id_tint and t0.empresa_tint = t1.id_emp and t0.estado_tint = t2.id_est" );
    
            if ($data) {
              $response['data'] = $data;
              $response['message'] = "Load successful";
              $response['success'] = true;
            }
            else {
              $response['data'] = null;
              $response['message'] = "Not found data id_tint => $id_tint";
              $response['success'] = false;
            }
    
          } catch (\Exception $e) {
            $response['message'] = $e->getMessage();
            $response['success'] = false;
          }
          return $response;
        }
  
        public function update(Request $request, $id_tint){
  
          try {
            $data['descripcion_tint'] = $request['descripcion_tint'];
            $data['empresa_tint']     = $request['empresa_tint'];
            $data['estado_tint']      = $request['estado_tint'];

            //Console::info('mymessage');
  
            $res = TipoInterlocutores::where("id_tint",$id_tint)->update($data);
  
            $response['res'] = $res;
            $response['message'] = "Updated successful";
            $response['success'] = true;
    
          } catch (\Exception $e) {
            $response['message'] = $e->getMessage();
            $response['success'] = false;
          }
          return $response;
    
        }
  
        public function delete($id_tint){
  
          try {
            $res = TipoInterlocutores::where("id_tint",$id_tint)->delete($id_tint);
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

<?php

namespace App\Http\Controllers\API\Parameters;
use Illuminate\Support\Facades\DB;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Parameters\Ciudades;

class CiudadesController extends Controller
{
    //
    public function create(Request $request){

        try {
      
            $insert['codigo_ciu'] = $request['codigo_ciu'];
            $insert['codigointerno_ciu'] = $request['codigointerno_ciu'];
            $insert['nombre_ciu'] = $request['nombre_ciu'];
            $insert['departamento_ciu'] = $request['departamento_ciu'];
  
            Ciudades::insert($insert);
    
            $response['message'] = "Ciudad Grabada de forma correcta";
            $response['success'] = true;
    
          } catch (\Exception $e) {
            $response['message'] = $e->getMessage();
            $response['success'] = true;
          }
           
          return $response;
        }
  
        public function listar_ciudades(){
  
          try {
  
            $data = DB::select("SELECT t0.*, t1.nombre_dep
            FROM ciudades as t0 INNER JOIN departamentos as t1
            WHERE t0.departamento_ciu = t1.codigo_dep
            ORDER BY nombre_ciu ASC");
  
            $response['data'] = $data;
            $response['message'] = "load successful";
            $response['success'] = true;
    
          } catch (\Exception $e) {
            $response['message'] = $e->getMessage();
            $response['success'] = false;
          }
          return $response;
      }
  
        public function get($id_ciu){
  
          try {

            $data = DB::select("SELECT t0.*, t1.nombre_dep
            FROM ciudades as t0 INNER JOIN departamentos as t1
            WHERE t0.departamento_ciu = t1.codigo_dep and t0.id_ciu = $id_ciu
            ORDER BY nombre_ciu ASC");
    
            if ($data) {
              $response['data'] = $data;
              $response['message'] = "Load successful";
              $response['success'] = true;
            }
            else {
              $response['data'] = null;
              $response['message'] = "Not found data id_ciu => $id_ciu";
              $response['success'] = false;
            }
    
          } catch (\Exception $e) {
            $response['message'] = $e->getMessage();
            $response['success'] = false;
          }
          return $response;
        }
  
        public function update(Request $request, $id_ciu){
  
          try {
          
            $data['codigo_ciu'] = $request['codigo_ciu'];
            $data['codigointerno_ciu'] = $request['codigointerno_ciu'];
            $data['nombre_ciu'] = $request['nombre_ciu'];
            $data['departamento_ciu'] = $request['departamento_ciu'];
  
            //Console::info('mymessage');
  
            $res = Ciudades::where("id_ciu",$id_ciu)->update($data);
  
            $response['res'] = $res;
            $response['message'] = "Updated successful";
            $response['success'] = true;
    
          } catch (\Exception $e) {
            $response['message'] = $e->getMessage();
            $response['success'] = false;
          }
          return $response;
    
        }
  
        public function delete($id_ciu){
  
          try {
            $res = Ciudades::where("id_ciu",$id_ciu)->delete($id_ciu);
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

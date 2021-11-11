<?php

namespace App\Http\Controllers\API\Parameters;
use Illuminate\Support\Facades\DB;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Parameters\Departamentos;

class DepartamentosController extends Controller
{
    //
    public function create(Request $request){

        try {
      
            $insert['codigo_dep'] = $request['codigo_dep'];
            $insert['nombre_dep'] = $request['nombre_dep'];
            $insert['region_dep'] = $request['region_dep'];
  
            Departamentos::insert($insert);
    
            $response['message'] = "Departamento Grabado de forma correcta";
            $response['success'] = true;
    
          } catch (\Exception $e) {
            $response['message'] = $e->getMessage();
            $response['success'] = false;
          }
           
          return $response;
      }
  
      public function listar_departamentos(){
  
          try {
       
            $data = DB::select("SELECT t0.*, t1.nombre_reg
            FROM departamentos as t0 INNER JOIN regiones as t1
            WHERE t0.region_dep = t1.id_reg
            ORDER BY nombre_dep ASC");
  
            $response['data'] = $data;
            $response['message'] = "load successful";
            $response['success'] = true;
    
          } catch (\Exception $e) {
            $response['message'] = $e->getMessage();
            $response['success'] = false;
          }
          return $response;
      }
  
      public function get($codigo_dep){
  
          try {
    
            $data = Departamentos::find($codigo_dep);
    
            if ($data) {
              $response['data'] = $data;
              $response['message'] = "Load successful";
              $response['success'] = true;
            }
            else {
              $response['data'] = null;
              $response['message'] = "Not found data codigo_dep => $codigo_dep";
              $response['success'] = false;
            }
    
          } catch (\Exception $e) {
            $response['message'] = $e->getMessage();
            $response['success'] = false;
          }
          return $response;
      }
  
      public function update(Request $request, $codigo_dep){
  
          try {
          
            $data['codigo_dep'] = $request['codigo_dep'];
            $data['nombre_dep'] = $request['nombre_dep'];
            $data['region_dep'] = $request['region_dep'];
            
            //Console::info('mymessage');
  
            $res = Departamentos::where("codigo_dep",$codigo_dep)->update($data);
  
            $response['res'] = $res;
            $response['message'] = "Updated successful";
            $response['success'] = true;
    
          } catch (\Exception $e) {
            $response['message'] = $e->getMessage();
            $response['success'] = false;
          }
          return $response;
    
      }
  
      public function delete($codigo_dep){
  
          try {
            $res = Departamentos::where("codigo_dep",$codigo_dep)->delete($codigo_dep);
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

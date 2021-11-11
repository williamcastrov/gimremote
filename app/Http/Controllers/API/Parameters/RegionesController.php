<?php

namespace App\Http\Controllers\API\Parameters;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Parameters\Regiones;

class RegionesController extends Controller
{
    //
    public function create(Request $request){

        try {
            $insert['nombre_reg'] = $request['nombre_reg'];
            $insert['pais_reg'] = $request['pais_reg'];
  
            Regiones::insert($insert);
    
            $response['message'] = "Region Grabada de forma correcta";
            $response['success'] = true;
        }   catch (\Exception $e) {
            $response['message'] = $e->getMessage();
            $response['success'] = true;
        }
           
        return $response;
    }
  
      public function listar_regiones(){
  
          try {
  
            $data = Regiones::with("pais")->get();
            
            $response['data'] = $data;
            $response['message'] = "load successful";
            $response['success'] = true;
    
          } catch (\Exception $e) {
            $response['message'] = $e->getMessage();
            $response['success'] = false;
          }
          return $response;
      }
  
      public function get($id_reg){
  
          try {
    
            $data = Regiones::find($id_reg);
    
            if ($data) {
              $response['data'] = $data;
              $response['message'] = "Load successful";
              $response['success'] = true;
            }
            else {
              $response['data'] = null;
              $response['message'] = "Not found data id_reg => $id_reg";
              $response['success'] = false;
            }
    
          } catch (\Exception $e) {
            $response['message'] = $e->getMessage();
            $response['success'] = false;
          }
          return $response;
      }
  
      public function update(Request $request, $id_reg){
  
          try {
            $data['nombre_reg'] = $request['nombre_reg'];
            $data['pais_reg'] = $request['pais_reg'];
            
            //Console::info('mymessage');
  
            $res = Regiones::where("id_reg",$id_reg)->update($data);
  
            $response['res'] = $res;
            $response['message'] = "Updated successful";
            $response['success'] = true;
    
          } catch (\Exception $e) {
            $response['message'] = $e->getMessage();
            $response['success'] = false;
          }
          return $response;
    
      }
  
      public function delete($id_reg){
  
          try {
            $res = Regiones::where("id_reg",$id_reg)->delete($id_reg);
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

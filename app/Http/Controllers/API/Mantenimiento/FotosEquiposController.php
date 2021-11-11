<?php

namespace App\Http\Controllers\API\Mantenimiento;
use Illuminate\Support\Facades\DB;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Mantenimiento\Equipos;
use App\Models\Mantenimiento\FotosEquipos;

class FotosEquiposController extends Controller
{
    //
    public function create(Request $request){
        try { 
          $insert['id']         = $request['id'];
          $insert['type']       = $request['type'];
          $insert['name']       = $request['name'];
          $insert['nombrefoto'] = $request['nombrefoto'];
          $insert['fechafoto']  = $request['fechafoto'];
          $insert['url']        = $request['url'];
          $insert['codigoequipo']   = $request['codigoequipo'];
              
          FotosEquipos::insert($insert);
      
          $response['message'] = "Contrato OT Grabado de forma correcta";
          $response['success'] = true;
      
        } catch (\Exception $e) {
            $response['message'] = $e->getMessage();
            $response['success'] = false;
        }
        return $response;
      }

      public function listar_fotosequipos($codigoequipo){  
        try {

            $data = DB::select("SELECT t0.*
            FROM  fotosequipos as t0
            WHERE t0.codigoequipo = $codigoequipo");
  
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
    
      public function update(Request $request, $id){
        try {
            $data['id']         = $request['id'];
            $data['type']       = $request['type'];
            $data['name']       = $request['name'];
            $data['nombrefoto'] = $request['nombrefoto'];
            $data['fechafoto']  = $request['fechafoto'];
            $data['url']        = $request['url'];
            $data['codigoequipo']   = $request['codigoequipo'];
       
          $res = FotosEquipos::where("id",$id)->update($data);
    
          $response['res'] = $res;
          $response['message'] = "Updated successful";
          $response['success'] = true;
        } catch (\Exception $e) {
          $response['message'] = $e->getMessage();
          $response['success'] = false;
        }
        return $response;
      }
    
      public function delete($id){ 
        try {
          $res = FotosEquipos::where("id",$id)->delete($id);
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

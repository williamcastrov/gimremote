<?php

namespace App\Http\Controllers\API\GestionOrdenes;
use Illuminate\Support\Facades\DB;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\GestionOrdenes\CalificacionServicioOT;
use App\Models\GestionOrdenes\Ordenes;

class CalificacionServicioOTController extends Controller
{
    //
    public function create(Request $request){

        try {   
                $insert['ot_cse']           = $request['ot_cse'];
                $insert['valorservicio_cse'] = $request['valorservicio_cse'];
                
                CalificacionServicioOT::insert($insert);
    
                $response['message'] = "Grabado de forma correcta";
                $response['success'] = true;
            }   catch (\Exception $e) {
                $response['message'] = $e->getMessage();
                $response['success'] = false;
        }       
        return $response;
    }
  
        public function listar_calificacionservcioot(){
  
          try {
  
            $data = CalificacionServicioOT::get();
  
            $response['data'] = $data;
            $response['message'] = "load successful";
            $response['success'] = true;
    
          } catch (\Exception $e) {
            $response['message'] = $e->getMessage();
            $response['success'] = false;
          }
          return $response;
      }
  
        public function get($ot_cse){
  
          try {
    
            $data = CalificacionServicioOT::find($ot_cse);
    
            if ($data) {
              $response['data'] = $data;
              $response['message'] = "Load successful";
              $response['success'] = true;
            }
            else {
              $response['data'] = null;
              $response['message'] = "Not found data ot_cse => $ot_cse";
              $response['success'] = false;
            }
    
          } catch (\Exception $e) {
            $response['message'] = $e->getMessage();
            $response['success'] = false;
          }
          return $response;
        }
  
        public function update(Request $request, $ot_cse){
  
          try {
            $data['ot_cse']            = $request['ot_cse'];
            $data['valorservicio_cse'] = $request['valorservicio_cse'];
           
            $res = CalificacionServicioOT::where("ot_cse",$ot_cse)->update($data);
  
            $response['res'] = $res;
            $response['message'] = "Updated successful";
            $response['success'] = true;
    
          } catch (\Exception $e) {
            $response['message'] = $e->getMessage();
            $response['success'] = false;
          }
          return $response;
    
        }
  
        public function delete($ot_cse){
  
        try {
                $res = CalificacionServicioOT::where("ot_cse",$ot_cse)->delete($ot_cse);
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

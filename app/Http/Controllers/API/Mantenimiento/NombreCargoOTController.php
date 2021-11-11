<?php

namespace App\Http\Controllers\API\Mantenimiento;
use Illuminate\Support\Facades\DB;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Mantenimiento\NombreCargoOT;
use App\Models\GestionOrdenes\Ordenes;

class NombreCargoOTController extends Controller
{
    //
    public function create(Request $request){

        try {   
                $insert['ot_ncot']           = $request['ot_ncot'];
                $insert['nombrerecibe_ncot'] = $request['nombrerecibe_ncot'];
                $insert['cargorecibe_ncot']  = $request['cargorecibe_ncot'];
  
                NombreCargoOT::insert($insert);
    
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
  
            $data = NombreCargoOT::get();
  
            $response['data'] = $data;
            $response['message'] = "load successful";
            $response['success'] = true;
    
          } catch (\Exception $e) {
            $response['message'] = $e->getMessage();
            $response['success'] = false;
          }
          return $response;
      }
  
        public function get($ot_ncot){
  
          try {
    
            $data = NombreCargoOT::find($ot_ncot);
    
            if ($data) {
              $response['data'] = $data;
              $response['message'] = "Load successful";
              $response['success'] = true;
            }
            else {
              $response['data'] = null;
              $response['message'] = "Not found data ot_ncot => $ot_ncot";
              $response['success'] = false;
            }
    
          } catch (\Exception $e) {
            $response['message'] = $e->getMessage();
            $response['success'] = false;
          }
          return $response;
        }
  
        public function update(Request $request, $ot_ncot){
  
          try {
            $data['ot_ncot']           = $request['ot_ncot'];
            $data['nombrerecibe_ncot'] = $request['nombrerecibe_ncot'];
            $data['cargorecibe_ncot']  = $request['cargorecibe_ncot'];
  
            //Console::info('mymessage');
  
            $res = NombreCargoOT::where("ot_ncot",$ot_ncot)->update($data);
  
            $response['res'] = $res;
            $response['message'] = "Updated successful";
            $response['success'] = true;
    
          } catch (\Exception $e) {
            $response['message'] = $e->getMessage();
            $response['success'] = false;
          }
          return $response;
    
        }
  
        public function delete($ot_ncot){
  
        try {
                $res = NombreCargoOT::where("ot_ncot",$ot_ncot)->delete($ot_ncot);
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

<?php

namespace App\Http\Controllers\API\Mantenimiento;
use Illuminate\Support\Facades\DB;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Parameters\Empresa;
use App\Models\Parameters\Estados;
use App\Models\Mantenimiento\FallasMtto;

class FallasMttoController extends Controller
{
    //
    public function create(Request $request){
        try { 
          $insert['tipodefalla_fmt'] = $request['tipodefalla_fmt'];  
          $insert['descripcion_fmt'] = $request['descripcion_fmt'];
          $insert['empresa_fmt']     = $request['empresa_fmt'];
          $insert['estado_fmt']      = $request['estado_fmt'];
              
          FallasMtto::insert($insert);
      
          $response['message'] = "Fallas de Mtto Grabada de forma correcta";
          $response['success'] = true;
      
        } catch (\Exception $e) {
            $response['message'] = $e->getMessage();
            $response['success'] = false;
        }
        return $response;
    }
    
    public function listar_fallasmtto(){  
        try {
          
          $data = DB::select("SELECT t0.*, t1.nombre_emp, t2.nombre_est, t3.descripcion_tfa
          FROM fallasdemtto as t0 INNER JOIN empresa as t1 INNER JOIN estados as t2 INNER JOIN tiposdefallas as t3
          WHERE t0.empresa_fmt = t1.id_emp and t0.estado_fmt = t2.id_est and t0.tipodefalla_fmt = t3.id_tfa ");
  
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
    
    public function get($id_fmt){
        try { 
          $data = DB::select("SELECT t0.*, t1.nombre_emp, t2.nombre_est, t3.descripcion_tfa
          FROM fallasdemtto as t0 INNER JOIN empresa as t1 INNER JOIN estados as t2 INNER JOIN tiposdefallas as t3
          WHERE t0.id_fmt = $id_fmt and t0.empresa_fmt = t1.id_emp and t0.estado_fmt = t2.id_est and t0.tipodefalla_fmt = t3.id_tfa");
      
          if ($data) {
              $response['data'] = $data;
              $response['message'] = "Load successful";
              $response['success'] = true;
          }
          else {
              $response['data'] = null;
              $response['message'] = "Not found data id_fmt => $id_fmt";
              $response['success'] = false;
          }
          } catch (\Exception $e) {
              $response['message'] = $e->getMessage();
              $response['success'] = false;
          }
          return $response;
    }

    public function leerfallatipo($tipodefalla_fmt){
      try { 
        $data = DB::select("SELECT t0.*, t1.nombre_emp, t2.nombre_est, t3.descripcion_tfa
        FROM fallasdemtto as t0 INNER JOIN empresa as t1 INNER JOIN estados as t2 INNER JOIN tiposdefallas as t3
        WHERE t0.tipodefalla_fmt = $tipodefalla_fmt and t0.empresa_fmt = t1.id_emp and t0.estado_fmt = t2.id_est and t0.tipodefalla_fmt = t3.id_tfa");
    
        if ($data) {
            $response['data'] = $data;
            $response['message'] = "Load successful";
            $response['success'] = true;
        }
        else {
            $response['data'] = null;
            $response['message'] = "Not found data tipodefalla_fmt => $tipodefalla_fmt";
            $response['success'] = false;
        }
        } catch (\Exception $e) {
            $response['message'] = $e->getMessage();
            $response['success'] = false;
        }
        return $response;
    }
    
    public function update(Request $request, $id_fmt){
        try {
          $data['tipodefalla_fmt'] = $request['tipodefalla_fmt'];  
          $data['descripcion_fmt'] = $request['descripcion_fmt'];
          $data['empresa_fmt']     = $request['empresa_fmt'];
          $data['estado_fmt']      = $request['estado_fmt'];
    
          $res = FallasMtto::where("id_fmt",$id_fmt)->update($data);
    
          $response['res'] = $res;
          $response['message'] = "Updated successful";
          $response['success'] = true;
        } catch (\Exception $e) {
          $response['message'] = $e->getMessage();
          $response['success'] = false;
        }
        return $response;
    }
    
    public function delete($id_fmt){ 
        try {
          $res = FallasMtto::where("id_fmt",$id_fmt)->delete($id_fmt);
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

<?php

namespace App\Http\Controllers\API\Mantenimiento;
use Illuminate\Support\Facades\DB;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Parameters\Empresa;
use App\Models\Parameters\Estados;
use App\Models\Parameters\Frecuencias;
use App\Models\Interlocutores\Interlocutores;
use App\Models\Mantenimiento\Marcas;
use App\Models\Mantenimiento\SubGruposPartes;
use App\Models\Mantenimiento\GruposEquipos;
use App\Models\Mantenimiento\Equipos;
use App\Models\Mantenimiento\ExtrasEquipos;

class ExtrasEquiposController extends Controller
{
    //
    public function create(Request $request){
        try { 
          $insert['codigo_ext']              = $request['codigo_ext'];
          $insert['equipo_ext']              = $request['equipo_ext'];
          $insert['tipo_ext']                = $request['tipo_ext'];
          $insert['descripcion_ext']         = $request['descripcion_ext'];
          $insert['empresa_ext']             = $request['empresa_ext'];
          $insert['frecuencia_ext']          = $request['frecuencia_ext'];
          $insert['propietario_ext']         = $request['propietario_ext'];
          $insert['marca_ext']               = $request['marca_ext'];
          $insert['antiguedad_ext']          = $request['antiguedad_ext'];
          $insert['grupoequipo_ext']         = $request['grupoequipo_ext'];
          $insert['subgrupoparte_ext']       = $request['subgrupoparte_ext'];
          $insert['valoradquisicion_ext']    = $request['valoradquisicion_ext'];
          $insert['estadocontable_ext']      = $request['estadocontable_ext'];
          $insert['estadocliente_ext']       = $request['estadocliente_ext'];
          $insert['estadomtto_ext']          = $request['estadomtto_ext'];
          $insert['ctacontable_ext']         = $request['ctacontable_ext'];
          
          ExtrasEquipos::insert($insert);
      
          $response['message'] = "Extras Equipos Grabado de forma correcta";
          $response['success'] = true;
      
        } catch (\Exception $e) {
            $response['message'] = $e->getMessage();
            $response['success'] = false;
        }
        return $response;
      }
    
      public function listar_extrasequipos(){  
        try {
          //Muestra Unicamente los tipos de Interlocutores PROVEEDORES = 1
          $data = DB::select("SELECT t0.*, t1.nombre_emp, t2.descripcion_fre, t3.razonsocial_int, t4.descripcion_mar,
                                     t5.descripcion_grp,  t5.codigogrupo_grp, t6.nombre_est, t7.nombre_estcli, t8.nombre_estmtto,
                                     t9.descripcion_equ
          FROM extrasequipos as t0 INNER JOIN empresa as t1 INNER JOIN frecuencias        as t2 INNER JOIN interlocutores as t3
                                   INNER JOIN marcas  as t4 INNER JOIN gruposequipos      as t5 INNER JOIN estados        as t6
                                   INNER JOIN estadoscliente as t7 INNER JOIN estadosmtto as t8 INNER JOIN equipos        as t9
          WHERE t0.empresa_ext        = t1.id_emp and t0.frecuencia_ext     = t2.id_fre    and t0.propietario_ext = t3.id_int     and
                t0.marca_ext          = t4.id_mar    and t0.grupoequipo_ext = t5.id_grp    and t0.equipo_ext      = t9.codigo_equ and
                t0.estadocontable_ext = t6.id_est and t0.estadocliente_ext  = t7.id_estcli and t0.estadomtto_ext  = t8.id_estmtto");
  
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

      public function get($id_ext){
        try { 
          //$data = Frecuencias::find($id_fre);
         
          $data = DB::select("SELECT t0.*, t1.nombre_emp, t2.descripcion_fre, t3.razonsocial_int, t4.descripcion_mar,
                                     t5.descripcion_grp,  t5.codigogrupo_grp, t6.nombre_est, t7.nombre_estcli, t8.nombre_estmtto,
                                     t9.descripcion_equ
          FROM extrasequipos as t0 INNER JOIN empresa        as t1 INNER JOIN frecuencias   as t2 INNER JOIN interlocutores as t3
                                   INNER JOIN marcas         as t4 INNER JOIN gruposequipos as t5 INNER JOIN estados        as t6
                                   INNER JOIN estadoscliente as t7 INNER JOIN estadosmtto   as t8 INNER JOIN equipos        as t9
          WHERE t0.empresa_ext        = t1.id_emp and t0.frecuencia_ext    = t2.id_fre    and t0.propietario_ext = t3.id_int     and
                t0.marca_ext          = t4.id_mar and t0.grupoequipo_ext = t5.id_grp      and t0.equipo_ext      = t9.codigo_equ and
                t0.estadocontable_ext = t6.id_est and t0.estadocliente_ext = t7.id_estcli and t0.estadomtto_ext  = t8.id_estmtto and
                t0.id_ext = $id_ext");

          if ($data) {
              $response['data'] = $data;
              $response['message'] = "Load successful";
              $response['success'] = true;
          }
          else {
              $response['data'] = null;
              $response['message'] = "Not found data id_ext => $id_ext";
              $response['success'] = false;
          }
          } catch (\Exception $e) {
              $response['message'] = $e->getMessage();
              $response['success'] = false;
          }
          return $response;
      }
    
      public function update(Request $request, $id_ext){
        try {
          $data['codigo_ext']           = $request['codigo_ext'];
          $data['equipo_ext']           = $request['equipo_ext'];
          $data['tipo_ext']             = $request['tipo_ext'];
          $data['descripcion_ext']      = $request['descripcion_ext'];
          $data['empresa_ext']          = $request['empresa_ext'];
          $data['frecuencia_ext']       = $request['frecuencia_ext'];
          $data['propietario_ext']      = $request['propietario_ext'];
          $data['marca_ext']            = $request['marca_ext'];
          $data['antiguedad_ext']       = $request['antiguedad_ext'];
          $data['grupoequipo_ext']      = $request['grupoequipo_ext'];
          $data['subgrupoparte_ext']    = $request['subgrupoparte_ext'];
          $data['valoradquisicion_ext'] = $request['valoradquisicion_ext'];
          $data['estadocontable_ext']   = $request['estadocontable_ext'];
          $data['estadocliente_ext']    = $request['estadocliente_ext'];
          $data['estadomtto_ext']       = $request['estadomtto_ext'];
          $data['ctacontable_ext']      = $request['ctacontable_ext'];
            
          $res = ExtrasEquipos::where("id_ext",$id_ext)->update($data);
    
          $response['res'] = $res;
          $response['message'] = "Updated successful";
          $response['success'] = true;
        } catch (\Exception $e) {
          $response['message'] = $e->getMessage();
          $response['success'] = false;
        }
        return $response;
      }
    
      public function delete($id_ext){ 
        try {
          $res = ExtrasEquipos::where("id_ext",$id_ext)->delete($id_ext);
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


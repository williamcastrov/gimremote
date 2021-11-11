<?php

namespace App\Http\Controllers\API\GestionOrdenes;
use Illuminate\Support\Facades\DB;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\GestionOrdenes\Ordenes;
use App\Models\GestionOrdenes\PendienteOT;
use App\Models\Interlocutores\Interlocutores_emp;
use App\Models\Parameters\Estados;

class PendienteOTController extends Controller
{
    //
    public function create(Request $request){
        try { 
          $insert['id']                       = $request['id'];
          $insert['id_pot']                   = $request['id_pot'];
          $insert['fecha_pot']                = $request['fecha_pot'];
          $insert['tecnico1_pot']             = $request['tecnico1_pot'];
    	    $insert['tecnico2_pot']             = $request['tecnico2_pot'];
    	    $insert['tecnico3_pot']             = $request['tecnico3_pot'];
    	    $insert['solicitudrepuesto_pot']    = $request['solicitudrepuesto_pot'];
    	    $insert['respuestarepuesto_pot']    = $request['respuestarepuesto_pot'];
    	    $insert['observacionrespuesta_pot'] = $request['observacionrespuesta_pot'];
    	    $insert['estado_pot']               = $request['estado_pot'];
    	    $insert['novedad_pot']              = $request['novedad_pot'];
    	    $insert['fechacierre_pot']          = $request['fechacierre_pot'];
    	    $insert['descripcion_pot']          = $request['descripcion_pot'];
              
          PendienteOT::insert($insert);
      
          $response['message'] = "Pendiente Orden de Servicio Grabada de forma correcta";
          $response['success'] = true;

          
      
        } catch (\Exception $e) {
            $response['message'] = $e->getMessage();
            $response['success'] = false;
        }
        return $response;
      }

      public function listar_pendientes(){  
        try {
          
            $data = DB::select("SELECT t0.*, t1.*, t2.nombre_est, t3.codigo_equ, t4.nombre_est as estadoot, 
                                       t4.descripcion_tope, t5.razonsocial_cli, CONCAT(t6.primer_nombre_emp,' ',t6.primer_apellido_emp)
                                       as nombretecnicouno,  CONCAT(t7.primer_nombre_emp,' ',t7.primer_apellido_emp)
                                       as nombretecnicodos,  CONCAT(t8.primer_nombre_emp,' ',t8.primer_apellido_emp)
                                       as nombretecnicotres, t9.descripcion_tser, t10.descripcion_tmt, t11.descripcion_mar
            FROM  pendienteoserv as t0 INNER JOIN ordenservicio      as t1 INNER JOIN estados            as t2 INNER JOIN equipos as t3
                                       INNER JOIN vista_pendientes   as t4 INNER JOIN interlocutores_cli as t5 
                                       INNER JOIN interlocutores_emp as t6 INNER JOIN vista_empleados1   as t7
                                       INNER JOIN vista_empleados2   as t8 INNER JOIN tiposservicio      as t9 
                                       INNER JOIN tiposmantenimiento as t10 INNER JOIN marcas            as t11
            WHERE t0.id_pot   = t1.id_otr       and t0.estado_pot  = t2.id_est       and t1.equipo_otr = t3.id_equ 
              and t4.id_pot   = t0.id_pot       and t1.cliente_otr = t5.id_cli       and t6.id_emp     = t0.tecnico1_pot 
              and t7.id_emp   = t0.tecnico2_pot and t8.id_emp      = t0.tecnico3_pot and t1.tiposervicio_otr = t9.id_tser
              and t1.tipo_otr = t10.id_tmt      and t3.marca_equ   = t11.id_mar");
  
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

      public function listar_pendienteOT($id_pot){  
        try {
          
            $data = DB::select("SELECT t0.*, t1.*, t2.nombre_est
            FROM  pendienteoserv as t0 INNER JOIN ordenservicio as t1 INNER JOIN estados as t2
            WHERE t0.id_pot = $id_pot and t0.id_pot = t1.id_otr and t0.estado_pot = t2.id_est");
  
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
          $data['id']                       = $request['id'];
          $data['id_pot']                   = $request['id_pot'];
          $data['fecha_pot']                = $request['fecha_pot'];
          $data['tecnico1_pot']             = $request['tecnico1_pot'];
    	    $data['tecnico2_pot']             = $request['tecnico2_pot'];
    	    $data['tecnico3_pot']             = $request['tecnico3_pot'];
    	    $data['solicitudrepuesto_pot']    = $request['solicitudrepuesto_pot'];
    	    $data['respuestarepuesto_pot']    = $request['respuestarepuesto_pot'];
    	    $data['observacionrespuesta_pot'] = $request['observacionrespuesta_pot'];
    	    $data['estado_pot']               = $request['estado_pot'];
    	    $data['novedad_pot']              = $request['novedad_pot'];
    	    $data['fechacierre_pot']          = $request['fechacierre_pot'];
    	    $data['descripcion_pot']          = $request['descripcion_pot'];
       
          $res = PendienteOT::where("id",$id)->update($data);
    
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
          $res = PendienteOT::where("id",$id)->delete($id);
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

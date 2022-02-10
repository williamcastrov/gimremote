<?php

namespace App\Http\Controllers\API\GestionOrdenes;
use Illuminate\Support\Facades\DB;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\GestionOrdenes\CumplimientoOServ;
use App\Models\GestionOrdenes\Ordenes;
use App\Models\GestionOrdenes\TipoOperacion;
use App\Models\Parameters\Estados;

class CumplimientoOServController extends Controller
{
    //
    public function create(Request $request){
        try { 
          $insert['id']                         = $request['id'];
          $insert['id_cosv']                    = $request['id_cosv'];
          $insert['id_actividad']               = $request['id_actividad'];
          $insert['descripcion_cosv']           = $request['descripcion_cosv'];
          $insert['tipooperacion_cosv']         = $request['tipooperacion_cosv'];
          $insert['tipofallamtto_cosv']         = $request['tipofallamtto_cosv'];
          $insert['referencia_cosv']            = $request['referencia_cosv']; 
          $insert['tipo_cosv']                  = $request['tipo_cosv'];
          $insert['fechaprogramada_cosv']       = $request['fechaprogramada_cosv'];
          $insert['fechainicia_cosv']           = $request['fechainicia_cosv'];
          $insert['fechafinal_cosv']            = $request['fechafinal_cosv'];
          $insert['cantidad_cosv']              = $request['cantidad_cosv'];
          $insert['valorunitario_cosv']         = $request['valorunitario_cosv'];
          $insert['valortotal_cosv']            = $request['valortotal_cosv'];
          $insert['servicio_cosv']              = $request['servicio_cosv'];
          $insert['observacion_cosv']           = $request['observacion_cosv'];
          $insert['tiempoactividad_cosv']       = $request['tiempoactividad_cosv'];
          $insert['operario_cosv']              = $request['operario_cosv'];
          $insert['operariodos_cosv']           = $request['operariodos_cosv'];
          $insert['resumenactividad_cosv']      = $request['resumenactividad_cosv'];
          $insert['iniciatransporte_cosv']      = $request['iniciatransporte_cosv'];
          $insert['finaltransporte_cosv']       = $request['finaltransporte_cosv'];
          $insert['tiempotransporte_cosv']      = $request['tiempotransporte_cosv'];
          $insert['horometro_cosv']             = $request['horometro_cosv'];
          $insert['combogrupo_cosv']            = $request['combogrupo_cosv'];
          $insert['idcomponente']               = $request['idcomponente'];
          $insert['seriecomponente']            = $request['seriecomponente'];
          $insert['voltajecomponente']          = $request['voltajecomponente'];
          $insert['voltajesalidasulfatacion']   = $request['voltajesalidasulfatacion'];
          $insert['amperajecomponente']         = $request['amperajecomponente'];
          $insert['celdasreferenciacomponente'] = $request['celdasreferenciacomponente'];
          $insert['cofreseriecomponentes']      = $request['cofreseriecomponentes'];
          $insert['estadocomponentes']          = $request['estadocomponentes'];
          $insert['estadooperacionequipo_cosv'] = $request['estadooperacionequipo_cosv'];
                 
          CumplimientoOServ::insert($insert);
      
          $response['message'] = "Cumplimiento Orden de Servicio Grabada de forma correcta";
          $response['success'] = true;
      
        } catch (\Exception $e) {
            $response['message'] = $e->getMessage();
            $response['success'] = false;
        }
        return $response;
      }

      public function actividadesactivasxot($id_cosv){
        try { 
          $data = DB::select("SELECT Count(*) as actividadesxotactivas
          FROM cumplimientooserv as t0 
          WHERE t0.id_cosv = $id_cosv and t0.estado_cosv = 23");

          if ($data) {
              $response['data'] = $data;
              $response['message'] = "Load successful";
              $response['success'] = true;
          }
          else {
              $response['data'] = null;
              $response['message'] = "Not found data id_cosv => $id_cosv";
              $response['success'] = false;
          }
          } catch (\Exception $e) {
              $response['message'] = $e->getMessage();
              $response['success'] = false;
          }
          return $response;
      }

      public function actividadestotalesxot($id_cosv){
        try { 
          $data = DB::select("SELECT Count(*) as actividadestotalesxot
          FROM cumplimientooserv as t0 
          WHERE t0.id_cosv = $id_cosv");

          if ($data) {
              $response['data'] = $data;
              $response['message'] = "Load successful";
              $response['success'] = true;
          }
          else {
              $response['data'] = null;
              $response['message'] = "Not found data id_cosv => $id_cosv";
              $response['success'] = false;
          }
          } catch (\Exception $e) {
              $response['message'] = $e->getMessage();
              $response['success'] = false;
          }
          return $response;
      }
    

      public function getoser($id_cosv){  
        try {
          
            $data = DB::select("SELECT t0.*
            FROM  ordenservicio as t0
            WHERE t0.id_cosv = $id_cosv");
  
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
    
      public function listar_cumplimiento(){  
        try {
          
            $data = DB::select("SELECT t0.*, t1.descripcion_tope, t2.descripcion_are, t3.descripcion_fmt, t4.nombre_est
            FROM  cumplimientooserv as t0 INNER JOIN tipooperacion as t1 INNER JOIN actividadrealizada as t2 
                                          INNER JOIN fallasdemtto  as t3 INNER JOIN estados  as t4
            WHERE t0.tipooperacion_cosv         = t1.id_tope and t0.servicio_cosv = t2.id_are and t0.tipofallamtto_cosv = t3.id_fmt and
                  t0.estadooperacionequipo_cosv = t4.id_est");
  
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
    
      public function get($id_cosv){
        try { 
          $data = DB::select("SELECT t0.*, t1.descripcion_tope, t2.descripcion_are,  t3.descripcion_fmt, t4.descripcion_tfa,
                                           t5.nombre_est
          FROM cumplimientooserv as t0 INNER JOIN tipooperacion as t1 INNER JOIN actividadrealizada as t2
                                       INNER JOIN fallasdemtto  as t3 INNER JOIN tiposdefallas      as t4
                                       INNER JOIN estados       as t5
          WHERE t0.id_cosv            = $id_cosv  and t0.tipooperacion_cosv = t1.id_tope and t0.servicio_cosv = t2.id_are  and 
                t0.tipofallamtto_cosv = t3.id_fmt and t3.tipodefalla_fmt    = t4.id_tfa and  t0.estadooperacionequipo_cosv = t5.id_est");
      
          if ($data) {
              $response['data'] = $data;
              $response['message'] = "Load successful";
              $response['success'] = true;
          }
          else {
              $response['data'] = null;
              $response['message'] = "Not found data id_cosv => $id_cosv";
              $response['success'] = false;
          }
          } catch (\Exception $e) {
              $response['message'] = $e->getMessage();
              $response['success'] = false;
          }
          return $response;
      }

      public function leeractividad($actividad){
        try { 
          $data = DB::select("SELECT t0.*, t1.descripcion_tope, t2.descripcion_are,  t3.descripcion_fmt, t4.descripcion_tfa,
                                           t5.nombre_est
          FROM cumplimientooserv as t0 INNER JOIN tipooperacion as t1 INNER JOIN actividadrealizada as t2
                                       INNER JOIN fallasdemtto  as t3 INNER JOIN tiposdefallas      as t4
                                       INNER JOIN estados       as t5
          WHERE t0.id_actividad = $actividad  and t0.tipooperacion_cosv = t1.id_tope and t0.servicio_cosv = t2.id_are  and 
                t0.tipofallamtto_cosv = t3.id_fmt and t3.tipodefalla_fmt    = t4.id_tfa and  t0.estadooperacionequipo_cosv = t5.id_est");
      
          if ($data) {
              $response['data'] = $data;
              $response['message'] = "Load successful";
              $response['success'] = true;
          }
          else {
              $response['data'] = null;
              $response['message'] = "Not found data id_cosv => $id_cosv";
              $response['success'] = false;
          }
          } catch (\Exception $e) {
              $response['message'] = $e->getMessage();
              $response['success'] = false;
          }
          return $response;
      }

      public function listaractividadactiva($id_actividad){
        try { 
          $data = DB::select("SELECT t0.*, t1.descripcion_tope, t2.descripcion_are,  t3.descripcion_fmt, t4.descripcion_tfa,
                                           t5.nombre_est
          FROM cumplimientooserv as t0 INNER JOIN tipooperacion as t1 INNER JOIN actividadrealizada as t2
                                       INNER JOIN fallasdemtto  as t3 INNER JOIN tiposdefallas      as t4
                                       INNER JOIN estados       as t5
          WHERE t0.id_actividad       = $id_actividad  and t0.tipooperacion_cosv = t1.id_tope and t0.servicio_cosv = t2.id_are  
            and t0.tipofallamtto_cosv = t3.id_fmt and t3.tipodefalla_fmt    = t4.id_tfa 
            and  t0.estadooperacionequipo_cosv = t5.id_est and t0.estado_cosv = 23");
      
          if ($data) {
              $response['data'] = $data;
              $response['message'] = "Load successful";
              $response['success'] = true;
          }
          else {
              $response['data'] = null;
              $response['message'] = "Not found data id_cosv => $id_cosv";
              $response['success'] = false;
          }
          } catch (\Exception $e) {
              $response['message'] = $e->getMessage();
              $response['success'] = false;
          }
          return $response;
      }

      public function leeactividadestotalactivas(){
        try { 
          //$data = Frecuencias::find($id_fre);
         
         $data = DB::select("SELECT ordenservicio.*, t17.*, t1.nombre_emp,       t2.nombre_est,       t3.nombre_ciu, t4.razonsocial_int,
                                    t5.razonsocial_cli,  t5.razonsocial_cli,  t5.telefono_cli,     t5.email_cli,  t6.primer_nombre_emp,
                                    t6.primer_apellido_emp,  concat(t6.primer_nombre_emp,' ',t6.primer_apellido_emp) as nombretecnico,
                                    t8.descripcion_sgre, contactos.primer_nombre_con, contactos.primer_apellido_con, contactos.telefono_con,
                                    contactos.email_con, t10.codigo_equ,      t10.antiguedad_equ,  t10.marca_equ,  t11.descripcion_abc,
                                    t12.descripcion_tmt, t13.descripcion_mar, t15.descripcion_tser,t16.descripcion_tope,
                                    datosadicionalequipos.modelo_dequ, datosadicionalequipos.serie_dequ, datosadicionalequipos.referencia_dequ,
                                    datosadicionalequipos.nombrealterno_dequ
                              FROM  ordenservicio INNER JOIN empresa as t1 INNER JOIN estados      as t2 
                                    INNER JOIN ciudades           as t3  INNER JOIN interlocutores as t4  INNER JOIN interlocutores_cli as t5
                                    INNER JOIN interlocutores_emp as t6  INNER JOIN subgrupopartes     as t8
                                    INNER JOIN equipos        as t10 INNER JOIN clasificacionABC   as t11
                                    INNER JOIN tiposmantenimiento as t12 INNER JOIN marcas         as t13 INNER JOIN tiposservicio      as t15
                                    INNER JOIN tipooperacion  as t16 INNER JOIN cumplimientooserv  as t17
                                    left join datosadicionalequipos on (datosadicionalequipos.id_dequ = ordenservicio.equipo_otr)
                                    left join contactos on (contactos.id_con = ordenservicio.contactocliente_otr)
                              WHERE t17.id_cosv = ordenservicio.id_otr and 
                                    ordenservicio.empresa_otr        = t1.id_emp  and ordenservicio.estado_otr       = t2.id_est   and
                                    ordenservicio.ciudad_otr         = t3.id_ciu  and ordenservicio.proveedor_otr    = t4.id_int   and
                                    ordenservicio.cliente_otr        = t5.id_cli  and ordenservicio.operario_otr   	 = t6.id_emp   and
                                    ordenservicio.subgrupoequipo_otr = t8.id_sgre and ordenservicio.equipo_otr       = t10.id_equ  and
                                    ordenservicio.prioridad_otr 	   = t11.id_abc and ordenservicio.tipo_otr      	 = t12.id_tmt  and
                                    t10.marca_equ  	                 = t13.id_mar and ordenservicio.tiposervicio_otr = t15.id_tser and
                                    ordenservicio.tipooperacion_otr  = t16.id_tope and (t17.estado_cosv IN (21,22,23,25,34 ))
                              ORDER BY id_otr DESC");
          
          if ($data) {
              $response['data'] = $data;
              $response['message'] = "Load successful";
              $response['success'] = true;
          }
          else {
              $response['data'] = null;
              $response['message'] = "Not found data operario_cosv => $operario_cosv";
              $response['success'] = false;
          }
          } catch (\Exception $e) {
              $response['message'] = $e->getMessage();
              $response['success'] = false;
          }
          return $response;
      }


      public function leeactividadestecnico($operario_cosv){
        try { 
          //$data = Frecuencias::find($id_fre);
         
         $data = DB::select("SELECT ordenservicio.*, t17.*, t1.nombre_emp,       t2.nombre_est,       t3.nombre_ciu, t4.razonsocial_int,
                                    t5.razonsocial_cli,  t5.razonsocial_cli,  t5.telefono_cli,     t5.email_cli,  t6.primer_nombre_emp,
                                    t6.primer_apellido_emp,  concat(t6.primer_nombre_emp,' ',t6.primer_apellido_emp) as nombretecnico,
                                    t8.descripcion_sgre, contactos.primer_nombre_con, contactos.primer_apellido_con, contactos.telefono_con,
                                    contactos.email_con, t10.codigo_equ,      t10.antiguedad_equ,  t10.marca_equ,  t11.descripcion_abc,
                                    t12.descripcion_tmt, t13.descripcion_mar, t15.descripcion_tser,t16.descripcion_tope,
                                    datosadicionalequipos.modelo_dequ, datosadicionalequipos.serie_dequ, datosadicionalequipos.referencia_dequ,
                                    datosadicionalequipos.nombrealterno_dequ
                              FROM  ordenservicio INNER JOIN empresa as t1 INNER JOIN estados      as t2 
                                    INNER JOIN ciudades           as t3  INNER JOIN interlocutores as t4  INNER JOIN interlocutores_cli as t5
                                    INNER JOIN interlocutores_emp as t6  INNER JOIN subgrupopartes     as t8
                                    INNER JOIN equipos        as t10 INNER JOIN clasificacionABC   as t11
                                    INNER JOIN tiposmantenimiento as t12 INNER JOIN marcas         as t13 INNER JOIN tiposservicio      as t15
                                    INNER JOIN tipooperacion  as t16 INNER JOIN cumplimientooserv  as t17
                                    left join datosadicionalequipos on (datosadicionalequipos.id_dequ = ordenservicio.equipo_otr)
                                    left join contactos on (contactos.id_con = ordenservicio.contactocliente_otr)
                              WHERE t17.operario_cosv = $operario_cosv and t17.id_cosv = ordenservicio.id_otr and 
                                    ordenservicio.empresa_otr        = t1.id_emp  and ordenservicio.estado_otr       = t2.id_est   and
                                    ordenservicio.ciudad_otr         = t3.id_ciu  and ordenservicio.proveedor_otr    = t4.id_int   and
                                    ordenservicio.cliente_otr        = t5.id_cli  and ordenservicio.operario_otr   	 = t6.id_emp   and
                                    ordenservicio.subgrupoequipo_otr = t8.id_sgre and ordenservicio.equipo_otr       = t10.id_equ  and
                                    ordenservicio.prioridad_otr 	   = t11.id_abc and ordenservicio.tipo_otr      	 = t12.id_tmt  and
                                    t10.marca_equ  	                 = t13.id_mar and ordenservicio.tiposervicio_otr = t15.id_tser and
                                    ordenservicio.tipooperacion_otr  = t16.id_tope and (t17.estado_cosv IN (21,22,23,25,34 ))
                              ORDER BY id_otr DESC");
          
          if ($data) {
              $response['data'] = $data;
              $response['message'] = "Load successful";
              $response['success'] = true;
          }
          else {
              $response['data'] = null;
              $response['message'] = "Not found data operario_cosv => $operario_cosv";
              $response['success'] = false;
          }
          } catch (\Exception $e) {
              $response['message'] = $e->getMessage();
              $response['success'] = false;
          }
          return $response;
      }

      public function leetodasactividadestecnico($operario_cosv){
        try { 
          //$data = Frecuencias::find($id_fre);
         
         $data = DB::select("SELECT ordenservicio.*, t17.*, t1.nombre_emp,       t2.nombre_est,       t3.nombre_ciu, t4.razonsocial_int,
                                    t5.razonsocial_cli,  t5.razonsocial_cli,  t5.telefono_cli,     t5.email_cli,  t6.primer_nombre_emp,
                                    t6.primer_apellido_emp,  concat(t6.primer_nombre_emp,' ',t6.primer_apellido_emp) as nombretecnico,
                                    t8.descripcion_sgre, contactos.primer_nombre_con, contactos.primer_apellido_con, contactos.telefono_con,
                                    contactos.email_con, t10.codigo_equ,      t10.antiguedad_equ,  t10.marca_equ,  t11.descripcion_abc,
                                    t12.descripcion_tmt, t13.descripcion_mar, t15.descripcion_tser,t16.descripcion_tope,
                                    datosadicionalequipos.modelo_dequ, datosadicionalequipos.serie_dequ, datosadicionalequipos.referencia_dequ,
                                    datosadicionalequipos.nombrealterno_dequ
                              FROM  ordenservicio INNER JOIN empresa as t1 INNER JOIN estados      as t2 
                                    INNER JOIN ciudades           as t3  INNER JOIN interlocutores as t4  INNER JOIN interlocutores_cli as t5
                                    INNER JOIN interlocutores_emp as t6  INNER JOIN subgrupopartes     as t8
                                    INNER JOIN equipos        as t10 INNER JOIN clasificacionABC   as t11
                                    INNER JOIN tiposmantenimiento as t12 INNER JOIN marcas         as t13 INNER JOIN tiposservicio      as t15
                                    INNER JOIN tipooperacion  as t16 INNER JOIN cumplimientooserv  as t17
                                    left join datosadicionalequipos on (datosadicionalequipos.id_dequ = ordenservicio.equipo_otr)
                                    left join contactos on (contactos.id_con = ordenservicio.contactocliente_otr)
                              WHERE t17.operario_cosv = $operario_cosv and t17.id_cosv = ordenservicio.id_otr and 
                                    ordenservicio.empresa_otr        = t1.id_emp  and ordenservicio.estado_otr       = t2.id_est   and
                                    ordenservicio.ciudad_otr         = t3.id_ciu  and ordenservicio.proveedor_otr    = t4.id_int   and
                                    ordenservicio.cliente_otr        = t5.id_cli  and ordenservicio.operario_otr   	 = t6.id_emp   and
                                    ordenservicio.subgrupoequipo_otr = t8.id_sgre and ordenservicio.equipo_otr       = t10.id_equ  and
                                    ordenservicio.prioridad_otr 	   = t11.id_abc and ordenservicio.tipo_otr      	 = t12.id_tmt  and
                                    t10.marca_equ  	                 = t13.id_mar and ordenservicio.tiposervicio_otr = t15.id_tser and
                                    ordenservicio.tipooperacion_otr  = t16.id_tope
                              ORDER BY id_otr DESC");
          
          if ($data) {
              $response['data'] = $data;
              $response['message'] = "Load successful";
              $response['success'] = true;
          }
          else {
              $response['data'] = null;
              $response['message'] = "Not found data id_equ => $id_otr";
              $response['success'] = false;
          }
          } catch (\Exception $e) {
              $response['message'] = $e->getMessage();
              $response['success'] = false;
          }
          return $response;
      }

      public function actualizafinaltransporte($id_actividad){
        try {
          $data['finaltransporte_cosv'] = NOW();
          $res = DB::update('update cumplimientooserv set finaltransporte_cosv =  '."NOW()".',
                                                          fechainicia_cosv     =  '."NOW()".'
                             where id_actividad = ?', [$id_actividad]);
    
          $response['res'] = $res;
          $response['message'] = "Updated successful";
          $response['success'] = true;
        } catch (\Exception $e) {
          $response['message'] = $e->getMessage();
          $response['success'] = false;
        }
        return $response;
      }
      
      public function actualizainiciatransporte($id_actividad){
        try {
          $data['iniciatransporte_cosv'] = NOW();
          $res = DB::update('update cumplimientooserv set iniciatransporte_cosv =  '."NOW()".' where id_actividad = ?', [$id_actividad]);
    
          $response['res'] = $res;
          $response['message'] = "Updated successful";
          $response['success'] = true;
        } catch (\Exception $e) {
          $response['message'] = $e->getMessage();
          $response['success'] = false;
        }
        return $response;
      } 
    
      public function update(Request $request, $id_actividad){
        try {
          $data['id']                         = $request['id'];
          $data['id_cosv']                    = $request['id_cosv'];
          $data['id_actividad']               = $request['id_actividad'];
          $data['descripcion_cosv']           = $request['descripcion_cosv'];
          $data['tipooperacion_cosv']         = $request['tipooperacion_cosv'];
          $data['tipofallamtto_cosv']         = $request['tipofallamtto_cosv'];
          $data['referencia_cosv']            = $request['referencia_cosv']; 
          $data['tipo_cosv']                  = $request['tipo_cosv'];
          $data['fechaprogramada_cosv']       = $request['fechaprogramada_cosv'];
          $data['fechainicia_cosv']           = $request['fechainicia_cosv'];
          $data['fechafinal_cosv']            = $request['fechafinal_cosv'];
          $data['cantidad_cosv']              = $request['cantidad_cosv'];
          $data['valorunitario_cosv']         = $request['valorunitario_cosv'];
          $data['valortotal_cosv']            = $request['valortotal_cosv'];
          $data['servicio_cosv']              = $request['servicio_cosv'];
          $data['observacion_cosv']           = $request['observacion_cosv'];
          $data['tiempoactividad_cosv']       = $request['tiempoactividad_cosv'];
          $data['operario_cosv']              = $request['operario_cosv'];
          $data['operariodos_cosv']           = $request['operariodos_cosv'];
          $data['resumenactividad_cosv']      = $request['resumenactividad_cosv'];
          $data['iniciatransporte_cosv']      = $request['iniciatransporte_cosv'];
          $data['finaltransporte_cosv']       = $request['finaltransporte_cosv'];
          $data['tiempotransporte_cosv']      = $request['tiempotransporte_cosv'];
          $data['horometro_cosv']             = $request['horometro_cosv'];
          $data['combogrupo_cosv']             = $request['combogrupo_cosv'];
          $data['idcomponente']               = $request['idcomponente'];
          $data['seriecomponente']            = $request['seriecomponente'];
          $data['voltajecomponente']          = $request['voltajecomponente'];
          $data['voltajesalidasulfatacion']   = $request['voltajesalidasulfatacion'];
          $data['amperajecomponente']         = $request['amperajecomponente'];
          $data['celdasreferenciacomponente'] = $request['celdasreferenciacomponente'];
          $data['cofreseriecomponentes']      = $request['cofreseriecomponentes'];
          $data['estadocomponentes']          = $request['estadocomponentes'];
          $data['estadooperacionequipo_cosv'] = $request['estadooperacionequipo_cosv'];
      
          $res = CumplimientoOServ::where("id_actividad",$id_actividad)->update($data);
    
          $response['res'] = $res;
          $response['message'] = "Updated successful";
          $response['success'] = true;
        } catch (\Exception $e) {
          $response['message'] = $e->getMessage();
          $response['success'] = false;
        }
        return $response;
      }

      public function updatehorometro(Request $request, $id_actividad){
        try {
          $data['horometro_cosv'] = $request->valorhorometro;
          echo $request->horometro_cosv;
          //echo json_encode($request);
          
          $res = CumplimientoOServ::where("id_actividad",$id_actividad)->update($data);
    
          $response['res'] = $res;
          $response['message'] = "Updated successful";
          $response['success'] = true;
        } catch (\Exception $e) {
          $response['message'] = $e->getMessage();
          $response['success'] = false;
        }
        return $response;
      }

      public function pasararevision($id_actividad){
        try {
          $data['estado_cosv'] = 26;
          
          $res = DB::update('update cumplimientooserv set estado_cosv = 26 where id_actividad = ?', [$id_actividad]);
    
          $response['res'] = $res;
          $response['message'] = "Updated successful";
          $response['success'] = true;
        } catch (\Exception $e) {
          $response['message'] = $e->getMessage();
          $response['success'] = false;
        }
        return $response;
      } 

      public function cerrarActividad($id_actividad){
        try {
          $data['estado_cosv'] = 27;
          //$res = Ordenes::where("id_otr",$id_otr)->update($id_otr);
          //$res = DB::select('update estado_otr = 32 where id_otr = ?', [$id_otr]);
          $res = DB::update('update cumplimientooserv set estado_cosv = 27 where id_actividad = ?', [$id_actividad]);
    
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
          $res = CumplimientoOServ::where("id",$id)->delete($id);
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

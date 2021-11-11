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
use App\Models\Mantenimiento\EstadosCalidad;
use App\Models\Mantenimiento\EstadosCliente;
use App\Models\Mantenimiento\EstadosMtto;

//DROP TABLE IF EXISTS `grupos`;
//DROP TABLE IF EXISTS `subgrupos`;
class EquiposController extends Controller
{
    //
    public function create(Request $request){
        try { 
          $insert['codigo_equ']           = $request['codigo_equ'];
          $insert['tipo_equ']             = $request['tipo_equ'];
          $insert['descripcion_equ']      = $request['descripcion_equ'];
          $insert['empresa_equ']          = $request['empresa_equ'];
          $insert['frecuencia_equ']       = $request['frecuencia_equ'];
          $insert['propietario_equ']      = $request['propietario_equ'];
          $insert['marca_equ']            = $request['marca_equ'];
          $insert['antiguedad_equ']       = $request['antiguedad_equ'];
          $insert['grupoequipo_equ']      = $request['grupoequipo_equ'];
          $insert['subgrupoparte_equ']    = $request['subgrupoparte_equ'];
          $insert['valoradquisicion_equ'] = $request['valoradquisicion_equ'];
          $insert['estadocontable_equ']   = $request['estadocontable_equ'];
          $insert['estadocliente_equ']    = $request['estadocliente_equ'];
          $insert['estadomtto_equ']       = $request['estadomtto_equ'];
          $insert['estadocalidad_equ']    = $request['estadocalidad_equ'];
          $insert['ctacontable_equ']      = $request['ctacontable_equ'];
          $insert['manejamatricula_equ']  = $request['manejamatricula_equ'];
          $insert['manejamarcacion_equ']  = $request['manejamarcacion_equ'];
          $insert['observacion1_equ']     = $request['observacion1_equ'];
          $insert['observacion2_equ']     = $request['observacion2_equ'];
          
          Equipos::insert($insert);
      
          $response['message'] = "Equipo Grabado de forma correcta";
          $response['success'] = true;
      
        } catch (\Exception $e) {
            $response['message'] = $e->getMessage();
            $response['success'] = false;
        }
        return $response;
      }
    
      public function listar_equipos(){  
        try {
          //Muestra Unicamente los tipos de Interlocutores PROVEEDORES = 1
          $data = DB::select("SELECT t0.*, t1.nombre_emp, t2.descripcion_fre,  t3.razonsocial_int, t4.descripcion_mar,
                                     t5.descripcion_grp,  t5.codigogrupo_grp,  t6.nombre_est, t7.nombre_estcli, t8.nombre_estmtto,
                                     t9.codigo_sgre,      t9.descripcion_sgre, t5.id_grp, t9.id_sgre, t10.nombre_estcal, t11.*  
          FROM equipos as t0 INNER JOIN empresa        as t1  INNER JOIN frecuencias           as t2 INNER JOIN interlocutores as t3
                             INNER JOIN marcas         as t4  INNER JOIN gruposequipos         as t5 INNER JOIN estados        as t6
                             INNER JOIN estadoscliente as t7  INNER JOIN estadosmtto           as t8 INNER JOIN subgrupopartes as t9
                             INNER JOIN estadoscalidad as t10 INNER JOIN datosadicionalequipos as t11
          WHERE t0.empresa_equ        = t1.id_emp and t0.frecuencia_equ    = t2.id_fre    and t0.propietario_equ   = t3.id_int  and
                t0.marca_equ          = t4.id_mar and t0.grupoequipo_equ   = t5.id_grp    and t0.subgrupoparte_equ = t9.id_sgre and
                t0.estadocontable_equ = t6.id_est and t0.estadocliente_equ = t7.id_estcli and t0.estadomtto_equ    = t8.id_estmtto and
                t0.estadocalidad_equ  = t10.id_estcal and t0.id_equ = t11.id_dequ");
  
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

      public function listar_reporteequipos(){  
        try {
          //Muestra Unicamente los tipos de Interlocutores PROVEEDORES = 1
          $data = DB::select("SELECT t0.*, t1.nombre_emp, t2.descripcion_fre,  t3.razonsocial_int, t4.descripcion_mar,
                                     t5.descripcion_grp,  t5.codigogrupo_grp,  t6.nombre_est, t7.nombre_estcli, t8.nombre_estmtto,
                                     t9.codigo_sgre,      t9.descripcion_sgre, t5.id_grp, t9.id_sgre, t10.nombre_estcal, t11.*,
                                     t12.valoradquisicion_act,	t12.ctacontable_act,	t12.ctadepreciacion_act,	t12.valorresidual_act,
	                                   t12.costosiniva_act,	t12.depreciacionacumulada_act,	t12.valorneto_act,	t12.valornovedad_act,
	                                   t12.depreciacionmensual_act,	t12.valorenlibros_act  
          FROM equipos as t0 INNER JOIN empresa        as t1  INNER JOIN frecuencias           as t2 INNER JOIN interlocutores as t3
                             INNER JOIN marcas         as t4  INNER JOIN gruposequipos         as t5 INNER JOIN estados        as t6
                             INNER JOIN estadoscliente as t7  INNER JOIN estadosmtto           as t8 INNER JOIN subgrupopartes as t9
                             INNER JOIN estadoscalidad as t10 INNER JOIN datosadicionalequipos as t11 INNER JOIN activos as t12
          WHERE t0.empresa_equ        = t1.id_emp     and t0.frecuencia_equ    = t2.id_fre    and t0.propietario_equ   = t3.id_int     and
                t0.marca_equ          = t4.id_mar     and t0.grupoequipo_equ   = t5.id_grp    and t0.subgrupoparte_equ = t9.id_sgre    and
                t0.estadocontable_equ = t6.id_est     and t0.estadocliente_equ = t7.id_estcli and t0.estadomtto_equ    = t8.id_estmtto and
                t0.estadocalidad_equ  = t10.id_estcal and t0.id_equ            = t11.id_dequ  and t0.id_equ            = t12.codigo_act");
  
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

      public function listar_equiposmontacargas(){  
        try {
          //Muestra Unicamente los tipos de Interlocutores PROVEEDORES = 1
          $data = DB::select("SELECT t0.*, t1.nombre_emp, t2.descripcion_fre, t3.razonsocial_int, t4.descripcion_mar,
                                     t5.descripcion_grp,  t5.codigogrupo_grp, t6.nombre_est, t7.nombre_estcli, t8.nombre_estmtto,
                                     t9.codigo_sgre,      t9.descripcion_sgre, t5.id_grp, t9.id_sgre, datosadicionalequipos.referencia_dequ,
                                     datosadicionalequipos.modelo_dequ, datosadicionalequipos.serie_dequ, datosadicionalequipos.annofabricacion_dequ,
                                     t10.nombre_estcal
          FROM equipos as t0 INNER JOIN empresa        as t1  INNER JOIN frecuencias   as t2 INNER JOIN interlocutores as t3
                             INNER JOIN marcas         as t4  INNER JOIN gruposequipos as t5 INNER JOIN estados        as t6
                             INNER JOIN estadoscliente as t7  INNER JOIN estadosmtto   as t8 INNER JOIN subgrupopartes as t9
                             INNER JOIN estadoscalidad as t10
                             left join datosadicionalequipos on (datosadicionalequipos.id_dequ = t0.id_equ)
          WHERE t0.empresa_equ        = t1.id_emp  and t0.frecuencia_equ    = t2.id_fre    and t0.propietario_equ = t3.id_int     and
                t0.marca_equ          = t4.id_mar  and t0.grupoequipo_equ   = t5.id_grp    and t0.tipo_equ        = 8             and
                t0.estadocontable_equ = t6.id_est  and t0.estadocliente_equ = t7.id_estcli and t0.estadomtto_equ  = t8.id_estmtto and
                t0.subgrupoparte_equ  = t9.id_sgre and t0.estadocalidad_equ = t10.id_estcal
          ORDER BY t0.codigo_equ ASC");
  
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

      public function listar_equiposmontacargasusuario(){  
        try {
          //Muestra Unicamente los tipos de Interlocutores PROVEEDORES = 1
          $data = DB::select("SELECT t0.*, t1.nombre_emp, t2.descripcion_fre, t3.razonsocial_int, t4.descripcion_mar,
                                     t5.descripcion_grp,  t5.codigogrupo_grp, t6.nombre_est, t7.nombre_estcli, t8.nombre_estmtto,
                                     t9.codigo_sgre,      t9.descripcion_sgre, t5.id_grp, t9.id_sgre, datosadicionalequipos.referencia_dequ,
                                     datosadicionalequipos.modelo_dequ, datosadicionalequipos.serie_dequ, datosadicionalequipos.annofabricacion_dequ,
                                     t10.nombre_estcal
          FROM equipos as t0 INNER JOIN empresa        as t1  INNER JOIN frecuencias   as t2 INNER JOIN interlocutores as t3
                             INNER JOIN marcas         as t4  INNER JOIN gruposequipos as t5 INNER JOIN estados        as t6
                             INNER JOIN estadoscliente as t7  INNER JOIN estadosmtto   as t8 INNER JOIN subgrupopartes as t9
                             INNER JOIN estadoscalidad as t10 INNER JOIN equiposporusuario as t11
                             left join datosadicionalequipos on (datosadicionalequipos.id_dequ = t0.id_equ)
          WHERE t0.empresa_equ        = t1.id_emp  and t0.frecuencia_equ    = t2.id_fre     and t0.propietario_equ = t3.id_int     and
                t0.marca_equ          = t4.id_mar  and t0.grupoequipo_equ   = t5.id_grp     and t0.tipo_equ        = 8             and
                t0.estadocontable_equ = t6.id_est  and t0.estadocliente_equ = t7.id_estcli  and t0.estadomtto_equ  = t8.id_estmtto and
                t0.subgrupoparte_equ  = t9.id_sgre and t0.estadocalidad_equ = t10.id_estcal and t0.id_equ          = t11.equipo_eus
          ORDER BY t0.codigo_equ ASC");
  
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

      public function listar_bajasequiposhistoricos(){  
        try {
          //Muestra Unicamente los tipos de Interlocutores PROVEEDORES = 1
          $data = DB::select("SELECT t0.*, t1.nombre_emp, t2.descripcion_fre, t3.razonsocial_int, t4.descripcion_mar,
                                     t5.descripcion_grp,  t5.codigogrupo_grp, t6.nombre_est, t7.nombre_estcli, t8.nombre_estmtto,
                                     t9.codigo_sgre,      t9.descripcion_sgre, t5.id_grp, t9.id_sgre, datosadicionalequipos.referencia_dequ,
                                     datosadicionalequipos.modelo_dequ, datosadicionalequipos.serie_dequ, datosadicionalequipos.annofabricacion_dequ,
                                     t10.nombre_estcal
          FROM equipos as t0 INNER JOIN empresa        as t1  INNER JOIN frecuencias   as t2 INNER JOIN interlocutores as t3
                             INNER JOIN marcas         as t4  INNER JOIN gruposequipos as t5 INNER JOIN estados        as t6
                             INNER JOIN estadoscliente as t7  INNER JOIN estadosmtto   as t8 INNER JOIN subgrupopartes as t9
                             INNER JOIN estadoscalidad as t10
                             left join datosadicionalequipos on (datosadicionalequipos.id_dequ = t0.id_equ)
          WHERE t0.empresa_equ        = t1.id_emp  and t0.frecuencia_equ    = t2.id_fre    and t0.propietario_equ = t3.id_int     and
                t0.marca_equ          = t4.id_mar  and t0.grupoequipo_equ   = t5.id_grp    and t0.tipo_equ        = 16            and
                t0.estadocontable_equ = t6.id_est  and t0.estadocliente_equ = t7.id_estcli and t0.estadomtto_equ  = t8.id_estmtto and
                t0.subgrupoparte_equ  = t9.id_sgre and t0.estadocalidad_equ = t10.id_estcal
          ORDER BY t0.codigo_equ ASC");
  
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

      public function sumatotalequipos(){
        try {
          //Muestra Unicamente los tipos de Interlocutores PROVEEDORES = 1
          $data = DB::select("SELECT count(id_equ) as totalequipos
          FROM  equipos as t0
          WHERE t0.tipo_equ = 8");
  
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

      public function detalleequipos(){
        try {
          //Muestra Unicamente los tipos de Interlocutores PROVEEDORES = 1
          $data = DB::select("SELECT codigo_equ
          FROM  equipos as t0
          WHERE t0.tipo_equ = 8");
  
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

      public function listar_alertasestadosequipos($totequipos){
        try {
          //Muestra Unicamente los tipos de Interlocutores PROVEEDORES = 1
          $data = DB::select("SELECT t0.estadomtto_equ as estadomtto, count(id_equ) as cantidad, nombre_estmtto,  
                              (count(id_equ)/$totequipos) * 100 as porcentaje
          FROM  equipos as t0 INNER JOIN estadosmtto as t1
          WHERE t0.tipo_equ = 8 and t0.estadomtto_equ = t1.id_estmtto
          GROUP BY t0.estadomtto_equ, nombre_estmtto");
  
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

      public function listar_activosrenta(){  
        try {
          //Muestra Unicamente los tipos de Interlocutores PROVEEDORES = 1
          $data = DB::select("SELECT t0.*, t1.nombre_emp, t2.descripcion_fre, t3.razonsocial_int, t4.descripcion_mar,
                                     t5.descripcion_grp,  t5.codigogrupo_grp, t6.nombre_est, t7.nombre_estcli, t8.nombre_estmtto,
                                     t9.codigo_sgre,      t9.descripcion_sgre, t5.id_grp, t9.id_sgre, datosadicionalequipos.*,
                                     seguros.id_seg, seguros.declaracionimportacion_seg, seguros.numeroseguro_seg,
                                     ubicaciones.cliente_ubi,
                                     ubicaciones.direccion_ubi, ubicaciones.ciudad_ubi, interlocutores_cli.razonsocial_cli,
                                     ciudades.nombre_ciu
          FROM equipos as t0 INNER JOIN empresa        as t1 INNER JOIN frecuencias   as t2 INNER JOIN interlocutores as t3
                             INNER JOIN marcas         as t4 INNER JOIN gruposequipos as t5 INNER JOIN estados        as t6
                             INNER JOIN estadoscliente as t7 INNER JOIN estadosmtto   as t8 INNER JOIN subgrupopartes as t9
                             INNER JOIN estadoscalidad as t10
                             left join datosadicionalequipos on (datosadicionalequipos.id_dequ = t0.id_equ)
                             left join seguros on (seguros.equipo_seg = t0.id_equ and activo_seg = 'S')
                             left join ubicaciones on (ubicaciones.equipo_ubi = t0.id_equ and estado_ubi = 31)
                             left join interlocutores_cli on (ubicaciones.cliente_ubi = interlocutores_cli.id_cli)
                             left join ciudades on (ubicaciones.ciudad_ubi = ciudades.id_ciu)               
          WHERE t0.empresa_equ        = t1.id_emp  and t0.frecuencia_equ    = t2.id_fre    and t0.propietario_equ = t3.id_int     and
                t0.marca_equ          = t4.id_mar  and t0.grupoequipo_equ   = t5.id_grp    and t0.tipo_equ        = 8             and
                t0.estadocontable_equ = t6.id_est  and t0.estadocliente_equ = t7.id_estcli and t0.estadomtto_equ  = t8.id_estmtto and
                t0.subgrupoparte_equ  = t9.id_sgre and t0.estadocalidad_equ = t10.id_estcal
          ORDER BY t0.id_equ ASC");
  
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

      public function listar_activosasegurados(){  
        try {
          //Muestra Unicamente los tipos de Interlocutores PROVEEDORES = 1
          $data = DB::select("SELECT t0.*,               t1.descripcion_mar,
                                     t2.nombre_estcli,   t3.referencia_dequ, t3.modelo_dequ,  t3.serie_dequ,
                                     t4.id_seg,          t4.declaracionimportacion_seg,       t4.numeroseguro_seg,
                                     t5.cliente_ubi,     t5.direccion_ubi,                    t5.ciudad_ubi,
                                     t6.razonsocial_cli, t7.nombre_ciu
                  FROM equipos as t0 INNER JOIN marcas   as t1 INNER JOIN estadoscliente as t2 INNER JOIN datosadicionalequipos as t3
                                     INNER JOIN seguros  as t4 INNER JOIN ubicaciones    as t5 INNER JOIN interlocutores_cli    as t6
                                     INNER JOIN ciudades as t7 
                  WHERE              t0.marca_equ   = t1.id_mar and t0.estadocliente_equ = t2.id_estcli and 
                                     t3.id_dequ     = t0.id_equ and t4.numeroseguro_seg  > 0   and 
                                    (t4.estado_seg  = 52 or t4.estado_seg = 53)                and                              
                                     t5.cliente_ubi = t6.id_cli and t5.ciudad_ubi = t7.id_ciu  and                
                                     t5.equipo_ubi  = t0.id_equ and estado_ubi = 31            and
                                     t4.equipo_seg  = t0.id_equ and t4.activo_seg = 'S' ORDER BY t4.id_seg ASC");

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

      public function listar_equiposaccesorios(){  
        try {
          //Muestra Unicamente los tipos de Interlocutores PROVEEDORES = 1
          $data = DB::select("SELECT t0.*, t1.nombre_emp, t2.descripcion_fre, t3.razonsocial_int, t4.descripcion_mar,
                                     t5.descripcion_grp,  t5.codigogrupo_grp, t6.nombre_est, t7.nombre_estcli, t8.nombre_estmtto,
                                     t9.codigo_sgre,      t9.descripcion_sgre, t5.id_grp, t9.id_sgre, t10.nombre_estcal
          FROM equipos as t0 INNER JOIN empresa        as t1 INNER JOIN frecuencias   as t2 INNER JOIN interlocutores as t3
                             INNER JOIN marcas         as t4 INNER JOIN gruposequipos as t5 INNER JOIN estados        as t6
                             INNER JOIN estadoscliente as t7 INNER JOIN estadosmtto   as t8 INNER JOIN subgrupopartes as t9
                             INNER JOIN estadoscalidad as t10
          WHERE t0.empresa_equ        = t1.id_emp  and t0.frecuencia_equ    = t2.id_fre    and t0.propietario_equ = t3.id_int     and
                t0.marca_equ          = t4.id_mar  and t0.grupoequipo_equ   = t5.id_grp    and t0.tipo_equ        = 9             and
                t0.estadocontable_equ = t6.id_est  and t0.estadocliente_equ = t7.id_estcli and t0.estadomtto_equ  = t8.id_estmtto and
                t0.subgrupoparte_equ  = t9.id_sgre and t0.estadocalidad_equ = t10.id_estcal");
  
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
      
      public function listar_equiposaccesorioscargadores(){  
        try {
          //Muestra Unicamente los tipos de Interlocutores PROVEEDORES = 1
          $data = DB::select("SELECT t0.*, t1.nombre_emp, t2.descripcion_fre, t3.razonsocial_int, t4.descripcion_mar,
                                     t5.descripcion_grp,  t5.codigogrupo_grp, t6.nombre_est, t7.nombre_estcli, t8.nombre_estmtto,
                                     t9.codigo_sgre,      t9.descripcion_sgre, t5.id_grp, t9.id_sgre, t10.nombre_estcal
          FROM equipos as t0 INNER JOIN empresa        as t1 INNER JOIN frecuencias   as t2 INNER JOIN interlocutores as t3
                             INNER JOIN marcas         as t4 INNER JOIN gruposequipos as t5 INNER JOIN estados        as t6
                             INNER JOIN estadoscliente as t7 INNER JOIN estadosmtto   as t8 INNER JOIN subgrupopartes as t9
                             INNER JOIN estadoscalidad as t10
          WHERE t0.empresa_equ        = t1.id_emp  and t0.frecuencia_equ    = t2.id_fre    and t0.propietario_equ = t3.id_int     and
                t0.marca_equ          = t4.id_mar  and t0.grupoequipo_equ   = t5.id_grp    and t0.tipo_equ        = 9             and
                t0.estadocontable_equ = t6.id_est  and t0.estadocliente_equ = t7.id_estcli and t0.estadomtto_equ  = t8.id_estmtto and
                t0.subgrupoparte_equ  = t9.id_sgre and t0.estadocalidad_equ = t10.id_estcal and t0.subgrupoparte_equ = 60");
  
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

      public function listar_equiposaccesoriosbaterias(){  
        try {
          //Muestra Unicamente los tipos de Interlocutores PROVEEDORES = 1
          $data = DB::select("SELECT t0.*, t1.nombre_emp, t2.descripcion_fre, t3.razonsocial_int, t4.descripcion_mar,
                                     t5.descripcion_grp,  t5.codigogrupo_grp, t6.nombre_est, t7.nombre_estcli, t8.nombre_estmtto,
                                     t9.codigo_sgre,      t9.descripcion_sgre, t5.id_grp, t9.id_sgre, t10.nombre_estcal
          FROM equipos as t0 INNER JOIN empresa        as t1 INNER JOIN frecuencias   as t2 INNER JOIN interlocutores as t3
                             INNER JOIN marcas         as t4 INNER JOIN gruposequipos as t5 INNER JOIN estados        as t6
                             INNER JOIN estadoscliente as t7 INNER JOIN estadosmtto   as t8 INNER JOIN subgrupopartes as t9
                             INNER JOIN estadoscalidad as t10
          WHERE t0.empresa_equ        = t1.id_emp  and t0.frecuencia_equ    = t2.id_fre    and t0.propietario_equ = t3.id_int     and
                t0.marca_equ          = t4.id_mar  and t0.grupoequipo_equ   = t5.id_grp    and t0.tipo_equ        = 9             and
                t0.estadocontable_equ = t6.id_est  and t0.estadocliente_equ = t7.id_estcli and t0.estadomtto_equ  = t8.id_estmtto and
                t0.subgrupoparte_equ  = t9.id_sgre and t0.estadocalidad_equ = t10.id_estcal and t0.subgrupoparte_equ = 40");
  
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


      public function get($id_equ){
        try { 
          //$data = Frecuencias::find($id_fre);
          // t11.cliente_ctr   and t0.id_equ = t11.id_ctr and estado_ctr = 31  INNER JOIN contratos     as t11
          $data = DB::select("SELECT t0.*, t1.nombre_emp, t2.descripcion_fre, t3.razonsocial_int, t4.descripcion_mar,
                                     t5.descripcion_grp,  t5.codigogrupo_grp, t6.nombre_est, t7.nombre_estcli, t8.nombre_estmtto,
                                     t9.codigo_sgre,      t9.descripcion_sgre, t5.id_grp, t9.id_sgre, t10.nombre_estcal,
                                     contratos.cliente_ctr, contactos.id_con, contactos.ciudad_con, t11.*, t12.ciudad_ubi,
                                     t13.nombre_ciu
          FROM equipos as t0 INNER JOIN empresa        as t1  INNER JOIN frecuencias   as t2 INNER JOIN interlocutores as t3
                             INNER JOIN marcas         as t4  INNER JOIN gruposequipos as t5 INNER JOIN estados        as t6
                             INNER JOIN estadoscliente as t7  INNER JOIN estadosmtto   as t8 INNER JOIN subgrupopartes as t9
                             INNER JOIN estadoscalidad as t10 INNER JOIN datosadicionalequipos as t11 INNER JOIN ubicaciones as t12
                             INNER JOIN ciudades       as t13
                             left join contratos on (contratos.id_ctr = t0.id_equ and contratos.estado_ctr != 60)
                             left join contactos on (contactos.idinterlocutor_con = contratos.cliente_ctr)
          WHERE t0.empresa_equ        = t1.id_emp and t0.frecuencia_equ    = t2.id_fre    and t0.propietario_equ   = t3.id_int     and
                t0.marca_equ          = t4.id_mar and t0.grupoequipo_equ   = t5.id_grp    and t0.subgrupoparte_equ = t9.id_sgre    and
                t0.estadocontable_equ = t6.id_est and t0.estadocliente_equ = t7.id_estcli and t0.estadomtto_equ    = t8.id_estmtto and
                t0.estadocalidad_equ = t10.id_estcal and t0.id_equ = $id_equ and t0.id_equ = t11.id_dequ and t0.id_equ = t12.equipo_ubi and
                t12.ciudad_ubi = t13.id_ciu and t12.estado_ubi = 31");

          if ($data) {
              $response['data'] = $data;
              $response['message'] = "Load successful";
              $response['success'] = true;
          }
          else {
              $response['data'] = null;
              $response['message'] = "Not found data id_equ => $id_equ";
              $response['success'] = false;
          }
          } catch (\Exception $e) {
              $response['message'] = $e->getMessage();
              $response['success'] = false;
          }
          return $response;
      }
    
      public function update(Request $request, $id_equ){
        try {
          $data['codigo_equ']           = $request['codigo_equ'];
          $data['tipo_equ']             = $request['tipo_equ'];
          $data['descripcion_equ']      = $request['descripcion_equ'];
          $data['empresa_equ']          = $request['empresa_equ'];
          $data['frecuencia_equ']       = $request['frecuencia_equ'];
          $data['propietario_equ']      = $request['propietario_equ'];
          $data['marca_equ']            = $request['marca_equ'];
          $data['antiguedad_equ']       = $request['antiguedad_equ'];
          $data['grupoequipo_equ']      = $request['grupoequipo_equ'];
          $data['subgrupoparte_equ']    = $request['subgrupoparte_equ'];
          $data['valoradquisicion_equ'] = $request['valoradquisicion_equ'];
          $data['estadocontable_equ']   = $request['estadocontable_equ'];
          $data['estadocliente_equ']    = $request['estadocliente_equ'];
          $data['estadomtto_equ']       = $request['estadomtto_equ'];
          $data['estadocalidad_equ']    = $request['estadocalidad_equ'];
          $data['ctacontable_equ']      = $request['ctacontable_equ'];
          $data['manejamatricula_equ']  = $request['manejamatricula_equ'];
          $data['manejamarcacion_equ']  = $request['manejamarcacion_equ'];
          $data['observacion1_equ']     = $request['observacion1_equ'];
          $data['observacion2_equ']     = $request['observacion2_equ'];
   
          $res = Equipos::where("id_equ",$id_equ)->update($data);
    
          $response['res'] = $res;
          $response['message'] = "Updated successful";
          $response['success'] = true;
        } catch (\Exception $e) {
          $response['message'] = $e->getMessage();
          $response['success'] = false;
        }
        return $response;
      }
    
      public function delete($id_equ){ 
        try {
          $res = Equipos::where("id_equ",$id_equ)->delete($id_equ);
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

<?php

namespace App\Http\Controllers\API\Mantenimiento;
use Illuminate\Support\Facades\DB;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Parameters\Estados;
use App\Models\Parameters\Ciudades;
use App\Models\Interlocutores\Interlocutores_cli;
use App\Models\Mantenimiento\IncrementoCanon;
use PDF; // at the top of the file

class IncrementoCanonController extends Controller
{
    //
    public function create(Request $request){
        try { 
          $insert['cliente_inc']           = $request['cliente_inc'];
          $insert['equipo_inc']            = $request['equipo_inc'];
          $insert['ciudad_inc']            = $request['ciudad_inc'];
          $insert['variacion_inc']         = $request['variacion_inc'];
          $insert['fechacreacion_inc']     = $request['fechacreacion_inc'];
          $insert['fechaincremento_inc']   = $request['fechaincremento_inc'];
          $insert['valorrentamensual_inc'] = $request['valorrentamensual_inc'];
          $insert['nombrecontacto_inc']    = $request['nombrecontacto_inc'];
          $insert['estado_inc']            = $request['estado_inc'];

          IncrementoCanon::insert($insert);
      
          $response['message'] = "Incremento Canon Grabado de forma correcta";
          $response['success'] = true;
      
        } catch (\Exception $e) {
            $response['message'] = $e->getMessage();
            $response['success'] = false;
        }
        return $response;
    }
    
    public function listar_incrementocanon(){  
        try {   
          $data = DB::select("SELECT t0.*, t1.nombre_ciu, t2.nombre_est, t3.razonsocial_cli, t4.nombre_dep, t5.codigo_equ,
                                     contratos.valorrentames_ctr
          FROM incrementocanon as t0 INNER JOIN ciudades      as t1 INNER JOIN estados as t2 INNER JOIN interlocutores_cli as t3
                                     INNER JOIN departamentos as t4 INNER JOIN equipos as t5 
                                     left join contratos on (contratos.id_ctr = t5.id_equ)
          WHERE t0.ciudad_inc = t1.id_ciu           and t0.estado_inc = t2.id_est and t0.cliente_inc = t3.id_cli and
                t4.id_dep     = t1.departamento_ciu and t0.equipo_inc = t5.id_equ");
  
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

    public function generarPdfAlza($id){  
      try {
        $data = DB::select("SELECT t0.*, t1.nombre_ciu, t2.nombre_est, t3.razonsocial_cli, t4.nombre_dep, t5.codigo_equ,
                                   contratos.valorrentames_ctr, t6.referencia_dequ, t5.descripcion_equ,   t6.modelo_dequ,
                                   t6.serie_dequ
        FROM incrementocanon as t0 INNER JOIN ciudades      as t1 INNER JOIN estados as t2 INNER JOIN interlocutores_cli    as t3
                                   INNER JOIN departamentos as t4 INNER JOIN equipos as t5 INNER JOIN datosadicionalequipos as t6 
                                   left join contratos on (contratos.id_ctr = t5.id_equ)
        WHERE t0.ciudad_inc = t1.id_ciu           and t0.estado_inc = t2.id_est and t0.cliente_inc = t3.id_cli  and
              t4.id_dep     = t1.departamento_ciu and t0.equipo_inc = t5.id_equ and t5.id_equ      = t6.id_dequ and 
              t0.id_inc      = $id");
        
        $response['data'] = $data;
        $response['message'] = "load successful";
        $response['success'] = true;
        
        PDF::SetMargins(15, 30, 15);
        PDF::SetTitle('OT Cliente - LOGISTRAL S.A.' );
        PDF::AddPage();
        PDF::SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);
        // create some HTML content
        $subtable = '<table border="1" cellspacing="6" cellpadding="4"><tr><td>a</td><td>b</td></tr><tr><td>c</td><td>d</td></tr></table>';
        setlocale(LC_ALL,"es_ES@euro","es_ES","esp");
        $d = $data[0]->fechacreacion_inc;
        $fecha = strftime("%d de %B de %Y", strtotime($d));
        //echo $fecha; // 09 de marzo de 2010

        PDF::Image('/var/www/bc-gim/resources/js/server/server/src/images/logologistral.jpeg', 19, 5, 35, 20, 'JPG', 'http://www.tcpdf.org', '', true, 150, '', false, false, 0, false, false, false);
        
        $html = '
        <br/>
        <table border="0" cellspacing="3" cellpadding="1" style="font-size: 11px !important;" >
        <tr >
          <th align="left"  >
            La Estrella : '.$fecha.'
          </th>
        </tr>
        <tr>
          <th align="left" >
            Señores:   
          </th>
        </tr>
        <tr>
          <th align="left">
            '.$data[0]->razonsocial_cli.'
          </th>
        </tr>
        <tr>
          <th align="left" >
            Atn : '.$data[0]->nombrecontacto_inc.'
          </th>
        </tr>
        <tr>
          <th align="left" >
            Ciudad  : '.$data[0]->nombre_ciu.'
          </th>
        </tr>
        <tr>
        <th align="left" >
          Ref : Incremento canon 2021  / variación IPC
        </th>
      </tr>

      <p  style = "text-align: justify !important; font-size: 11px !important; " >
   
        De Logística Estructural S.A. identificada con NIT. 900.161.726-3 informamos de manera formal que de acuerdo a
        lo establecido en el contrato de renta sobre el incremento anual y de acuerdo al índice de precios al consumidor
        – IPC, el cual tuvo una variación del '.$data[0]->variacion_inc.'% año anterior,  el canon por servicio de renta
        tendrá un incremento en su cobro mensual, el cual se hace efectivo a partir de la factura del mes siguiente.
 
      </p>
        </table>';
        PDF::writeHTML($html, true, false, true, false, '');

        $html1 = '
        <table border="0" cellspacing="1" cellpadding="1" style="font-family: Arial, Helvetica, sans-serif !important; font-size: 10px !important;">
         <br />
        <tr style="text-align: center !important; background-color: #F5F5F5"  >
          <td>ID INTERNO</td>
          <td>Referencia:</td>
          <td>Descripción:</td>
        </tr>';
        
        $html1 .= 
        '<tr>
          <td style = "text-align: center !important; font-size: 10px !important" >'.$data[0]->codigo_equ.'</td>
          <td style = "text-align: center !important; font-size: 10px !important" >'.$data[0]->referencia_dequ.'</td>
          <td style = "text-align: center !important; font-size: 10px !important" >'.$data[0]->descripcion_equ.'</td>
        </tr>';

        $html1 .='
        </table>
        ';

        PDF::writeHTML($html1, true, false, true, false, '');

        $html1 = '
        <table border="0" cellspacing="1" cellpadding="1" style="font-family: Arial, Helvetica, sans-serif !important; font-size: 10px !important;">
         <br />
        <tr style="text-align: center !important; background-color: #F5F5F5"  >
          <td>Marca: </td>
          <td>Modelo: </td>
          <td>Serie: </td>
        </tr>';
        
        $html1 .= 
        '<tr>
          <td style = "text-align: center !important; font-size: 10px !important" >'.$data[0]->codigo_equ.'</td>
          <td style = "text-align: center !important; font-size: 10px !important" >'.$data[0]->modelo_dequ.'</td>
          <td style = "text-align: center !important; font-size: 10px !important" >'.$data[0]->serie_dequ.'</td>
        </tr>';

        $html1 .='
        </table>
        ';

        PDF::writeHTML($html1, true, false, true, false, '');

       $html1 = '
       <br />
        <p  style = "text-align: justify !important; font-size: 11px !important; " >
          Teniendo en cuenta lo anterior, a partir de la próxima factura de renta de la máquina, '.$data[0]->codigo_equ.'
          <br/> llegará por valor de $ '.$data[0]->valorrentamensual_inc.' más IVA.
        </p>
     ';
      PDF::writeHTML($html1, true, false, true, false, '');

      $html1 = '
       <br />
        <p  style = "text-align: justify !important; font-size: 11px !important; " >
        Agradecemos su atención y confirmación de recibo de dicha notificación. En caso de cualquier inquietud favor
        comunicarse con nosotros y con gusto atenderemos.
        </p>
       <br />
     ';
      PDF::writeHTML($html1, true, false, true, false, '');

      $html1 = '
      <br />
       <p  style = "text-align: left !important; font-size: 11px !important; " >
       Coordialmente.
       </p>

       <p  style = "text-align: left !important; font-size: 11px !important; " >
        LAURA ALVAREZ
        Coordinadora de Operaciones
       </p>
       
      <br />
    ';
     PDF::writeHTML($html1, true, false, true, false, '');



      PDF::Output('Carta de Alza'.$id.'.pdf');

      } catch (\Exception $e) {
        $response['message'] = $e->getMessage();
        //$response['result'] = $path;
        $response['success'] = false;
    }
        return $response;
    }
    
    public function get($id_inc){
        try { 
            $data = DB::select("SELECT t0.*, t1.nombre_ciu, t2.nombre_est, t3.razonsocial_cli, t4.nombre_dep, t5.codigo_equ
            FROM incrementocanon as t0 INNER JOIN ciudades      as t1 INNER JOIN estados as t2 INNER JOIN interlocutores_cli as t3
                                       INNER JOIN departamentos as t4 INNER JOIN equipos as t5
            WHERE t0.ciudad_inc = t1.id_ciu           and t0.estado_inc  = t2.id_est and t0.cliente_inc = t3.id_cli and
                  t4.id_dep     = t1.departamento_ciu and  t0.equipo_inc = t5.id_equ and t0.id_inc      = $id_inc");
      
          if ($data) {
              $response['data'] = $data;
              $response['message'] = "Load successful";
              $response['success'] = true;
          }
          else {
              $response['data'] = null;
              $response['message'] = "Not found data id_inc => $id_inc";
              $response['success'] = false;
          }
          } catch (\Exception $e) {
              $response['message'] = $e->getMessage();
              $response['success'] = false;
          }
          return $response;
    }
    
    public function update(Request $request, $id_inc){
        try {
            $data['cliente_inc']           = $request['cliente_inc'];
            $data['equipo_inc']            = $request['equipo_inc'];
            $data['ciudad_inc']            = $request['ciudad_inc'];
            $data['variacion_inc']         = $request['variacion_inc'];
            $data['fechacreacion_inc']     = $request['fechacreacion_inc'];
            $data['fechaincremento_inc']   = $request['fechaincremento_inc'];
            $data['valorrentamensual_inc'] = $request['valorrentamensual_inc'];
            $data['nombrecontacto_inc']    = $request['nombrecontacto_inc'];
            $data['estado_inc']            = $request['estado_inc'];
  
          $res = IncrementoCanon::where("id_inc",$id_inc)->update($data);
    
          $response['res'] = $res;
          $response['message'] = "Updated successful";
          $response['success'] = true;
        } catch (\Exception $e) {
          $response['message'] = $e->getMessage();
          $response['success'] = false;
        }
        return $response;
    }
    
    public function delete($id_inc){ 
        try {
          $res = IncrementoCanon::where("id_inc",$id_inc)->delete($id_inc);
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

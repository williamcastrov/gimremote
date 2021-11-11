<?php

namespace App\Models\GestionOrdenes;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CumplimientoOServ extends Model
{
    use HasFactory;

    protected $table = "cumplimientooserv";

    protected $primaryKey = "id";

    protected $fillable = [
		'id',
        'id_cosv',
		'id_actividad',
		'descripcion_cosv',
		'tipooperacion_cosv',
		'tipofallamtto_cosv',
	    'referencia_cosv',
	    'tipo_cosv',
		'fechaprogramada_cosv',
		'fechainicia_cosv',
	    'fechafinal_cosv',
	    'cantidad_cosv',
	    'valorunitario_cosv',
	    'valortotal_cosv',
	    'servicio_cosv',
	    'observacion_cosv',
		'tiempoactividad_cosv',
		'operario_cosv',
		'operariodos_cosv',
		'resumenactividad_cosv',
		'iniciatransporte_cosv',
		'finaltransporte_cosv',
		'tiempotransporte_cosv',
		'horometro_cosv',
		'idcomponente',
		'seriecomponente',
		'voltajecomponente',
		'voltajesalidasulfatacion',
		'amperajecomponente',
		'celdasreferenciacomponente',
		'cofreseriecomponentes',
		'estadocomponentes',
		'estadooperacionequipo_cosv'
    ];

    public $timestamps = false;
}

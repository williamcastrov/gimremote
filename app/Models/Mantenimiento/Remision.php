<?php

namespace App\Models\Mantenimiento;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Remision extends Model
{
    use HasFactory;

    protected $table = "remision";

    protected $primaryKey = "id_rem";

    protected $fillable = [
	    'cliente_rem',
	    'ordencompra_rem',
	    'ciudad_rem',
	    'direccion_rem',
	    'contacto_rem',
	    'telefono_rem',
	    'fechacreacion_rem',
		'horometro_rem',
	    'estado_rem',
		'equipo1_rem',
		'equipo2_rem',
		'equipo3_rem',
		'equipo4_rem',
		'lucesdetrabajo_rem',
		'luzstrober_rem',
		'camara_rem',
		'sensordeimpacto_rem',
		'alarmadereservsa_rem',
		'camasdebateria_rem'
    ];

    public $timestamps = false;
}

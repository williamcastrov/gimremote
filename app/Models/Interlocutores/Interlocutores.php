<?php

namespace App\Models\Interlocutores;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Interlocutores extends Model
{
    use HasFactory;

    protected $table = "interlocutores";

    protected $primaryKey = "id_int";

    protected $fillable = [
		'codigo_tipo_int',
		'digitochequeo_int',
	    'nit_int',
	    'estado_int',
	    'primer_nombre_int', 
	    'segundo_nombre_int',
		'primer_apellido_int',
		'segundo_apellido_int', 
	    'razonsocial_int',
	    'ciudad_int',
	    'direccion_int',
	    'telefono_int',
		'email_int',
		'empresa_int',
	    'fecha_creacion_int',
	    'fecha_modificacion_int', 
	    'especialidad_int'
    ];

    public $timestamps = false;
}

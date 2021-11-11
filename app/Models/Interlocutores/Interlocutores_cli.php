<?php

namespace App\Models\Interlocutores;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Interlocutores_cli extends Model
{
    use HasFactory;

    protected $table = "interlocutores_cli";

    protected $primaryKey = "id_cli";

    protected $fillable = [
	    'codigo_tipo_cli',
		'nit_cli',
		'digitochequeo_cli',
	    'estado_cli',
	    'primer_nombre_cli', 
	    'segundo_nombre_cli',
		'primer_apellido_cli',
		'segundo_apellido_cli', 
	    'razonsocial_cli',
	    'ciudad_cli',
	    'direccion_cli',
	    'telefono_cli',
		'email_cli',
		'empresa_cli',
	    'fecha_creacion_cli',
	    'fecha_modificacion_cli', 
	    'especialidad_cli'
    ];

    public $timestamps = false;
}

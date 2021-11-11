<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Usuarios extends Model
{
    use HasFactory;

    protected $table = "usuarios";

    protected $primaryKey = "id_usu";

    protected $fillable = [
		'cedula_usu',
	    'nombre_usu',
	    'email_usu',
	    'pais_usu',
	    'ciudad_usu',
	    'uidfirebase_usu',
	    'tipo_usu',
	    'foto_usu',
	    'celular_usu',
		'dashboard_usu',
	    'estado_usu', 
	 ];

    public $timestamps = false;
}

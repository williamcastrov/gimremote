<?php

namespace App\Models\GestionOrdenes;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PendienteOT extends Model
{
    use HasFactory;

    protected $table = "pendienteoserv";

    protected $primaryKey = "id";

    protected $fillable = [
        'id',
    	'id_pot',
    	'fecha_pot',
    	'tecnico1_pot',
    	'tecnico2_pot',
    	'tecnico3_pot',
    	'solicitudrepuesto_pot',
    	'respuestarepuesto_pot',
    	'observacionrespuesta_pot',
    	'estado_pot',
    	'novedad_pot',
    	'fechacierre_pot',
    	'descripcion_pot'
    ];

    public $timestamps = false;
}

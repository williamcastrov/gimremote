<?php

namespace App\Models\Interlocutores;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Contactos extends Model
{
    use HasFactory;

    protected $table = "contactos";

    protected $primaryKey = "id_con";

    protected $fillable = [
        'id_con',
        'idinterlocutor_con',
        'identificacion_con',
        'primer_nombre_con',
        'segundo_nombre_con',
        'primer_apellido_con',
        'segundo_apellido_con',
        'ciudad_con',
        'direccion_con',
        'telefono_con',
        'email_con',
        'fecha_creacion_con',
        'fecha_modificacion_con',
        'estado_con',
    ];

    public $timestamps = false;
}

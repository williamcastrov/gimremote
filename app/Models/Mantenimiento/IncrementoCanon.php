<?php

namespace App\Models\Mantenimiento;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class IncrementoCanon extends Model
{
    use HasFactory;

    protected $table = "incrementocanon";

    protected $primaryKey = "id_inc";

    protected $fillable = [
        'cliente_inc',
        'equipo_inc',
        'ciudad_inc',
        'variacion_inc',
        'fechacreacion_inc',
        'fechaincremento_inc',
        'valorrentamensual_inc',
        'nombrecontacto_inc',
        'estado_inc'
    ];

    public $timestamps = false;
}

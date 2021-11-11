<?php

namespace App\Models\Mantenimiento;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CambioElementos extends Model
{
    use HasFactory;

    protected $table = "cambioelementos";

    protected $primaryKey = "id_cel";

    protected $fillable = [
        'cliente_cel',
        'ciudad_cel',
        'direccion_cel',
        'fechacreacion_cel',
        'estado_cel',
        'equipoentrega1_cel',
        'equiporecibe1_cel',
        'equipoentrega2_cel',
        'equiporecibe2_cel',
        'equipoentrega3_cel',
        'equiporecibe3_cel'
    ];

    public $timestamps = false;
}

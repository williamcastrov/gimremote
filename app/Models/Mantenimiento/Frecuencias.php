<?php

namespace App\Models\Mantenimiento;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Frecuencias extends Model
{
    use HasFactory;

    protected $table = "frecuencias";

    protected $primaryKey = "id_fre";

    protected $fillable = [
        'descripcion_fre',
        'periodicidad_fre',
        'unidad_fre',
        'empresa_fre',
        'estado_fre',
    ];

    public $timestamps = false;
}



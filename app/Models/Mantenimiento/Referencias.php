<?php

namespace App\Models\Mantenimiento;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Referencias extends Model
{
    use HasFactory;

    protected $table = "referencias";

    protected $primaryKey = "equipo_ref";

    protected $fillable = [
        'codigo_ref',
        'empresa_ref',
        'nombre_ref',
        'grupo_ref',
        'estado_ref',
    ];

    public $timestamps = false;
}

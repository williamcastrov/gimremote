<?php

namespace App\Models\Mantenimiento;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FallasMtto extends Model
{
    use HasFactory;

    protected $table = "fallasdemtto";

    protected $primaryKey = "id_fmt";

    protected $fillable = [
        'tipodefalla_fmt',
        'descripcion_fmt',
        'empresa_fmt',
        'estado_fmt',
    ];

    public $timestamps = false;
}

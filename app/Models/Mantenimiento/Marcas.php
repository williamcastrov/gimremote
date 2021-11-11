<?php

namespace App\Models\Mantenimiento;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Marcas extends Model
{
    use HasFactory;

    protected $table = "marcas";

    protected $primaryKey = "id_mar";

    protected $fillable = [
        'descripcion_mar',
        'empresa_mar',
        'estado_mar',
    ];

    public $timestamps = false;
}


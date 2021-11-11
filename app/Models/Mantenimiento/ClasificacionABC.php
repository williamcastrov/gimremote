<?php

namespace App\Models\Mantenimiento;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ClasificacionABC extends Model
{
    use HasFactory;

    protected $table = "clasificacionABC";

    protected $primaryKey = "id_abc";

    protected $fillable = [
        'codigo_abc',
        'descripcion_abc',
        'empresa_abc',
        'estado_abc',
    ];

    public $timestamps = false;
}

<?php

namespace App\Models\Mantenimiento;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ExtrasEquipos extends Model
{
    use HasFactory;

    protected $table = "extrasequipos";

    protected $primaryKey = "id_ext";

    protected $fillable = [
        'codigo_ext',
        'equipo_ext',
        'tipo_ext',
        'descripcion_ext',
        'empresa_ext',
        'frecuencia_ext',
        'propietario_ext',
        'marca_ext',
        'antiguedad_ext',
        'grupoequipo_ext',
        'subgrupoparte_ext',
        'valoradquisicion_ext',
        'estadocontable_ext',
        'estadocliente_ext',
        'estadomtto_ext',
        'ctacontable_ext'
    ];

    public $timestamps = false;
}

<?php

namespace App\Models\Mantenimiento;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GruposEquipos extends Model
{
    use HasFactory;

    protected $table = "gruposequipos";

    protected $primaryKey = "id_grp";

    protected $fillable = [
        'codigogrupo_grp',
        'descripcion_grp',  
        'empresa_grp',
        'estado_grp',
    ];

    public $timestamps = false;
}

<?php

namespace App\Models\Mantenimiento;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SubGruposPartes extends Model
{
    use HasFactory;

    protected $table = "subgrupopartes";

    protected $primaryKey = "id_sgre";

    protected $fillable = [
        'codigo_sgre',
        'tipoconsecutivo_sgre',
        'tipo_sgre',
        'grupo_sgre',
        'descripcion_sgre',  
        'empresa_sgre',
        'estado_sgre',
        'consecutivo_sgre'
    ];

    public $timestamps = false;
}

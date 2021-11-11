<?php

namespace App\Models\Mantenimiento;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tiposmtto extends Model
{
    use HasFactory;

    protected $table = "tiposmantenimiento";

    protected $primaryKey = "id_tmt";

    protected $fillable = [
        'descripcion_tmt',
        'empresa_tmt',
        'estado_tmt'
    ];

    public $timestamps = false;
}

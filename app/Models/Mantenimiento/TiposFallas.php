<?php

namespace App\Models\Mantenimiento;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TiposFallas extends Model
{
    use HasFactory;

    protected $table = "tiposdefallas";

    protected $primaryKey = "id_tfa";

    protected $fillable = [
        'descripcion_tfa',
        'empresa_tfa',
        'estado_tfa',
    ];

    public $timestamps = false;
}

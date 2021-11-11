<?php

namespace App\Models\Mantenimiento;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DatosHorometro extends Model
{
    use HasFactory;

    protected $table = "datoshorometro";

    protected $primaryKey = "id_dhr";

    protected $fillable = [
        'codigoequipo_dhr',
        'valorhorometro_dhr'
    ];

    public $timestamps = false;
}

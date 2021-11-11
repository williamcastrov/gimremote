<?php

namespace App\Models\Mantenimiento;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InventarioEquipo extends Model
{
    use HasFactory;

    protected $table = "inventarioequipo";

    protected $primaryKey = "id_inve";

    protected $fillable = [
        'fechainventario_inve',
        'codigoequipo_inve',
        'serieequipo_inve',
        'estadoequipo_inve',
        'observacionequipo_inve',
        'codigobateria_inve',
        'seriebateria_inve' ,
        'estadobateria_inve' ,
        'observacionbateria_inve',
        'codigocargador_inve' ,
        'seriecargador_inve' ,
        'estadocargador_inve' ,
        'observacioncargador_inve'
    ];

    public $timestamps = false;
}

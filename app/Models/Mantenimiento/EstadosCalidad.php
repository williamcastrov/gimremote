<?php

namespace App\Models\Mantenimiento;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EstadosCalidad extends Model
{
    use HasFactory;
    protected $table = "estadoscalidad";

    protected $primaryKey = "id_estcal";

    protected $fillable = [
        'nombre_estcal',
        'empresa_estcal',
        'observacion_estcal'
    ];

    public $timestamps = false;
}

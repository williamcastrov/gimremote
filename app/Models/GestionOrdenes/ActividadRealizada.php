<?php

namespace App\Models\GestionOrdenes;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ActividadRealizada extends Model
{
    use HasFactory;

    protected $table = "actividadrealizada";

    protected $primaryKey = "id_rea";

    protected $fillable = [
        'descripcion_rea',
        'empresa_rea',
        'estado_rea',
    ];

    public $timestamps = false;
}

<?php

namespace App\Models\GestionOrdenes;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ordenes extends Model
{
    use HasFactory;

    protected $table = "ordenservicio";

    protected $primaryKey = "id_otr";

    protected $fillable = [
        'estado_otr',
        'tipo_otr',
        'tipooperacion_otr',
        'tiposervicio_otr',
        'fechaprogramada_otr',
        'fechainicia_otr',
        'fechafinal_otr',
        'diasoperacion_otr',
        'equipo_otr',
        'proveedor_otr',
        'cliente_otr',
        'operario_otr',
        'operariodos_otr',
        'contactocliente_otr',
        'subgrupoequipo_otr',
        'ciudad_otr',
        'resumenorden_otr',
        'prioridad_otr',
        'empresa_otr',
        'horometro_otr',
        'iniciatransporte_otr',
        'finaltransporte_otr',
        'tiempotransporte_otr',
        'tiempoorden_otr'
    ];

    public $timestamps = false;
}

<?php

namespace App\Models\GestionOrdenes;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TipoOperacion extends Model
{
    use HasFactory;

    protected $table = "tipooperacion";

    protected $primaryKey = "id_tope";

    protected $fillable = [
        'descripcion_tope',
        'empresa_tope',
        'estado_tope',
    ];

    public $timestamps = false;
}
<?php

namespace App\Models\GestionOrdenes;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FirmarOT extends Model
{
    use HasFactory;

    protected $table = "firmarot";

    protected $primaryKey = "id_fir";

    protected $fillable = [
		'id_fir',
    'imagen_fir',
    'firmatecnico_fir',
    'nombre_fir',
		'fechafirma_fir',
    'observacion_fir'
    ];

    public $timestamps = false;
}

<?php

namespace App\Models\GestionOrdenes;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CalificacionServicioOT extends Model
{
    use HasFactory;

    protected $table = "calificacionservicioot";

    protected $primaryKey = "ot_cse";

    protected $fillable = [
        'ot_cse',
        'valorservicio_cse'
    ];

    public $timestamps = false;
}

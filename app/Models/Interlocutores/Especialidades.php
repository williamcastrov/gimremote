<?php

namespace App\Models\Interlocutores;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Especialidades extends Model
{
    use HasFactory;

    protected $table = "especialidades_int";

    protected $primaryKey = "id_esp";

    protected $fillable = [
        'descripcion_esp',
        'empresa_esp',
        'estado_esp'
    ];

    public $timestamps = false;
}

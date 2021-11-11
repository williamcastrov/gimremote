<?php

namespace App\Models\Interlocutores;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TipoInterlocutores extends Model
{
    use HasFactory;

    protected $table = "tipo_interlocutor";

    protected $primaryKey = "id_tint";

    protected $fillable = [
        'descripcion_tint',
        'empresa_tint',
        'estado_tint',
    ];
    
    public $timestamps = false;
}

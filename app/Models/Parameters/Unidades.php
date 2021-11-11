<?php

namespace App\Models\Parameters;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Unidades extends Model
{
    use HasFactory;

    protected $table = "unidades";

    protected $primaryKey = "id_und";

    protected $fillable = [
        'descripcion_und',
        'tipo_und',
        'empresa_und',
        'estado_und',
    ];

    public $timestamps = false;
}

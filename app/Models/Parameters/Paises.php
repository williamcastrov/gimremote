<?php

namespace App\Models\Parameters;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Paises extends Model
{
    use HasFactory;

    protected $table = "paises";

    protected $primaryKey = "id_pai";

    protected $fillable = [
        'codigo_pai',
        'nombre_pai'
    ];

    public $timestamps = false;
}

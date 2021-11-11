<?php

namespace App\Models\Mantenimiento;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FotosEquipos extends Model
{
    use HasFactory;

    protected $table = "fotosequipos";

    protected $primaryKey = "id";

    protected $fillable = [
        'type',
        'name',
        'nombrefoto',
        'fechafoto',
        'url',
        'codigoequipo'
    ];

    public $timestamps = false;
}

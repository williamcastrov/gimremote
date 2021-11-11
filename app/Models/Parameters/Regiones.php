<?php

namespace App\Models\Parameters;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Regiones extends Model
{
    use HasFactory;

    protected $table = "regiones";

    protected $primaryKey = "id_reg";

    protected $fillable = [
        'nombre_reg',
        'pais_reg'
    ];

    public function pais(){
        return $this->belongsTo("App\Models\Parameters\Paises","pais_reg");
    }

    public $timestamps = false;
}

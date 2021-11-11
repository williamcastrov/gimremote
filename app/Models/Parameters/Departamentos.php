<?php

namespace App\Models\Parameters;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Departamentos extends Model
{
    use HasFactory;

    protected $table = "departamentos";

    protected $primaryKey = "id_dep";

    protected $fillable = [
        'codigo_dep',
        'nombre_dep',
        'region_dep'
    ];

    public function region(){
        return $this->belongsTo("App\Models\Parameters\Regiones","region_dep");
    }

    public $timestamps = false;
}

<?php

namespace App\Models\Mantenimiento;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EstadosMtto extends Model
{
    use HasFactory;

    protected $table = "estadosmtto";

    protected $primaryKey = "id_estmtto";

    protected $fillable = [
        'nombre_estmtto',
        'empresa_estmtto',
        'observacion_estmtto'
    ];

    public function empresa(){
        return $this->belongsTo("App\Models\Parameters\Empresa","empresa_estmtto");
    }

    public $timestamps = false;
}

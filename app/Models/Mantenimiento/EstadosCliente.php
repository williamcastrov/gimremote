<?php

namespace App\Models\Mantenimiento;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EstadosCliente extends Model
{
    use HasFactory;

    protected $table = "estadoscliente";

    protected $primaryKey = "id_estcli";

    protected $fillable = [
        'nombre_estcli',
        'empresa_estcli',
        'observacion_estcli'
    ];

    public function empresa(){
        return $this->belongsTo("App\Models\Parameters\Empresa","empresa_estcli");
    }

    public $timestamps = false;
}

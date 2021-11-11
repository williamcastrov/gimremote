<?php

namespace App\Models\Mantenimiento;
use Illuminate\Support\Facades\DB;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NombreCargoOT extends Model
{
    use HasFactory;

    protected $table = "nombrecargoOT";

    protected $primaryKey = "ot_ncot";

    protected $fillable = [
        'ot_ncot',
        'nombrerecibe_ncot',
        'cargorecibe_ncot'
    ];

    public $timestamps = false;

}

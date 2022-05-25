<?php

namespace App\Models\GestionOrdenes;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PlacasVehiculos extends Model
{
    use HasFactory;

    protected $table = "placasvehiculos";

    protected $primaryKey = "id";

    protected $fillable = [
		'id',
        'tipovehiculo',
        'placa',
        'empresa',
		'empresa',
        'estado'
    ];
    public $timestamps = false;
}

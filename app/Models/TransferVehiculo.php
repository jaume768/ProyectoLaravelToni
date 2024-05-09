<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TransferVehiculo extends Model
{
    protected $table = 'transfer_vehiculo'; 

    public $timestamps = false; 

    protected $primaryKey = 'id_vehiculo'; 

    protected $fillable = [
        'Descripción',
        'email_conductor',
        'password' 
    ];

    public function reservas()
    {
        return $this->hasMany(TransferReserva::class, 'id_vehiculo', 'id_vehiculo');
    }

    public function conductor()
    {
        return $this->belongsTo(TransferViajero::class, 'email_conductor', 'email');
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class TransferViajero extends Authenticatable
{
    use Notifiable;

    protected $table = 'transfer_viajeros';
    protected $primaryKey = 'id_viajero';

    protected $fillable = [
        'nombre', 'apellido1', 'apellido2', 'direccion', 'codigoPostal',
        'ciudad', 'pais', 'email', 'password', 'rol'
    ];

    protected $hidden = [
        'password',
    ];

    // Si tienes campos de tipo date o datetime, puedes especificarlos aquí
    protected $dates = [];

    // Castings de tipos para tus atributos, por ejemplo:
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
}

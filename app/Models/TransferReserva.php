<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TransferReserva extends Model
{
    protected $table = 'transfer_reservas';
    protected $primaryKey = 'id_reserva';

    public $timestamps = false;

    protected $fillable = [
        'localizador',
        'id_hotel',
        'id_tipo_reserva',
        'email_cliente',
        'fecha_reserva',
        'fecha_modificacion',
        'id_destino',
        'fecha_entrada',
        'hora_entrada',
        'numero_vuelo_entrada',
        'origen_vuelo_entrada',
        'hora_vuelo_salida',
        'fecha_vuelo_salida',
        'num_viajeros',
        'id_vehiculo'
    ];

    protected $dates = [
        'fecha_reserva',
        'fecha_modificacion',
        'fecha_entrada',
        'hora_entrada',
        'hora_vuelo_salida',
        'fecha_vuelo_salida'
    ];

    public function viajero()
    {
        return $this->belongsTo(TransferViajero::class, 'email_cliente', 'email');
    }

}

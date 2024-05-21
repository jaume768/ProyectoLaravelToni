<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TransferHotel extends Model
{
    protected $table = 'tranfer_hotel';
    protected $primaryKey = 'id_hotel';
    public $timestamps = false;

    protected $fillable = [
        'id_zona',
        'Comision',
        'nombre'
    ];

    public function zona()
    {
        return $this->belongsTo(TransferZona::class, 'id_zona');
    }

    public function reservas()
    {
        return $this->hasMany(TransferReserva::class, 'id_hotel');
    }
}

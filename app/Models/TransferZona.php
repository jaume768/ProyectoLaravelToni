<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TransferZona extends Model
{
    protected $table = 'transfer_zona';
    protected $primaryKey = 'id_zona';

    public $timestamps = false;

    protected $fillable = [
        'descripcion'
    ];

    public function reservas()
    {
        return $this->hasMany(TransferReserva::class, 'id_destino', 'id_zona');
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Comision extends Model
{
    protected $table = 'comisiones';
    protected $primaryKey = 'id';
    public $timestamps = false;

    protected $fillable = [
        'id_hotel',
        'mes',
        'comision_total'
    ];

    public function hotel()
    {
        return $this->belongsTo(TransferHotel::class, 'id_hotel');
    }
}

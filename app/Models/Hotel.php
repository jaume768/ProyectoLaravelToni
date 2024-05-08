<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Hotel extends Model
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
        return $this->belongsTo(Zona::class, 'id_zona');
    }
}

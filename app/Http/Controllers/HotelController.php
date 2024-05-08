<?php

namespace App\Http\Controllers;

use App\Models\Hotel; // Asegúrate de importar tu modelo de Hotel

class HotelController extends Controller
{
    public function getHotels()
    {
        $hotels = Hotel::select('id', 'nombre')->get();

        return $hotels;
    }
}

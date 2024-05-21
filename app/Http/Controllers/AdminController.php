<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\TransferHotel;
use App\Models\TransferVehiculo;
use App\Models\TransferPrecio;
use App\Models\TransferReserva;
use App\Models\Comision;

class AdminController extends Controller
{
    public function listHotels() {
        $hoteles = TransferHotel::all();
        $vehiculos = TransferVehiculo::all();
        return compact('hoteles', 'vehiculos');
    }

    public function updatePrices(Request $request) {
        $request->validate([
            'hotel' => 'required|exists:tranfer_hotel,id_hotel',
            'vehiculo' => 'required|exists:transfer_vehiculo,id_vehiculo',
            'precio' => 'required|numeric',
        ]);

        TransferPrecio::updateOrCreate(
            ['id_hotel' => $request->hotel, 'id_vehiculo' => $request->vehiculo],
            ['precio' => $request->precio]
        );

        return response()->json(['message' => 'Precio actualizado con éxito.']);
    }

    public function calculateCommissions(Request $request) {
        $mes = $request->input('mes');
        $comisiones = TransferReserva::whereMonth('fecha_reserva', $mes)
            ->with('hotel')  // Aseguramos que se carga la relación hotel
            ->selectRaw('id_hotel, SUM(comision) as comision_total')
            ->groupBy('id_hotel')
            ->get();

        return $comisiones;
    }
}



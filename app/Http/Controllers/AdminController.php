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
        $validatedData = $request->validate([
            'hotel' => 'required|exists:tranfer_hotel,id_hotel',
            'vehiculo' => 'required|exists:transfer_vehiculo,id_vehiculo',
            'precio' => 'required|numeric',
        ]);

        $precio = TransferPrecio::firstOrNew(
            ['id_hotel' => $validatedData['hotel'], 'id_vehiculo' => $validatedData['vehiculo']]
        );

        $precio->Precio = $validatedData['precio'];
        $precio->save();

        $successMessage = urlencode('Precio actualizado con éxito.');
        return redirect("/admin?section=precios&success=$successMessage");
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

    public function showCommissions(Request $request) {
        $mes = $request->input('mes', date('m'));
        $comisiones = $this->calculateCommissions($request);

        return redirect('/admin?section=comisiones&mes=' . $mes);
    }
}



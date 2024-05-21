<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\TransferReserva;
use Illuminate\Support\Facades\DB;
use App\Models\TransferZona;

class ReservationController extends Controller
{
    public function store(Request $request)
    {

        $validated = $request->validate([
            'id_tipo_reserva' => 'required|integer',
            'id_hotel' => 'required|integer',
            'num_viajeros' => 'required|integer',
            'dia_llegada' => 'nullable|date',
            'hora_llegada' => 'nullable|date_format:H:i',
            'numero_vuelo_llegada' => 'nullable|string',
            'origen_vuelo_entrada' => 'nullable|string',
            'dia_vuelo' => 'nullable|date',
            'hora_vuelo' => 'nullable|date_format:H:i', 
            'hora_recogida' => 'nullable|date_format:H:i'
        ]);
        

        $localizador = substr(md5(uniqid(rand(), true)), 0, 4);
        $email_cliente = $request->input('emailCliente', session('user_email'));

        $reservation = new TransferReserva([
            'localizador' => $localizador,
            'id_hotel' => $validated['id_hotel'],
            'id_tipo_reserva' => $validated['id_tipo_reserva'],
            'email_cliente' => $email_cliente,
            'fecha_reserva' => now(),
            'fecha_modificacion' => now(),
            'id_destino' => $validated['id_hotel'],
            'fecha_entrada' => $validated['dia_llegada'] ?? null,
            'hora_entrada' => $validated['hora_llegada'] ?? null,
            'numero_vuelo_entrada' => $validated['numero_vuelo_llegada'] ?? null,
            'origen_vuelo_entrada' => $validated['origen_vuelo_entrada'] ?? null,
            'fecha_vuelo_salida' => $validated['dia_vuelo'] ?? null,
            'hora_vuelo_salida' => $validated['hora_vuelo'] ?? null,
            'num_viajeros' => $validated['num_viajeros'],
            'id_vehiculo' => 1
        ]);

        $reservation->save();

        $rol = session('rol');
        switch ($rol) {
            case 'Administrador':
                return redirect()->route('admin')->with('success', 'Reserva creada con éxito.');
            case 'Particular':
                return redirect()->route('particular')->with('success', 'Reserva creada con éxito.');
            default:
                return redirect()->route('particular')->with('success', 'Reserva creada con éxito.');
        }
    }

    public function reservasPorZonas()
    {
        // Obtener todas las zonas
        $zonas = TransferZona::all();

        // Calcular las reservas por zona
        $totalReservas = TransferReserva::count();
        $resultados = $zonas->map(function ($zona) use ($totalReservas) {
            $reservasPorZona = TransferReserva::where('id_destino', $zona->id_zona)->count();
            $porcentaje = $totalReservas ? ($reservasPorZona / $totalReservas) * 100 : 0;

            return [
                'zona' => $zona->descripcion,
                'numero_traslados' => $reservasPorZona,
                'porcentaje_total' => round($porcentaje, 2)
            ];
        });

        return response()->json($resultados);
    }
}


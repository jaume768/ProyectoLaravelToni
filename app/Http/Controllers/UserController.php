<?php

namespace App\Http\Controllers;

use App\Models\TransferViajero;
use App\Models\TransferReserva;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function getUserReservations($email)
    {
        $user = TransferViajero::where('email', $email)->first();
        if ($user) {
            $reservations = TransferReserva::where('email_cliente', $user->email)->get();
            return $reservations;
        }
        return collect(); // Devuelve una colección vacía si no hay usuario
    }

    public function getUserData()
    {
        $email = session('user_email');
        $user = TransferViajero::where('email', $email)->firstOrFail();
        return $user;
    }

    public function updateUserData(Request $request)
    {
        $email = session('user_email');
        $user = TransferViajero::where('email', $email)->firstOrFail();

        $validated = $request->validate([
            'nombre' => 'required',
            'apellido1' => 'required',
            'apellido2' => 'required',
            'direccion' => 'required',
            'codigoPostal' => 'required',
            'ciudad' => 'required',
            'pais' => 'required',
            'email' => 'required|email'
        ]);

        $user->update($validated);

        session(['update_success' => 'Datos actualizados con éxito.']);
        return redirect()->back();
    }

    public function cancelReservation($idReserva)
    {
        $reservation = TransferReserva::find($idReserva);

        if ($reservation) {
            $reservation->delete();
            return back()->with('success', 'Reserva cancelada con éxito.');
        }

        return back()->with('error', 'Reserva no encontrada.');
    }
}


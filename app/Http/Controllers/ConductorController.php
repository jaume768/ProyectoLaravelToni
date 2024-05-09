<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\TransferViajero;
use App\Models\TransferReserva;
use App\Models\TransferVehiculo;

class ConductorController extends Controller
{
    public function index(Request $request)
    {
        $email = session('user_email');
        if (!$email || session('rol') !== 'Conductor') {
            return redirect('login')->with('error', 'Acceso denegado. Debe iniciar sesión como conductor');
        }

        $section = $request->query('section', 'calendario');

        if ($section === 'calendario') {
            // Llamar a la función calendario y obtener los datos
            $calendarioData = $this->calendario($request, $email);
            return view('conductor', compact('section', 'calendarioData'));
        }

        return view('conductor', compact('section'));
    }

    public function calendarioGet(Request $request)
    {
        $email = session('user_email');
        if (!$email || session('rol') !== 'Conductor') {
            return redirect('login')->with('error', 'Acceso denegado. Debe iniciar sesión como conductor');
        }
    
        $startDate = $request->input('startDate', date('Y-m-01'));
        $endDate = $request->input('endDate', date('Y-m-t'));
        $vehicle = TransferVehiculo::where('email_conductor', $email)->first();
    
        $trayectos = [];
        if ($vehicle) {
            $trayectos = TransferReserva::where('id_vehiculo', $vehicle->id_vehiculo)
                ->whereBetween('fecha_entrada', [$startDate, $endDate])
                ->get();
        }
    
        return [
            'startDate' => $startDate,
            'endDate' => $endDate,
            'trayectos' => $trayectos,
        ];
    }

    public function calendario(Request $request){
        $section = $request->query('section', 'calendario');
        return view('conductor', compact('section'));
    }
}


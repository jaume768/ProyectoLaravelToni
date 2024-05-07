<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\TransferViajero; // Asumiendo que tienes un modelo Eloquent llamado TransferViajero
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function registerUser(Request $request) {
        $request->validate([
            'nombre' => 'required|string|max:100',
            'apellido1' => 'required|string|max:100',
            'apellido2' => 'required|string|max:100',
            'direccion' => 'required|string|max:100',
            'codigoPostal' => 'required|string|min:5|max:5',
            'ciudad' => 'required|string|max:100',
            'pais' => 'required|string|max:100',
            'email' => 'required|string|email|max:100|unique:transfer_viajeros',
            'password' => 'required|string|min:6|max:100',
            'rol' => 'in:Conductor,Corporativo,Administrador,Particular', // Asegura que el rol está dentro de los permitidos
        ]);
    
        $viajero = new TransferViajero([
            'nombre' => $request->nombre,
            'apellido1' => $request->apellido1,
            'apellido2' => $request->apellido2,
            'direccion' => $request->direccion,
            'codigoPostal' => $request->codigoPostal,
            'ciudad' => $request->ciudad,
            'pais' => $request->pais,
            'email' => $request->email,
            'password' => bcrypt($request->password), // Encripta la contraseña antes de guardarla
            'rol' => $request->rol ?? 'Particular', // Establece un rol predeterminado si no se proporciona
        ]);
    
        $viajero->save();
    
        return redirect()->route('login')->with('msg', 'Registro exitoso. Por favor inicie sesión.');
    }
    

    public function loginUser(Request $request) {
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);
    
        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
    
            $user = Auth::user();
            switch ($user->rol) {
                case 'Administrador':
                    return redirect()->intended('admin_view');
                case 'Particular':
                    return redirect()->intended('particular_view');
                case 'Conductor':
                    return redirect()->intended('conductor_view');
                default:
                    return redirect()->intended('home'); 
            }
        }
    
        return back()->withErrors([
            'email' => 'The provided credentials do not match our records.',
        ])->withInput($request->except('password'));
    }
    

}    
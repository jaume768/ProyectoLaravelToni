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
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        $user = TransferViajero::where('email', $request->email)->first();

        if ($user && Hash::check($request->password, $user->password)) {

            $request->session()->put('user_email', $user->email);
            $request->session()->put('rol', $user->rol);

            switch ($user->rol) {
                case 'Administrador':
                    return redirect()->intended('admin');
                case 'Particular':
                    return redirect()->intended('particular');
                case 'Conductor':
                    return redirect()->intended('conductor');
                default:
                    return redirect()->intended('home'); 
            }
        } else {
            return back()->withErrors(['email' => 'Las credenciales proporcionadas no coinciden con nuestros registros.'])->withInput($request->except('password'));
        }
    }

    public function logout(Request $request) {
        $request->session()->flush(); // Elimina todos los datos de la sesión
        return redirect('/login')->with('msg', 'Sesión cerrada correctamente.');
    }


}    
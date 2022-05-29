<?php

namespace App\Http\Controllers;

use App\Models\Usuario;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function acceder()
    {
        return view('auth.acceso');
    }

    public function autenticar(Request $request)
    {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required']
        ]);
        $credentials['activo'] = 1;

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();

            return redirect()->intended('admin')->withSuccess('Bienvenido al panel de Administración');
        }

        return back()->withErrors([
            'email' => 'El email no está registrado.',
        ]);
    }

    public function registro()
    {
        return view('auth.registro');
    }

    public function registrarse(Request $request)
    {
        $request->validate([
            'nombre' => 'required',
            'email' => 'required|email|unique:usuarios',
            'password' => 'required|confirmed|min:6',
        ]);

        //convierto el objeto $request a un array
        $data = $request->all();

        $usuario = Usuario::create([
            'nombre' => $data['nombre'],
            'email' => $data['email'],
            'password' => Hash::make($data['password'])
        ]);
        //después del registro hago el login
        Auth::login($usuario);

        return redirect("admin")->withSuccess('Te has registrado correctamente. Bienvenido');
    }

    public function salir(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('admin');
    }
}

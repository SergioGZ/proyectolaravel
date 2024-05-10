<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function showLoginForm()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $credentials = $request->only('nick', 'password');
        $recordar = $request->only('recordar');

        if (Auth::attempt($credentials)) {
            session()->flash('success', 'Inicio de sesión correcto');
            // Obtén el usuario autenticado
            $user = Auth::user();

            // Recordar usuarios
            if (isset($recordar['recordar'])) {
                Auth::login($user, true);
            } else {
                Auth::login($user, false);
            }

            return redirect()->intended('/');

        } else {
            return redirect()->route('login')->with('error', 'Credenciales incorrectas');
        }

    }
}


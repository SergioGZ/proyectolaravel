<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Usuario;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class RegisterController extends Controller
{
    public function showRegistrationForm()
    {
        return view('auth.register');
    }

    public function register(Request $request)
    {
        $request->validate([
            'nick' => 'required|string|unique:usuarios',
            'password' => 'required|string',
        ]);

        Usuario::create([
            'nick' => $request->nick,
            'password' => Hash::make($request->password),
        ]);

        return redirect('/login')->with('success', 'Usuario registrado correctamente. Por favor inicia sesión.');
    }
}


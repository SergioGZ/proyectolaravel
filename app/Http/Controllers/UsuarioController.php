<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Usuario; // Importar el modelo Usuario


class UsuarioController extends Controller
{

    public function index()
    {
        $usuarios = Usuario::all();
        return view('usuarios.index', compact('usuarios'));
    }

    public function create()
    {
        return view('usuarios.create');
    }

    public function store(Request $request)
    {
            // Procesar la imagen si se proporciona
        if ($request->hasFile('imagen_avatar')) {
            $imagen = $request->file('imagen_avatar');
            // Obtener el nombre del archivo generado
            $nombreArchivo = 'avatar' . time() . '.' . $imagen->getClientOriginalExtension();
            $imagen->move(public_path('/storage/avatars'), $nombreArchivo);


            $usuario = new Usuario();
            $usuario->nick = $request->nick;
            $usuario->nombre = $request->nombre;
            $usuario->apellidos = $request->apellidos;
            $usuario->email = $request->email;
            $usuario->password = bcrypt($request->password);
            $usuario->imagen_avatar = $nombreArchivo;
            $usuario->save();
            return redirect('/usuarios');
        } else {
            $usuario = new Usuario();
            $usuario->nick = $request->nick;
            $usuario->nombre = $request->nombre;
            $usuario->apellidos = $request->apellidos;
            $usuario->email = $request->email;
            $usuario->password = bcrypt($request->password);
            $usuario->save();
            return redirect('/usuarios');
        }
    }

    public function show($id)
    {
        $usuario = Usuario::find($id);
        return view('usuarios.show', compact('usuario'));
    }

    public function edit($id)
    {
        if (auth()->user()->id != $id) {
            session()->flash('error', 'No puedes editar un usuario que no seas tú');
            return redirect('/usuarios');
        }
        $usuario = Usuario::find($id);
        return view('usuarios.edit', compact('usuario'));
    }

    public function update(Request $request, $id)
    {
        if (auth()->user()->id != $id) {
            session()->flash('error', 'No puedes editar un usuario que no seas tú');
            return redirect('/usuarios');
        }

        if ($request->hasFile('imagen_avatar')) {
            $imagen = $request->file('imagen_avatar');
            // Obtener el nombre del archivo generado
            $nombreArchivo = 'avatar' . time() . '.' . $imagen->getClientOriginalExtension();
            $imagen->move(public_path('/storage/avatars'), $nombreArchivo);

            $usuario = Usuario::find($id);
            $usuario->nick = $request->nick;
            $usuario->nombre = $request->nombre;
            $usuario->apellidos = $request->apellidos;
            $usuario->email = $request->email;
            $usuario->imagen_avatar = $nombreArchivo;
        } else {
            $usuario = Usuario::find($id);
            $usuario->nick = $request->nick;
            $usuario->nombre = $request->nombre;
            $usuario->apellidos = $request->apellidos;
            $usuario->email = $request->email;
        }

        $usuario->save();
        return redirect('/usuarios');
    }

    public function destroy($id)
    {
        if (auth()->user()->id != $id) {
            session()->flash('error', 'No puedes eliminar un usuario que no seas tú');
            return redirect('/usuarios');
        }
        $usuario = Usuario::find($id);
        $usuario->delete();
        return redirect('/usuarios');
    }

}

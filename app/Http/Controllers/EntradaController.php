<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Entrada; // Importar el modelo Entrada
use App\Models\Categoria; // Importar el modelo Categoria

class EntradaController extends Controller
{
    public function index()
    {
        $entradas = Entrada::all();
        return view('entradas.index', compact('entradas'));
    }

    public function create()
    {
        $categorias = Categoria::all();
        return view('entradas.create', compact('categorias'));
    }

    public function store(Request $request)
    {
        // Procesar la imagen si se proporciona
        if ($request->hasFile('imagen')) {
            $imagen = $request->file('imagen');
            // Obtener el nombre del archivo generado
            $nombreArchivo = 'imagen' . time() . '.' . $imagen->getClientOriginalExtension();
            $imagen->move(public_path('/storage/entradas'), $nombreArchivo);
        } else {
            return redirect('/entradas/create')->with('error', 'Debes proporcionar una imagen');
        }

        $entrada = new Entrada();
        $entrada->usuario_id = auth()->user()->id;
        $entrada->categoria_id = $request->categoria_id;
        $entrada->titulo = $request->titulo;
        $entrada->imagen = $nombreArchivo;
        $entrada->descripcion = $request->descripcion;
        $entrada->fecha = $request->fecha;
        $entrada->save();
        return redirect('/entradas');

    }

    public function show($id)
    {
        $entrada = Entrada::find($id);
        return view('entradas.show', compact('entrada'));
    }

    public function edit($id)
    {
        if (auth()->user()->id != Entrada::find($id)->usuario_id) {
            session()->flash('error', 'No puedes editar una entrada que no te pertenece');
            return redirect('/entradas');
        }
        $entrada = Entrada::find($id);
        $categorias = Categoria::all();
        return view('entradas.edit', compact('entrada', 'categorias'));
    }

    public function update(Request $request, $id)
    {
        if (auth()->user()->id != Entrada::find($id)->usuario_id) {
            session()->flash('error', 'No puedes editar una entrada que no te pertenece');
            return redirect('/entradas');
        }

        // Procesar la imagen si se proporciona
        if ($request->hasFile('imagen')) {
            $imagen = $request->file('imagen');
            // Obtener el nombre del archivo generado
            $nombreArchivo = 'imagen' . time() . '.' . $imagen->getClientOriginalExtension();
            $imagen->move(public_path('/storage/entradas'), $nombreArchivo);
        }
        $entrada = Entrada::find($id);
        if ($request->hasFile('imagen')) {
            $entrada->imagen = $nombreArchivo;
        }
        $entrada->categoria_id = $request->categoria_id;
        $entrada->titulo = $request->titulo;
        $entrada->descripcion = $request->descripcion;
        $entrada->fecha = $request->fecha;
        $entrada->save();
        return redirect('/entradas');
    }

    public function destroy($id)
    {
        if (auth()->user()->id != Entrada::find($id)->usuario_id) {
            session()->flash('error', 'No puedes eliminar una entrada que no te pertenece');
            return redirect('/entradas');
        }

        $entrada = Entrada::find($id);
        $entrada->delete();
        return redirect('/entradas');
    }
}

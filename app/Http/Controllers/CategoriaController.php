<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Categoria; // Importar el modelo Categoria

class CategoriaController extends Controller
{
    //

    public function mostrarCategorias()
    {
        $categorias = Categoria::all(); // Obtener todas las categorías

        return view('entradas.create', compact('categorias')); // Pasar las categorías a la vista
    }

}

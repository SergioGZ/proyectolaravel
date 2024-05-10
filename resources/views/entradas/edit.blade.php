@extends('layouts.app')  {{-- Utiliza una plantilla base --}}

@section('scripts')  {{-- Agrega scripts --}}
    <script src="https://cdn.ckeditor.com/4.16.2/standard/ckeditor.js"></script>
@endsection  {{-- Fin de la sección de scripts --}}

@section('content')  {{-- Sección de contenido --}}

<div class="container">
    <h1>Editar Entrada</h1>

    <div class="card">
        <div class="card-header">
            <h4>{{ $entrada->titulo }}</h4>
        </div>
        <div class="card-body">
            <form action="{{ route('entradas.update', $entrada->id) }}" method="POST" enctype="multipart/form-data">
                @csrf  {{-- Token de seguridad --}}
                @method('PUT')  {{-- Modificar un recurso --}}
                <div class="form-group">
                    <label for="titulo">Título</label>
                    <input type="text" name="titulo" id="titulo" class="form-control" value="{{ $entrada->titulo }}">
                </div>
                <div class="form-group">
                    <label for="descripcion">Descripción</label>
                    <textarea name="descripcion" id="descripcion" class="form-control">{{ $entrada->descripcion }}</textarea>
                    <script>
                        CKEDITOR.replace('descripcion');
                    </script>
                </div>
                <div class="form-group">
                    <label for="categoria_id">Categoría</label>
                    <select name="categoria_id" id="categoria_id" class="form-control">
                        @foreach ($categorias as $categoria)
                            <option value="{{ $categoria->id }}" {{ $categoria->id == $entrada->categoria_id ? 'selected' : '' }}>{{ $categoria->nombre_categoria }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label for="imagen">Imagen</label>
                    <input type="file" name="imagen" id="imagen" class="form-control" value="{{ $entrada->imagen }}">
                    <img src="{{ asset('storage/entradas/' . $entrada->imagen) }}" alt="Imagen de la entrada" class="img-thumbnail" style="width: 200px;">
                </div>
                <div class="form-group">
                    <label for="fecha">Fecha</label>
                    <input type="date" name="fecha" id="fecha" class="form-control" value="{{ $entrada->fecha }}">
                </div>
                <div class="form-group">
                    <button type="submit" class="btn btn-primary">Guardar</button>
                    <a href="{{ route('entradas.index') }}" class="btn btn-primary">Volver</a>
                </div>
            </form>
        </div>
    </div>
</div>
<script>
    window.onload = function() {
        CKEDITOR.replace('descripcion');
    };
</script>

@endsection  {{-- Fin de la sección de contenido --}}

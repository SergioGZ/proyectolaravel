@extends('layouts.app')  {{-- Utiliza una plantilla base --}}

@section('content')  {{-- Sección de contenido --}}

<div class="container">
    <h1>Editar Usuario</h1>

    <div class="card">
        <div class="card-header">
            <h4>{{ $usuario->nombre }} {{ $usuario->apellidos }}</h4>
        </div>
        <div class="card-body">
            <form action="{{ route('usuarios.update', $usuario->id) }}" method="POST" enctype="multipart/form-data">
                @csrf  {{-- Token de seguridad --}}
                @method('PUT')  {{-- Modificar un recurso --}}

                <div class="form-group">
                    <label for="nick">Nick:</label>
                    <input type="text" name="nick" id="nick" class="form-control" value="{{ $usuario->nick }}">
                </div>
                <div class="form-group">
                    <label for="nombre">Nombre:</label>
                    <input type="text" name="nombre" id="nombre" class="form-control" value="{{ $usuario->nombre }}">
                </div>
                <div class="form-group">
                    <label for="apellidos">Apellidos:</label>
                    <input type="text" name="apellidos" id="apellidos" class="form-control" value="{{ $usuario->apellidos }}">
                </div>
                <div class="form-group">
                    <label for="email">Email:</label>
                    <input type="email" name="email" id="email" class="form-control" value="{{ $usuario->email }}">
                </div>
                <div class="form-group">
                    <label for="imagen_avatar">Imagen de perfil:</label>
                    <input type="file" name="imagen_avatar" id="imagen_avatar" class="form-control-file">
                </div>
                <div class="form-group">
                    <button type="submit" class="btn btn-primary">Guardar Cambios</button>
                </div>
            </form>
        </div>
    </div>
</div>

@endsection  {{-- Fin de la sección de contenido --}}

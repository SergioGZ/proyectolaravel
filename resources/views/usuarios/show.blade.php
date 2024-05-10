@extends('layouts.app')  {{-- Utiliza una plantilla base --}}

@section('content')  {{-- Sección de contenido --}}

<div class="container">
    <h1>Detalles del Usuario</h1>

    <div class="card">
        <div class="card-header">
            <h4>{{ $usuario->nombre }} {{ $usuario->apellidos }}</h4>
        </div>
        <div class="card-body">
            <p><strong>Nick:</strong> {{ $usuario->nick }}</p>
            <p><strong>Email:</strong> {{ $usuario->email }}</p>
            <p><strong>Fecha de Creación:</strong> {{ $usuario->created_at }}</p>
            <p><strong>Fecha de Actualización:</strong> {{ $usuario->updated_at }}</p>
            <img src="{{ asset('storage/avatars/' . $usuario->imagen_avatar) }}" alt="Imagen de perfil" class="img-thumbnail" style="width: 200px;">
        </div>
        <div class="card-footer">
            <a href="{{ route('usuarios.index') }}" class="btn btn-primary">Volver</a>
        </div>
    </div>
</div>

@endsection  {{-- Fin de la sección de contenido --}}

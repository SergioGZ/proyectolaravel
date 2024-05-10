@extends('layouts.app')  {{-- Utiliza una plantilla base --}}

@section('scripts')  {{-- Agrega scripts --}}
    <link rel="stylesheet" href="https://cdns.cloudflare.com/ajax/libs/twitter-bootstrap/5.0.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.4/css/dataTables.bootstrap5.min.css">
@endsection  {{-- Fin de la sección de scripts --}}

@section('content')  {{-- Sección de contenido --}}
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h1>Entradas</h1>
                @if(session('error'))
                <div class="alert alert-danger">
                    {{ session('error') }}
                </div>
                @endif
                <a class="btn btn-primary mb-5" href="{{ route('entradas.create') }}">Nueva Entrada</a>
                <table id="entradas" class="table table-responsive table-striped bg-light mt-2">
                    <thead>
                        <tr>
                            <th>Id</th>
                            <th>Titulo</th>
                            <th>Usuario</th>
                            <th>Categoría</th>
                            <th>Descripción</th>
                            <th>Fecha</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($entradas as $entrada)
                            <tr>
                                <td>{{ $entrada->id }}</td>
                                <td class="text-justify text-break col-2">{{ $entrada->titulo }}</td>
                                <td>{{ $entrada->usuario->nick }}</td>
                                <td>{{ $entrada->categoria->nombre_categoria }}</td>
                                <td class="text-justify text-break col-4">{{ $entrada->descripcion }}</td>
                                <td>{{ $entrada->fecha }}</td>
                                <td>
                                    <a href="{{ route('entradas.show', $entrada->id) }}" class="btn btn-primary btn-sm">Ver Detalles</a>
                                    <a href="{{ route('entradas.edit', $entrada->id) }}" class="btn btn-warning btn-sm">Editar</a>
                                    <form action="{{ route('entradas.destroy', $entrada->id) }}" method="POST" style="display: inline;" onsubmit="return confirm('¿Estás seguro de que deseas eliminar esta entrada?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm">Eliminar</button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.4/js/dataTables.bootstrap5.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#entradas').DataTable({
                "language": {
                    "lengthMenu": "Mostrar _MENU_ registros por página",
                    "zeroRecords": "No se encontraron resultados",
                    "info": "Mostrando la página _PAGE_ de _PAGES_",
                    "infoEmpty": "No hay registros disponibles",
                    "infoFiltered": "(filtrado de _MAX_ registros totales)",
                    "search": "Buscar:",
                    "paginate": {
                        "first": "Primero",
                        "last": "Último",
                        "next": "Siguiente",
                        "previous": "Anterior",
                    }
                },
                "lengthMenu": [5, 10, 15, 20]
            });
        });
    </script>
@endsection

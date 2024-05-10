@extends('layouts.app')  {{-- Utiliza una plantilla base --}}

@section('scripts')  {{-- Agrega scripts --}}
    <link rel="stylesheet" href="https://cdns.cloudflare.com/ajax/libs/twitter-bootstrap/5.0.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.4/css/dataTables.bootstrap5.min.css">
@endsection  {{-- Fin de la sección de scripts --}}

@section('content')  {{-- Sección de contenido --}}
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h1>Usuarios</h1>
                @if(session('error'))
                <div class="alert alert-danger">
                    {{ session('error') }}
                </div>
                @endif
                <!--<a class="btn btn-primary mb-5" href="{{ route('usuarios.create') }}">Nuevo Usuario</a>-->
                <button class="btn btn-success mb-5" onclick="exportToExcel('usuarios', 'usuarios')">Exportar a Excel</button>
                <table id="usuarios" class="table table-responsive table-striped bg-light mt-2">
                    <thead>
                        <tr>
                            <th>Id</th>
                            <th>Nick</th>
                            <th>Nombre</th>
                            <th>Apellidos</th>
                            <th>Correo</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($usuarios as $usuario)
                            <tr>
                                <td>{{ $usuario->id }}</td>
                                <td>{{ $usuario->nick }}</td>
                                <td>{{ $usuario->nombre }}</td>
                                <td>{{ $usuario->apellidos }}</td>
                                <td>{{ $usuario->email }}</td>
                                <td>
                                    <a href="{{ route('usuarios.show', $usuario->id) }}" class="btn btn-primary btn-sm">Ver Detalles</a>
                                    <a href="{{ route('usuarios.edit', $usuario->id) }}" class="btn btn-warning btn-sm">Editar</a>
                                    <form action="{{ route('usuarios.destroy', $usuario->id) }}" method="POST" style="display: inline;" onsubmit="return confirm('¿Estás seguro de que deseas eliminar este usuario?');">
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
            $('#usuarios').DataTable({
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
                }
            });
        });
    </script>

    <!-- Incluir xlsx.js desde CDN -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/xlsx/0.18.4/xlsx.full.min.js"></script>

    <script>
        function exportToExcel(tableId, filename = 'data') {
        // Obtener la tabla HTML
        const dataTable = document.getElementById(tableId);
        // Crear un objeto de trabajo de Excel
        const ws = XLSX.utils.table_to_sheet(dataTable);
        // Crear un libro de trabajo de Excel
        const wb = XLSX.utils.book_new();
        // Agregar la hoja de trabajo al libro de trabajo
        XLSX.utils.book_append_sheet(wb, ws, 'Sheet1');
        // Guardar el libro de trabajo en un archivo
        XLSX.writeFile(wb, `${filename}.xlsx`);
        }
    </script>
@endsection  {{-- Fin de la sección de contenido --}}

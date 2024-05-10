@extends('layouts.app')  {{-- Utiliza una plantilla base --}}

@section('content')  {{-- Sección de contenido --}}

    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h1>Entrada</h1>
                <div class="card">
                    <div class="card-header">
                        <h4>{{ $entrada->titulo }}</h4>
                    </div>
                    <div class="card-body">
                        <img src="{{ asset('storage/entradas').'/'.$entrada->imagen }}" alt="" width="400" class="mb-2">
                        <p><strong>Descripción:</strong> {{ $entrada->descripcion }}</p>
                        <p><strong>Categoría:</strong> {{ $entrada->categoria->nombre_categoria }}</p>
                        <p><strong>Usuario:</strong> {{ $entrada->usuario->nick }}</p>
                        <p><strong>Fecha de Creación:</strong> {{ $entrada->created_at }}</p>
                        <p><strong>Fecha de Actualización:</strong> {{ $entrada->updated_at }}</p>
                    </div>
                    <div class="card-footer">
                        <a href="{{ route('entradas.index') }}" class="btn btn-primary">Volver</a>
                        <button class="btn btn-primary" onclick="exportToPDF()">Exportar a PDF</button>

                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/1.5.3/jspdf.debug.js"></script>

    <script>
        function exportToPDF() {
            var doc = new jsPDF();
            doc.setFontSize(10);
            doc.text(20, 20, 'Entrada');
            doc.text(20, 30, 'Título: {{ $entrada->titulo }}');
            var descripcion = '{{ $entrada->descripcion }}';
            var lines = doc.splitTextToSize(descripcion, 170);
            doc.text(20, 40, lines);
            doc.text(20, 50, 'Categoría: {{ $entrada->categoria->nombre_categoria }}');
            doc.text(20, 60, 'Usuario: {{ $entrada->usuario->nick }}');
            doc.text(20, 70, 'Fecha de Creación: {{ $entrada->created_at }}');
            doc.text(20, 80, 'Fecha de Actualización: {{ $entrada->updated_at }}');
            // Procesar imagen
            var img = new Image();
            img.src = '{{ asset('storage/entradas').'/'.$entrada->imagen }}';
            doc.addImage(img, 'PNG', 20, 90, 100, 100);
            doc.save('entrada.pdf');
        }
    </script>



@endsection  {{-- Fin de la sección de contenido --}}

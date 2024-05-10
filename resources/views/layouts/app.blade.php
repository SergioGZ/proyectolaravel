<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mi Aplicación Laravel</title>
    <!-- Agrega enlaces a CSS, Bootstrap u otros recursos aquí -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <!-- Agrega scripts aquí -->
    @yield('scripts')
</head>
<body>

    <nav class="navbar navbar-expand-lg navbar-light bg-light border-bottom border-3 border-dark">
        <a class="navbar-brand ms-3" href="{{ route('home') }}"><strong>Bienvenido, {{ Auth::user()->nick }}</strong></a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav mr-auto">
                <li class="nav-item active">
                    <a class="nav-link" href="{{ route('usuarios.index') }}"><strong>Usuarios</strong></a>
                </li>
                <li class="nav-item active">
                    <a class="nav-link" href="{{ route('entradas.index') }}"><strong>Entradas</strong></a>
                </li>
                <li class="nav-item active">
                    <form action="{{ route('logout') }}" method="POST">
                        @csrf
                        <a class="nav-link text-danger" href="#" onclick="this.closest('form').submit()"><strong>Cerrar Sesión</strong></a>
                    </form>
                </li>
                <!-- Agrega más elementos de menú según sea necesario -->
            </ul>
        </div>
    </nav>

    <div class="container mt-4">
        @yield('content') <!-- Sección de contenido dinámico -->
    </div>

    <!-- Agrega scripts al final del cuerpo según sea necesario -->
    <script src="{{ asset('js/app.js') }}"></script>
</body>
</html>

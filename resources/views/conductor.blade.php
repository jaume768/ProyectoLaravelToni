<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Panel del Conductor</title>
    <link rel="stylesheet" href="{{ asset('css/conductor.css') }}">
</head>
<body>
<div class="container">
    <h1>Panel del Conductor</h1>
    <nav>
        <ul>
            <li><a href="{{ route('conductor.index', ['section' => 'calendario']) }}" class="{{ request()->get('section') == 'calendario' ? 'active' : '' }}">Calendario de Trayectos</a></li>
            <li><a href="{{ route('conductor.index', ['section' => 'datos']) }}" class="{{ request()->get('section') == 'datos' ? 'active' : '' }}">Mis Datos Personales</a></li>
        </ul>
    </nav>

    @if (request()->get('section') == 'datos')
        @include('plantillas.datos')
    @else
        @include('plantillas.calendario')
    @endif
</div>
</body>
</html>

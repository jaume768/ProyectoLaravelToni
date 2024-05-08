<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Panel de Administración</title>
    <link rel="stylesheet" href="{{ asset('css/admin.css') }}">
</head>
<body>
<div class="container">
    <h1>Panel de Administración</h1>

    <nav>
        <ul>
            <li><a href="{{ route('admin.index', ['section' => 'reserva']) }}" class="{{ request()->get('section') == 'reserva' ? 'active' : '' }}">Crear Reserva</a></li>
            <li><a href="{{ route('admin.index', ['section' => 'datos']) }}" class="{{ request()->get('section') == 'datos' ? 'active' : '' }}">Mis Datos</a></li>
            <li><a href="{{ route('admin.index', ['section' => 'ver_reservas']) }}" class="{{ request()->get('section') == 'ver_reservas' ? 'active' : '' }}">Ver Reservas</a></li>
        </ul>
    </nav>

    @switch(request()->get('section'))
        @case('reserva')
            @include('admin.plantillas.reserva_admin')
            @break

        @case('datos')
            @include('admin.plantillas.datos')
            @break

        @case('ver_reservas')
            @include('admin.plantillas.reservas_particulares')
            @break

        @default
            @include('admin.plantillas.reserva_admin')
    @endswitch
</div>
</body>
</html>

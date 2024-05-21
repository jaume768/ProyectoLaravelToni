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
            <li><a href="{{ route('admin', ['section' => 'reserva']) }}" class="{{ request()->get('section') == 'reserva' ? 'active' : '' }}">Crear Reserva</a></li>
            <li><a href="{{ route('admin', ['section' => 'datos']) }}" class="{{ request()->get('section') == 'datos' ? 'active' : '' }}">Mis Datos</a></li>
            <li><a href="{{ route('admin', ['section' => 'ver_reservas']) }}" class="{{ request()->get('section') == 'ver_reservas' ? 'active' : '' }}">Ver Reservas</a></li>
            <li><a href="{{ route('admin', ['section' => 'precios']) }}" class="{{ request()->get('section') == 'precios' ? 'active' : '' }}">Gestionar Precios</a></li>
            <li><a href="{{ route('admin', ['section' => 'comisiones']) }}" class="{{ request()->get('section') == 'comisiones' ? 'active' : '' }}">Ver Comisiones</a></li>
        </ul>
    </nav>

    @switch(request()->get('section'))
        @case('reserva')
            @include('plantillas.reserva_admin')
            @break

        @case('datos')
            @include('plantillas.datos')
            @break

        @case('ver_reservas')
            @include('plantillas.reservas_particulares')
            @break

        @case('precios')
            @include('plantillas.gestion_precios')
            @break

        @case('comisiones')
            @include('plantillas.ver_comisiones')
            @break

        @default
            @include('plantillas.reserva_admin')
    @endswitch
</div>
</body>
</html>

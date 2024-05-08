
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Panel del Usuario</title>
    <link rel="stylesheet" href="{{ asset('css/particular.css') }}">
</head>
<body>
<div class="container">
    <h1>Panel de Usuario Particular</h1>

    <nav>
        <ul>
            <li><a href="{{ route('particular', ['section' => '']) }}" class="{{ request()->is('particular') && !request()->query('section') ? 'active' : '' }}">Mis Reservas</a></li>
            <li><a href="{{ route('particular', ['section' => 'reserva']) }}" class="{{ request()->is('particular') && request()->query('section') === 'reserva' ? 'active' : '' }}">Realizar una Reserva</a></li>
            <li><a href="{{ route('particular', ['section' => 'datos']) }}" class="{{ request()->is('particular') && request()->query('section') === 'datos' ? 'active' : '' }}">Mis Datos Personales</a></li>
        </ul>
    </nav>
    
    

    @if (session('section') == 'reserva')
        @include('plantillas.reserva')
    @elseif (session('section') == 'datos')
        @include('plantillas.datos')
    @else
        @include('plantillas.reservas')
    @endif
</div>

<script src="{{ asset('js/functions.js') }}"></script>
</body>
</html>

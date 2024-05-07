<!DOCTYPE html>
<html>
<head>
    <title>Registro Viajero</title>
    <link rel="stylesheet" href="{{ asset('css/registro.css') }}">
</head>
<body>
<div class="container">
    <h2>REGISTRO</h2>
    <form action="{{ route('registro.post') }}" method="post">
        @csrf <!-- Token CSRF para proteger tu formulario -->
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        @if (session('error'))
            <p class="error">{{ session('error') }}</p>
        @endif

        <label for="nombre">Nombre:</label>
        <input type="text" name="nombre" id="nombre" placeholder="Nombre" maxlength="100" required value="{{ old('nombre') }}">
        <br>

        <label for="apellido1">Primer Apellido:</label>
        <input type="text" name="apellido1" id="apellido1" placeholder="Primer Apellido" maxlength="100" required value="{{ old('apellido1') }}">
        <br>

        <label for="apellido2">Segundo Apellido:</label>
        <input type="text" name="apellido2" id="apellido2" placeholder="Segundo Apellido" maxlength="100" required value="{{ old('apellido2') }}">
        <br>

        <label for="direccion">Dirección:</label>
        <input type="text" name="direccion" id="direccion" placeholder="Dirección" maxlength="100" required value="{{ old('direccion') }}">
        <br>

        <label for="codigoPostal">Código Postal:</label>
        <input type="text" name="codigoPostal" id="codigoPostal" placeholder="Código Postal" minlength="5" maxlength="5" required value="{{ old('codigoPostal') }}">
        <br>

        <label for="ciudad">Ciudad:</label>
        <input type="text" name="ciudad" id="ciudad" placeholder="Ciudad" maxlength="100" required value="{{ old('ciudad') }}">
        <br>

        <label for="pais">País:</label>
        <input type="text" name="pais" id="pais" placeholder="País" maxlength="100" required value="{{ old('pais') }}">
        <br>

        <label for="email">Email:</label>
        <input type="email" name="email" id="email" placeholder="Correo Electrónico" maxlength="100" required value="{{ old('email') }}">
        <br>

        <label for="password">Contraseña:</label>
        <input type="password" name="password" id="password" placeholder="Contraseña" maxlength="100" required>
        <br>

        <button type="submit" value="Register">Aceptar</button>
        <br>
    </form>
    <a class="login-link" href="{{ route('login') }}">¿Ya tienes cuenta? Haz login</a>
</div>
</body>
</html>

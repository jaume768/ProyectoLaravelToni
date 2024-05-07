<!DOCTYPE html>
<html>
<head>
    <title>Login</title>
    <link rel="stylesheet" href="{{ asset('css/login.css') }}">
</head>
<body>
    <div class="container">
        <h2>LOGIN</h2>
        <form action="{{ route('login') }}" method="post">
            @csrf
            @if(session('msg'))
                <p class="msg">{{ session('msg') }}</p>
            @endif
            <br>
            <label for="email">Usuario o Email: </label>
            <input type="text" name="email" placeholder="Usuario o Correo Electrónico" maxlength="100" required value="{{ old('email') }}"><br><br>
            <label for="password">Contraseña: </label>
            <input type="password" name="password" placeholder="Contraseña" maxlength="100" required><br><br>
            <button type="submit" value="Login">Iniciar Sesión</button><br><br>
            <a href="{{ url('registro') }}">Registrarse</a>
        </form>
    </div>
</body>
</html>

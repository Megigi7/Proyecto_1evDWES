<!DOCTYPE html>
<html>
<head>
    <title>Login</title>
    <link rel="stylesheet" type="text/css" href="../resources/css/login.css">
</head>
<body>
    <div class="login-container">
        <form action="/mi-proyecto-laravel/public/login" method="POST">
            @csrf
            <h2>Iniciar Sesión</h2>
            <input type="text" name="nombre" placeholder="Nombre" value="{{ isset($old_nombre) ? $old_nombre : '' }}">
            <input type="password" name="contraseña" placeholder="Contraseña">
            <button type="submit">Iniciar sesión</button>
        </form>

        @if (isset($error))
            <p class="error">{{ $error }}</p>
        @endif
    </div>
</body>
</html>

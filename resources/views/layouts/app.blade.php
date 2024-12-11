
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link  rel="stylesheet" type="text/css" href=" ../resources/css/layout.css">
    <title>Gestor de Datos</title>
</head>
<body>
    <div class="header">
        <h2>Proyecto PHP</h2>

    </div>
    <div class="menu">
        <!-- Sesiones ↓ -->
        <a href="/mi-proyecto-laravel/public/opciones">Inicio</a> 
        <a href="/mi-proyecto-laravel/public/mostrar_tareas">Ver Tareas</a>
        <a href="/mi-proyecto-laravel/public/nueva_tarea">Añadir Tarea</a>
    </div>
    <div class="container">
        @yield('content')
    </div>
    <div class="footer">
        <p>&copy; 2024 Proyecto PHP. Todos los derechos reservados.</p>
    </div>
</body>
</html>
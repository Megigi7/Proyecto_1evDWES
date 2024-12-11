session_start();

<!-- AL VOLVER ATRÁS A ESTA PÁGINA DA FALLO POR LA SESION -->

@extends('layouts.app')

@section('content')
    @if(!isset($_COOKIE['nombre']))
        <p>No tienes permisos para acceder a esta página</p>
    @else

    <!-- pondremos el nombre del usuario que recogimos con las cookies -->
    <p>Bienvenido, {{ $session->get_nombre() ?? 'Invitado'}} <br> 
    <a href="/mi-proyecto-laravel/public/logout">Cerrar sesión</a></p>
    
    <h1>Formulario de Modificaciones</h1>
    
        @if( $session->get_tipo() === 0)
            <!-- Tipo 0: Mostrar botones de admin -->
            <a href="/mi-proyecto-laravel/public/nueva_tarea"><button name="añadir_tarea">Añadir una nueva tarea</button></a>
        @endif
            <a href="/mi-proyecto-laravel/public/mostrar_tareas"><button name="ver_tareas">Ver lista de tareas</button></a>
    @endif




@endsection
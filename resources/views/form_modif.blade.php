@extends('layouts.app')

@section('content')
    <h1>Formulario de Modificaciones</h1>

    @if(isset($tipo))
        @if($tipo === 0)
            <!-- Tipo 0: Mostrar botones de admin -->
            <a href="/mi-proyecto-laravel/public/nueva_tarea"><button name="añadir_tarea">Añadir una nueva tarea</button></a>
        @endif
            <button name="ver_tareas">Ver lista de tareas</button>
            <button name="buscar_tarea">Buscar tarea</button>

    @else
        <!-- Caso sin autenticación -->
        <p>Por favor, inicie sesión para acceder a esta página.</p>
    @endif




@endsection
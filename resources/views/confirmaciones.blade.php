
@extends('layouts.app')

@section('content')
    @if(!isset($_COOKIE['nombre']))
        <p>No tienes permisos para acceder a esta página</p>
    @else
        @if (isset($mensaje))
                <p>{{ $mensaje }}</p>
        @endif
        <a href="/mi-proyecto-laravel/public/mostrar_tareas">Volver a la lista de tareas</a>
    @endif
@endsection
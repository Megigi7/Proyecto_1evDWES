
@extends('layouts.app')

@section('content')
    @if (isset($mensaje))
            <p>{{ $mensaje }}</p>
    @endif
    <a href="/mi-proyecto-laravel/public/mostrar_tareas">Volver a la lista de tareas</a>

@endsection
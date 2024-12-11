
@extends('layouts.app')

@section('content')
    @if(!isset($_COOKIE['nombre']))
        <p>No tienes permisos para acceder a esta página</p>
    @else
        <link rel="stylesheet" type="text/css" href=" ../resources/css/form_alta.css">
        <h2>Formulario de modificación de estado</h2>

        <form action="/mi-proyecto-laravel/public/cambiar_estado" method="post">
            @csrf
            <input type="hidden" name="id" value="{{ $_GET['id'] }}">

            <p>Estado</p>
            <select name="estado">
                <option value="Esperando a ser aprobado" {{ isset($tarea['estado']) && $tarea['estado'] == 'Esperando a ser aprobado' ? 'selected' : '' }}>Esperando a ser aprobado</option>
                <option value="Pendiente" {{ isset($tarea['estado']) && $tarea['estado'] == 'Pendiente' ? 'selected' : '' }}>Pendiente</option>
                <option value="Realizada" {{ isset($tarea['estado']) && $tarea['estado'] == 'Realizada' ? 'selected' : '' }}>Realizada</option>
                <option value="Cancelada" {{ isset($tarea['estado']) && $tarea['estado'] == 'Cancelada' ? 'selected' : '' }}>Cancelada</option>
            </select>

            <p>Anotaciones Anteriores</p>
            <textarea name="anotaciones_anteriores">{{ $tarea['anotaciones_anteriores'] ?? '' }}</textarea>
            
            <p>Anotaciones Posteriores</p>
            <textarea name="anotaciones_posteriores">{{ $tarea['anotaciones_posteriores'] ?? '' }}</textarea>
            
            <input type="submit" value="Guardar">
        </form>
    @endif
@endsection
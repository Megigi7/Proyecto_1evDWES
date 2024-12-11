
@extends('layouts.app')

@section('content')

    <link rel="stylesheet" type="text/css" href=" ../resources/css/form_alta.css">
    <h2>Formulario de modificación de estado</h2>

    <form action="/mi-proyecto-laravel/public/cambiar_estado" method="post">
        @csrf
        <input type="hidden" name="id" value="{{ $_GET['id'] }}">

        <p>Estado</p>
        <select name="estado">
            <option value="Esperando a ser aprobado" {{ isset($datos['new_estado']) && $datos['new_estado'] == 'Esperando a ser aprobado' ? 'selected' : '' }}>Esperando a ser aprobado</option>
            <option value="Pendiente" {{ isset($datos['new_estado']) && $datos['new_estado'] == 'Pendiente' ? 'selected' : '' }}>Pendiente</option>
            <option value="Realizada" {{ isset($datos['new_estado']) && $datos['new_estado'] == 'Realizada' ? 'selected' : '' }}>Realizada</option>
            <option value="Cancelada" {{ isset($datos['new_estado']) && $datos['new_estado'] == 'Cancelada' ? 'selected' : '' }}>Cancelada</option>
        </select>

        <p>Anotaciones Anteriores</p>
        <textarea name="anotaciones_anteriores">{{ $datos['new_anotaciones_anteriores'] ?? '' }}</textarea>
        
        <p>Anotaciones Posteriores</p>
        <textarea name="anotaciones_posteriores">{{ $datos['new_anotaciones_posteriores'] ?? '' }}</textarea>
        
        <input type="submit" value="Guardar">
    </form>
@endsection
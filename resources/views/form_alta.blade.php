
@extends('layouts.app')

@section('content')

    <link rel="stylesheet" type="text/css" href=" ../resources/css/form_alta.css">
    <?php
        $provincias = [
            'Álava', 'Albacete', 'Alicante', 'Almería', 'Asturias', 'Ávila', 'Badajoz', 'Baleares', 'Barcelona', 
            'Burgos', 'Cáceres', 'Cádiz', 'Cantabria', 'Castellón', 'Ciudad Real', 'Córdoba', 'Cuenca', 'Girona', 
            'Granada', 'Guadalajara', 'Guipúzcoa', 'Huelva', 'Huesca', 'Jaén', 'La Rioja', 'Las Palmas', 'León', 
            'Lleida', 'Lugo', 'Madrid', 'Málaga', 'Murcia', 'Navarra', 'Ourense', 'Palencia', 'Pontevedra', 'Salamanca', 
            'Segovia', 'Sevilla', 'Soria', 'Tarragona', 'Santa Cruz de Tenerife', 'Teruel', 'Toledo', 'Valencia', 
            'Valladolid', 'Vizcaya', 'Zamora', 'Zaragoza'
        ];
    ?>

    <h2>Formulario de Alta de Tarea</h2>

    @if (isset($mensaje))
        <p class="mensaje">{{ $mensaje }}</p>
    @endif

    <form action="/mi-proyecto-laravel/public/nueva_tarea" method="post">
        @csrf
        <p>CIF/NIF</p>
        <input type="text" name="cif_nif" value="{{ $old['new_cif_nif'] ?? '' }}">
        
        <p>Nombre Cliente</p>
        <input type="text" name="nombre_cliente" value="{{ $old['new_nombre_cliente'] ?? '' }}">
        
        <p>Teléfono</p>
        <input type="text" name="tel_s_contacto" value="{{ $old['new_tel_s_contacto'] ?? '' }}">
        
        <p>Descripción</p>
        <input type="text" name="descripcion" value="{{ $old['new_descripcion'] ?? '' }}">
        
        <p>Correo</p>
        <input type="email" name="correo" value="{{ $old['new_correo'] ?? '' }}">
        
        <p>Dirección</p>
        <input type="text" name="direccion" value="{{ $old['new_direccion'] ?? '' }}">
        
        <p>Población</p>
        <input type="text" name="poblacion" value="{{ $old['new_poblacion'] ?? '' }}">
        
        <p>Código Postal</p>
        <input type="text" name="codigo_postal" value="{{ $old['new_codigo_postal'] ?? '' }}">
        
        <p>Provincia</p>
        <select name="provincia">
            @foreach($provincias as $provincia)
                <option value="{{ $provincia }}" {{ isset($old['new_provincia']) && $old['new_provincia'] == $provincia ? 'selected' : '' }}>{{ $provincia }}</option>
            @endforeach
        </select>
        
        <p>Estado</p>
        <select name="estado">
            <option value="Esperando a ser aprobado" {{ isset($old['new_estado']) && $old['new_estado'] == 'Esperando a ser aprobado' ? 'selected' : '' }}>Esperando a ser aprobado</option>
            <option value="Pendiente" {{ isset($old['new_estado']) && $old['new_estado'] == 'Pendiente' ? 'selected' : '' }}>Pendiente</option>
            <option value="Realizada" {{ isset($old['new_estado']) && $old['new_estado'] == 'Realizada' ? 'selected' : '' }}>Realizada</option>
            <option value="Cancelada" {{ isset($old['new_estado']) && $old['new_estado'] == 'Cancelada' ? 'selected' : '' }}>Cancelada</option>
        </select>

        <p>Operario Encargado</p>
        <select name="operario">
            @for ($i = 1; $i <= 5; $i++)
                <option value="Encargado {{ $i }}" {{ isset($old['new_operario_encargado']) && $old['new_operario_encargado'] == "Encargado $i" ? 'selected' : '' }}>Encargado {{ $i }}</option>
            @endfor
        </select>

        <p>Fecha Realización</p>
        <input type="date" name="fecha_realizacion" value="{{ $old['new_fecha_realizacion'] ?? '' }}">
        
        <p>Anotaciones Anteriores</p>
        <textarea name="anotaciones_anteriores">{{ $old['new_anotaciones_anteriores'] ?? '' }}</textarea>
        
        <p>Anotaciones Posteriores</p>
        <textarea name="anotaciones_posteriores">{{ $old['new_anotaciones_posteriores'] ?? '' }}</textarea>
        
        <input type="submit" value="Guardar">
    </form>
@endsection

@extends('layouts.app')
    @if(!isset($_COOKIE['nombre']))
        <p>No tienes permisos para acceder a esta página</p>
    @else
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
                $id = isset($_GET['id']) ? $_GET['id'] : (isset($_POST['id']) ? $_POST['id'] : null);
            ?>


        @section('content')
            <div class="form-container">
            <h2>Modificar Tarea</h2>
            @if (isset($mensaje))
                <p class="mensaje">{{ $mensaje }}</p>
            @endif

                <form action="/mi-proyecto-laravel/public/modif_tarea_sel" method="POST">
                    @csrf
                    <input type="hidden" name="id" value="{{ $id }}">

                    <p>CIF/NIF</p>
                    <input type="text" name="cif_nif" value="{{ $datos['cif_nif'] }}">
                    
                    <p>Nombre Cliente</p>
                    <input type="text" name="nombre_cliente" value="{{ $datos['nombre_cliente'] }}">
                    
                    <p>Teléfono</p>
                    <input type="text" name="tel_s_contacto" value="{{ $datos['tel_s_contacto']  }}">
                    
                    <p>Descripción</p>
                    <input type="text" name="descripcion" value="{{ $datos['descripcion'] }}">
                    
                    <p>Correo</p>
                    <input type="email" name="correo" value="{{ $datos['correo'] }}">
                    
                    <p>Dirección</p>
                    <input type="text" name="direccion" value="{{ $datos['direccion'] }}">
                    
                    <p>Población</p>
                    <input type="text" name="poblacion" value="{{ $datos['poblacion'] }}">
                    
                    <p>Código Postal</p>
                    <input type="text" name="codigo_postal" value="{{ $datos['codigo_postal'] }}">
                    
                    <p>Provincia</p>
                    <select name="provincia">
                        @foreach($provincias as $provincia)
                            <option value="{{ $provincia }}" {{ $datos['provincia'] == $provincia ? 'selected' : '' }}>{{ $provincia }}</option>
                        @endforeach
                    </select>
                    
                    <p>Estado</p>
                    <select name="estado">
                        <option value="Esperando a ser aprobado" {{ $datos['estado'] == 'Esperando a ser aprobado' ? 'selected' : '' }}>Esperando a ser aprobado</option>
                        <option value="Pendiente" {{ $datos['estado'] == 'Pendiente' ? 'selected' : '' }}>Pendiente</option>
                        <option value="Realizada" {{ $datos['estado'] == 'Realizada' ? 'selected' : '' }}>Realizada</option>
                        <option value="Cancelada" {{ $datos['estado'] == 'Cancelada' ? 'selected' : '' }}>Cancelada</option>
                    </select>

                    <p>Operario Encargado</p>
                    <select name="operario">
                        @for ($i = 1; $i <= 5; $i++)
                            <option value="Encargado {{ $i }}" {{$datos['operario_encargado'] == "Encargado $i" ? 'selected' : '' }}>Encargado {{ $i }}</option>
                        @endfor
                    </select>

                    <p>Fecha Realización</p>
                    <input type="date" name="fecha_realizacion" value="{{ $datos['fecha_realizacion'] }}.value">
                    
                    <p>Anotaciones Anteriores</p>
                    <textarea name="anotaciones_anteriores">{{ $datos['anotaciones_anteriores'] }}</textarea>
                    
                    <p>Anotaciones Posteriores</p>
                    <textarea name="anotaciones_posteriores">{{ $datos['anotaciones_posteriores'] }}</textarea>

                    <p>Ficheros</p>
                    <input type="file" name="ficheros">

                    
                    <input type="submit" value="Guardar cambios">
                </form>
            </div>
    @endif
@endsection
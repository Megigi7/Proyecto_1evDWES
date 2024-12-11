session_start();

@extends('layouts.app')

@section('content')
    @if(!isset($_COOKIE['nombre']) || $_SESSION['tipo'] != 1)
        <p>No tienes permisos para acceder a esta página</p>
    @else
        <link rel="stylesheet" type="text/css" href="../resources/css/tareas.css">
        <h1>Listado de tareas</h1>
        @if (isset($mensaje))
            <p class="error">{{ $mensaje }}</p>
        @endif
        <form method="GET" action="/mi-proyecto-laravel/public/mostrar_tareas">
            <label>
                <input type="checkbox" name="filtro_estado" value="pendientes" <?php echo $filtro_estado == 'pendientes' ? 'checked' : ''; ?>> Mostrar solo tareas pendientes
            </label>
            <button type="submit">Filtrar</button>
        </form>
        
        <div id="lista_tareas">
            <table border='1'>
                <tr>
                    <th>CIF/NIF</th>
                    <th>Nombre Cliente</th>
                    <th>Teléfono</th>
                    <th>Descripción</th>
                    <th>Correo</th>
                    <th>Dirección</th>
                    <th>Población</th>
                    <th>Código Postal</th>
                    <th>Provincia</th>
                    <th>Estado</th>
                    <th>Fecha Creación</th>
                    <th>Operario Encargado</th>
                    <th>Fecha Realización</th>
                    <th>Anotaciones Anteriores</th>
                    <th>Anotaciones Posteriores</th>
                    <th>Ficheros</th>
                    <th>Acciones</th>
                </tr>
                @foreach($tareas as $tarea)
                <tr>
                    <td>{{ $tarea['cif_nif'] }}</td>
                    <td>{{ $tarea['nombre_cliente'] }}</td>
                    <td>{{ $tarea['tel_s_contacto'] }}</td>
                    <td>{{ $tarea['descripcion'] }}</td>
                    <td>{{ $tarea['correo'] }}</td>
                    <td>{{ $tarea['direccion'] }}</td>
                    <td>{{ $tarea['poblacion'] }}</td>
                    <td>{{ $tarea['codigo_postal'] }}</td>
                    <td>{{ $tarea['provincia'] }}</td>
                    <td>{{ $tarea['estado'] }}</td>
                    <td>{{ $tarea['fecha_creacion'] }}</td>
                    <td>{{ $tarea['operario_encargado'] }}</td>
                    <td>{{ $tarea['fecha_realizacion'] }}</td>
                    <td>{{ $tarea['anotaciones_anteriores'] }}</td>
                    <td>{{ $tarea['anotaciones_posteriores'] }}</td>
                    <td>{{ $tarea['ficheros'] }}</td>
                    <td>
                        <form action="/mi-proyecto-laravel/public/confirmar_borrar?id={{$tarea['id']}}&desc={{$tarea['descripcion']}}" method='get' style='display:inline;'>
                            @csrf
                            <input type='hidden' name='id' value="{{ $tarea['id'] }}">
                            <input type='hidden' name='desc' value="{{ $tarea['descripcion'] }}">
                            <input type='submit' value='Eliminar' class='eliminar'>
                        </form>
                        <form action="/mi-proyecto-laravel/public/modif_tarea_sel?id={{ $tarea['id'] }}" method='get' style='display:inline;'>
                            @csrf
                            <input type='hidden' name='id' value="{{ $tarea['id'] }}">
                            <input type='submit' value='Modificar' class='modificar'>
                        </form>
                        @if ($tarea['estado'] != 'Realizada')
                            <form action="/mi-proyecto-laravel/public/cambiar_estado?id={{ $tarea['id'] }}" method='get' style='display:inline;'>
                                @csrf
                                <input type='hidden' name='id' value="{{ $tarea['id'] }}">
                                <input type='submit' value='Cambiar estado' class='cambiar_estado'>
                            </form>
                        @endif
                    </td>
                </tr>
                @endforeach
            </table>
        </div>

        <div class="paginacion">
            @for ($i = 1; $i <= $totalPages; $i++)
                <a href="/mi-proyecto-laravel/public/mostrar_tareas?page={{$i}}&filtro_estado={{$filtro_estado}}" class="{{ $i == $currentPage ? 'active' : '' }}">{{ $i }}</a>
            @endfor
        </div>
    @endif
@endsection
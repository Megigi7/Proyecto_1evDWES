@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-12">
                <h1>Confirmar borrado</h1>
                @if (isset($_GET['desc']))
                    <p>¿Realmente quiere borrar la tarea con descripción: {{ $_GET['desc'] }}?</p>
                @endif
                <form action="/mi-proyecto-laravel/public/confirmar_borrar" method="post">
                    @csrf
                    @if (isset($_GET['id']))
                        <input type="hidden" name="id" value="{{ $_GET['id'] }}">
                    @endif
                    <button type="submit" class="btn btn-danger">Sí, borrar</button>
                    <a href="/mi-proyecto-laravel/public/mostrar_tareas" class="btn btn-secondary">Cancelar</a>
                </form>
            </div>
        </div>
    </div>
@endsection
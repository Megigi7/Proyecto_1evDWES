<?php

use Illuminate\Support\Facades\Route;

/**
 * @file web.php
 * @brief Define las rutas de la aplicación.
 *
 * @details Este archivo contiene todas las rutas de la aplicación, incluyendo
 *          las rutas para el login, mostrar tareas, confirmar borrado, alta de tareas,
 *          modificación de tareas y logout.
 */

// Ruta para la página de login
Route::get('/', function () {
    return view('login');
});
Route::view('/login', 'login')->name('login');
Route::post('/login', function () {
    $result = include '../app/Http/Controllers/LoginController.php';
    return $result == 1 || $result == 0 ? view('form_modif', ['tipo' => $result]) : view('login', ['error' => "Usuario no existente", 'old_nombre' => $result]);
});

// Ruta para la selección de opciones
Route::get('/opciones', function () {
    return view('form_modif');
});

// Ruta para mostrar la lista de tareas
Route::get('/mostrar_tareas', function () {
    $datos = include  '../app/Http/Controllers/mostrar_tareas.php';
    return view('tareas', ['tareas' => $datos['tareas'], 'totalPages' => $datos['totalPages'], 'currentPage' => $datos['currentPage'], 'filtro_estado' => $datos['filtro_estado']]);
})->name('mostrar_tareas');


// Ruta para el formulario de alta de una nueva tarea
Route::get('/nueva_tarea', function () {
    return view('form_alta');
});

Route::post('/nueva_tarea', function () {
    $result = include '../app/Http/Controllers/añadir_tareas.php';
    if ($result['success'] === true) {
        return view('form_alta', ['mensaje' => "Datos insertados correctamente"]);
    } else {
        return view('form_alta', [
            'mensaje' => "Ha ocurrido un error, compruebe sus datos",
            'old' => $result['data']
        ]);
    }
});


// Ruta para modificar una tarea seleccionada
Route::get('/modif_tarea_sel', function () {
    $datos  = include '../app/Http/Controllers/modificar_tarea_sel.php';
    return view('form_modif_sel', [ 'datos' => $datos]);
});

Route::post('/modif_tarea_sel',function(){
    $answer = include '../app/Http/Controllers/modificar_tarea_sel.php';
    return view('confirmaciones', ['mensaje' => $answer]);
});

// Ruta para confirmar el borrado de una tarea
Route::get('/confirmar_borrar', function () {
    return view('form_conf_borrado');
});

Route::post('/confirmar_borrar', function () {
    $conf_borrar = include '../app/Http/Controllers/borrar_tarea_sel.php';
    return view('confirmaciones', ['mensaje' => $conf_borrar]);
});


// Ruta para cambiar el estado de una tarea 
Route::get('/cambiar_estado', function () {
    $datos  = include '../app/Http/Controllers/cambiar_estado.php';
    return view('form_cambiar_estado', ['datos' => $datos]);
});

Route::post('/cambiar_estado', function () {
    $answer = include '../app/Http/Controllers/cambiar_estado.php';
    return view('confirmaciones', ['mensaje' => $answer]);
});

// Ruta para cerrar sesión
Route::get('/logout', function () {
    session_start();
    session_destroy();
    return view('login');
});
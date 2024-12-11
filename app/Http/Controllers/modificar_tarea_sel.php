<?php
/**
 * @file modificar_tarea_sel.php
 * @brief Este archivo se encarga de modificar una tarea seleccionada de la base de datos.
 *
 * @details Este script PHP maneja la solicitud POST para obtener los datos de una tarea específica
 *          de la base de datos utilizando su ID.
 */


require_once('../app/Models/conexion_db.php');
require('../app/Models/validaciones_datos.php'); 
require('../app/Models/consultas_sql.php');


if ($_SERVER['REQUEST_METHOD'] == 'GET') {
    $id = $_GET['id'];
    echo $id;
    $tarea = select_datos($id);
    return $tarea;
}

if ($_SERVER['REQUEST_METHOD'] == 'POST'){
    $id = $_POST['id'];
    $cif_nif = $_POST['cif_nif'];
    $nombre_cliente = $_POST['nombre_cliente'];
    $tel_s_contacto = $_POST['tel_s_contacto'];
    $descripcion = $_POST['descripcion'];
    $correo = $_POST['correo'];
    $direccion = $_POST['direccion'];
    $poblacion = $_POST['poblacion'];
    $codigo_postal = $_POST['codigo_postal'];
    $provincia = $_POST['provincia'];
    $estado = $_POST['estado'];
    $operario_encargado = $_POST['operario'];
    $fecha_realizacion = $_POST['fecha_realizacion'];
    $anotaciones_anteriores = isset($_POST['anotaciones_anteriores']) ? $_POST['anotaciones_anteriores'] : '';
    $anotaciones_posteriores = isset($_POST['anotaciones_posteriores']) ? $_POST['anotaciones_posteriores'] : '';

    $datos_tarea = [
        'cif_nif' => $cif_nif,
        'nombre_cliente' => $nombre_cliente,
        'tel_s_contacto' => $tel_s_contacto,
        'descripcion' => $descripcion,
        'correo' => $correo,
        'direccion' => $direccion,
        'poblacion' => $poblacion,
        'codigo_postal' => $codigo_postal,
        'provincia' => $provincia,
        'estado' => $estado,
        'operario_encargado' => $operario_encargado,
        'fecha_realizacion' => $fecha_realizacion,
        'anotaciones_anteriores' => $anotaciones_anteriores,
        'anotaciones_posteriores' => $anotaciones_posteriores
    ];

    if (empty($descripcion) || empty($operario_encargado) || !validDniCifNie($cif_nif) || !validarTelefono($tel_s_contacto) || !validarCodigoPostal($codigo_postal) || !filter_var($correo, FILTER_VALIDATE_EMAIL) || !validarFecha($fecha_realizacion)) {
        return [
            'success' => false,
            'data' => $datos_tarea
        ];
    }

    if (update_datos($id, $datos_tarea)) {
        return ['success' => true];
    } else {
        return [
            'success' => false,
            'data' => $datos_tarea
        ];
    }        
 
}



?>
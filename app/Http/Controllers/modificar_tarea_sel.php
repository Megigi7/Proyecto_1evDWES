<?php
/**
 * @file modificar_tarea_sel.php
 * @brief Este archivo se encarga de modificar una tarea seleccionada de la base de datos.
 *
 * @details Este script PHP maneja la solicitud POST para obtener los datos de una tarea específica
 *          de la base de datos utilizando su ID.
 */

require_once('../app/Models/conexion_db.php');
require_once('../app/Models/validaciondni.php'); 


function validarTelefono($telefono) {
   return preg_match('/^[0-9\s\-]+$/', $telefono);
}


function validarCodigoPostal($codigo_postal) {
   return preg_match('/^\d{5}$/', $codigo_postal);
}


function validarFecha($fecha) {
   $fecha_actual = date('Y-m-d');
   return ($fecha > $fecha_actual);
}









if ($_SERVER['REQUEST_METHOD'] == 'GET') {
    $id = $_GET['id'];
    try {
        $db = Database::getInstance();
        $mysqli = $db->getConnection();

        // Ejecutaremos una consulta SQL que obtenga la tarea seleccionada según su ID
        $stmt_Select = $mysqli->prepare("SELECT * FROM tarea WHERE id = ?");
        $stmt_Select->bind_param('i', $id);
        $stmt_Select->execute();
        
        // Guardar el resultado de la consulta en una variable
        $result = $stmt_Select->get_result();
        $tarea = $result->fetch_assoc();
        
        return $tarea;
        
    } catch (Exception $e) {
        return "Error: " . $e->getMessage();
    }
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
    $operario_encargado   = $_POST['operario'];
    $fecha_realizacion = $_POST['fecha_realizacion'];
    $anotaciones_anteriores = isset($_POST['anotaciones_anteriores']) ? $_POST['anotaciones_anteriores'] : '';
    $anotaciones_posteriores = isset($_POST['anotaciones_posteriores']) ? $_POST['anotaciones_posteriores'] : '';


    if (empty($descripcion) || empty($operario_encargado) || !validDniCifNie($cif_nif) || !validarTelefono($tel_s_contacto) || !validarCodigoPostal($codigo_postal) || !filter_var($correo, FILTER_VALIDATE_EMAIL) || !validarFecha($fecha_realizacion)) {
        return [
            'success' => false,
            'data' => [
                'id' => $id,
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
            ]
        ];
    }


    try {
        $db = Database::getInstance();
        $mysqli = $db->getConnection();
        
        // Ejecutaremos una consulta SQL que actualice los datos de la tarea seleccionada
        $stmt_Update = $mysqli->prepare("UPDATE tarea SET cif_nif = '?', nombre_cliente = '?', tel_s_contacto = '?', descripcion = '?', correo = '?', direccion = '?', poblacion = '?', codigo_postal = '?', provincia = '?', estado = '?', operario_encargado = '?', fecha_realizacion = '?', anotaciones_anteriores = '?', anotaciones_posteriores = '?' WHERE id = ?");
        $stmt_Update->bind_param('ssssssssssssssi', $cif_nif, $nombre_cliente, $tel_s_contacto, $descripcion, $correo, $direccion, $poblacion, $codigo_postal, $provincia, $estado, $operario_encargado, $fecha_realizacion, $anotaciones_anteriores, $anotaciones_posteriores, $id);
        $stmt_Update->execute();
        
    if ($stmt_Insert->execute()) {
        return ['success' => true];
    } else {
        return [
            'success' => true,
            'data' => [
                'id' => $id,
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
            ]
        ];
    }        
    } catch (Exception $e) {
        return "Error: " . $e->getMessage();
    }
}



?>
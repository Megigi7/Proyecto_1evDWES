<?php
/**
 * @file modificar_tarea_sel.php
 * @brief Este archivo se encarga de modificar una tarea seleccionada de la base de datos.
 *
 * @details Este script PHP maneja la solicitud POST para obtener los datos de una tarea específica
 *          de la base de datos utilizando su ID.
 */

require_once('../app/Models/conexion_db.php');

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
    $new_cif_nif = $_POST['cif_nif'];
    $new_nombre_cliente = $_POST['nombre_cliente'];
    $new_tel_s_contacto = $_POST['tel_s_contacto'];
    $new_descripcion = $_POST['descripcion'];
    $new_correo = $_POST['correo'];
    $new_direccion = $_POST['direccion'];
    $new_poblacion = $_POST['poblacion'];
    $new_codigo_postal = $_POST['codigo_postal'];
    $new_provincia = $_POST['provincia'];
    $new_estado = $_POST['estado'];
    $new_operario   = $_POST['operario'];
    $new_fecha_realizacion = $_POST['fecha_realizacion'];
    $new_anotaciones_anteriores = isset($_POST['anotaciones_anteriores']) ? $_POST['anotaciones_anteriores'] : '';
    $new_anotaciones_posteriores = isset($_POST['anotaciones_posteriores']) ? $_POST['anotaciones_posteriores'] : '';

    try {
        $db = Database::getInstance();
        $mysqli = $db->getConnection();
        
        // Ejecutaremos una consulta SQL que actualice los datos de la tarea seleccionada
        $stmt_Update = $mysqli->prepare("UPDATE tarea SET cif_nif = ?, nombre_cliente = ?, tel_s_contacto = ?, descripcion = ?, correo = ?, direccion = ?, poblacion = ?, codigo_postal = ?, provincia = ?, estado = ?, operario_encargado = ?, fecha_realizacion = ?, anotaciones_anteriores = ?, anotaciones_posteriores = ? WHERE id = ?");
        $stmt_Update->bind_param('ssssssssssssssi', $new_cif_nif, $new_nombre_cliente, $new_tel_s_contacto, $new_descripcion, $new_correo, $new_direccion, $new_poblacion, $new_codigo_postal, $new_provincia, $new_estado, $new_operario, $new_fecha_realizacion, $new_anotaciones_anteriores, $new_anotaciones_posteriores, $id);
        $stmt_Update->execute();
        
        return "Datos actualizados correctamente";
        
    } catch (Exception $e) {
        return "Error: " . $e->getMessage();
    }
}



?>
<?php
/**
 * @file borrar_tarea_sel.php
 * @brief Este archivo se encarga de borrar una tarea seleccionada de la base de datos.
 *
 * @details Este script PHP maneja la solicitud POST para eliminar una tarea específica
 *          de la base de datos utilizando su ID.
 */

require_once('../app/Models/conexion_db.php');
require_once('../app/Models/consultas_sql.php');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id = $_POST['id'];

    if(borrar_tarea($id)) {
        return "Tarea eliminada correctamente";
    } else {
        return "Error al eliminar la tarea";
    }

}
?>
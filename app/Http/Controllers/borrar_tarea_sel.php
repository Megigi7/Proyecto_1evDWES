<?php
/**
 * @file borrar_tarea_sel.php
 * @brief Este archivo se encarga de borrar una tarea seleccionada de la base de datos.
 *
 * @details Este script PHP maneja la solicitud POST para eliminar una tarea específica
 *          de la base de datos utilizando su ID.
 */

require_once('../app/Models/conexion_db.php');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id = $_POST['id'];

    try {
        $db = Database::getInstance();
        $mysqli = $db->getConnection();

        // Ejecutaremos una consulta SQL que borre la tarea seleccionada según su ID
        $stmt_Delete = $mysqli->prepare("DELETE FROM tarea WHERE id = ?");
        $stmt_Delete->bind_param('i', $id);
        $stmt_Delete->execute();
        return "Tarea eliminada correctamente";
    } catch (Exception $e) {
        return "Error: " . $e->getMessage();
    }
}
?>
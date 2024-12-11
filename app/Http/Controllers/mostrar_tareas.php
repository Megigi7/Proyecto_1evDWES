<?php
/**
 * @file mostrar_tareas.php
 * @brief Este archivo se encarga de mostrar las tareas desde la base de datos con paginación y filtrado.
 *
 * @details Este script PHP maneja la conexión a la base de datos, la paginación y el filtrado
 *          de las tareas para mostrarlas en una vista.
 */

require_once('../app/Models/conexion_db.php');
require('../app/Models/consultas_sql.php');

try {
    $db = Database::getInstance();
    $mysqli = $db->getConnection();

    
    // Paginación
    $filtro_estado = isset($_GET['filtro_estado']) ? $_GET['filtro_estado'] : '';
    $limit = 3; // Número de registros por página
    $page = isset($_GET['page']) ? $_GET['page'] : 1;
    $offset = (intval($page) - 1) * $limit;

    $datos =  show_tabla($filtro_estado, $limit, $offset);
    $datos['currentPage'] = $page;
    $datos['filtro_estado'] = $filtro_estado;
    return $datos;

} catch (Exception $e) {
    return "Error: " . $e->getMessage();
}
?>
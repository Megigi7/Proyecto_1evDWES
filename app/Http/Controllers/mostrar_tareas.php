<?php
/**
 * @file mostrar_tareas.php
 * @brief Este archivo se encarga de mostrar las tareas desde la base de datos con paginación y filtrado.
 *
 * @details Este script PHP maneja la conexión a la base de datos, la paginación y el filtrado
 *          de las tareas para mostrarlas en una vista.
 */

require_once('../app/Models/conexion_db.php');

try {
    $db = Database::getInstance();
    $mysqli = $db->getConnection();

    // Paginación
    $limit = 3; // Número de registros por página
    $page = isset($_GET['page']) ? $_GET['page'] : 1;
    $offset = (intval($page) - 1) * $limit;

    // Filtrado
    $filtro_estado = isset($_GET['filtro_estado']) ? $_GET['filtro_estado'] : '';

    // Consulta para obtener el total de registros
    if ($filtro_estado === 'pendientes') {
        $resultTotal = $mysqli->query("SELECT COUNT(*) AS total FROM tarea WHERE estado NOT IN ('Realizada', 'Cancelada')");
    } else {
        $resultTotal = $mysqli->query("SELECT COUNT(*) AS total FROM tarea");
    }
    $totalRows = $resultTotal->fetch_assoc()['total'];
    $totalPages = ceil($totalRows / $limit);

    // Consulta para obtener los datos con los limites
    if ($filtro_estado === 'pendientes') {
        $stmt_Select = $mysqli->prepare("SELECT id, cif_nif, nombre_cliente, tel_s_contacto, descripcion, correo, direccion, poblacion, codigo_postal, provincia, estado, fecha_creacion, operario_encargado, fecha_realizacion, anotaciones_anteriores, anotaciones_posteriores, ficheros FROM tarea WHERE estado NOT IN ('Realizada', 'Cancelada') LIMIT ? OFFSET ?");
    } else {
        $stmt_Select = $mysqli->prepare("SELECT id, cif_nif, nombre_cliente, tel_s_contacto, descripcion, correo, direccion, poblacion, codigo_postal, provincia, estado, fecha_creacion, operario_encargado, fecha_realizacion, anotaciones_anteriores, anotaciones_posteriores, ficheros FROM tarea LIMIT ? OFFSET ?");
    }
    $stmt_Select->bind_param('ii', $limit, $offset);
    $stmt_Select->execute();
    $result = $stmt_Select->get_result();

    $tareas = [];
    while ($row = $result->fetch_assoc()) {
        $tareas[] = $row;
    }

    return $datos = [
        'tareas' => $tareas,
        'totalPages' => $totalPages,
        'currentPage' => $page,
        'filtro_estado' => $filtro_estado
    ];

} catch (Exception $e) {
    return "Error: " . $e->getMessage();
}
?>
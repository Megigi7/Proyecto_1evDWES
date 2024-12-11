<?php
    require_once '../app/Models/conexion_db.php';

// Mostrar tabla de tareas con paginación y filtrado ---------------------------------------------------
function show_tabla($filtro_estado, $limit, $offset) {
    $db = Database::getInstance();
    $mysqli = $db->getConnection();

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

    $datos = [
        'tareas' => $tareas,
        'totalPages' => $totalPages,
    ];

    return $datos;
}




// Insertar una nueva tarea en la base de datos ---------------------------------------------------
function insertar_nueva_tarea($datos_tarea) {
    $db = Database::getInstance();
    $mysqli = $db->getConnection();
    
    $stmt_Insert = $mysqli->prepare("INSERT INTO tarea (cif_nif, nombre_cliente, tel_s_contacto, descripcion, correo, direccion, poblacion, codigo_postal, provincia, estado, operario_encargado, fecha_realizacion, anotaciones_anteriores, anotaciones_posteriores) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
    $stmt_Insert->bind_param('ssssssssssssss', $datos_tarea['new_cif_nif'], $datos_tarea['new_nombre_cliente'], $datos_tarea['new_tel_s_contacto'], $datos_tarea['new_descripcion'], $datos_tarea['new_correo'], $datos_tarea['new_direccion'], $datos_tarea['new_poblacion'], $datos_tarea['new_codigo_postal'], $datos_tarea['new_provincia'], $datos_tarea['new_estado'], $datos_tarea['new_operario_encargado'], $datos_tarea['new_fecha_realizacion'], $datos_tarea['new_anotaciones_anteriores'], $datos_tarea['new_anotaciones_posteriores']);
    
    if ($stmt_Insert->execute()) {
        return true;
    } else {
        return false;
    }
};


// Seleccionar datos de la tarea según su ID ---------------------------------------------------
    // Todos los datos
function select_datos($id){
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

    // Datos para cambiar estado 
function select_datos_estado($id){
    try {
        $db = Database::getInstance();
        $mysqli = $db->getConnection();

        // Ejecutaremos una consulta SQL que obtenga la tarea seleccionada según su ID
        $stmt_Select = $mysqli->prepare("SELECT estado, anotaciones_anteriores, anotaciones_posteriores, ficheros FROM tarea WHERE id = ?");
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




// Update de la tarea según su ID ---------------------------------------------------
    //Todos los datos
function update_datos($id, $datos){
    try {
        $db = Database::getInstance();
        $mysqli = $db->getConnection();
        
        // Ejecutaremos una consulta SQL que actualice los datos de la tarea seleccionada
        $stmt_Update = $mysqli->prepare("UPDATE tarea SET cif_nif = ?, nombre_cliente = ?, tel_s_contacto = ?, descripcion = ?, correo = ?, direccion = ?, poblacion = ?, codigo_postal = ?, provincia = ?, estado = ?, operario_encargado = ?, fecha_realizacion = ?, anotaciones_anteriores = ?, anotaciones_posteriores = ? WHERE id = ?");
        $stmt_Update->bind_param('ssssssssssssssi', $datos['cif_nif'], $datos['nombre_cliente'], $datos['tel_s_contacto'], $datos['descripcion'], $datos['correo'], $datos['direccion'], $datos['poblacion'], $datos['codigo_postal'], $datos['provincia'], $datos['estado'], $datos['operario_encargado'], $datos['fecha_realizacion'], $datos['anotaciones_anteriores'], $datos['anotaciones_posteriores'], $id);
        $stmt_Update->execute();
        return true;
    } catch (Exception $e) {
        return "Error: " . $e->getMessage();
    }
}

    // Cambiar estado
function update_datos_estado($id, $datos){
    try {
        $db = Database::getInstance();
        $mysqli = $db->getConnection();

        $stmt_Update = $mysqli->prepare("UPDATE tarea SET estado = ?, anotaciones_anteriores = ?, anotaciones_posteriores = ? WHERE id = ?");
        $stmt_Update->bind_param('sssi', $datos['new_estado'], $datos['new_anotaciones_anteriores'], $datos['new_anotaciones_posteriores'], $id);
        $stmt_Update->execute();
    } catch (Exception $e) {
        return "Error: " . $e->getMessage();
    }
}

    

// Delete de la tarea según su ID ---------------------------------------------------
function borrar_tarea($id) {
    try {
        $db = Database::getInstance();
        $mysqli = $db->getConnection();

        // Ejecutaremos una consulta SQL que borre la tarea seleccionada según su ID
        $stmt_Delete = $mysqli->prepare("DELETE FROM tarea WHERE id = ?");
        $stmt_Delete->bind_param('i', $id);
        $stmt_Delete->execute();
        return true;
    } catch (Exception $e) {
        return false;
    }
};

<?php
// Obtener la conexión a la base de datos
require_once '../app/Models/conexion_db.php';
require '../app/Models/consultas_sql.php';
 
if ($_SERVER['REQUEST_METHOD'] == 'GET') {
    $id = $_GET['id'];
    $tarea = select_datos_estado($id);
    return $tarea;
}



if ($_SERVER['REQUEST_METHOD'] == 'POST'){
    $new_estado = $_POST['estado'];
    $new_anotaciones_anteriores = isset($_POST['anotaciones_anteriores']) ? $_POST['anotaciones_anteriores'] : '';    
    $new_anotaciones_posteriores = isset($_POST['anotaciones_posteriores']) ? $_POST['anotaciones_posteriores'] : '';    
    $datos = [
        'new_estado' => $new_estado,
        'new_anotaciones_anteriores' => $new_anotaciones_anteriores,
        'new_anotaciones_posteriores' => $new_anotaciones_posteriores,
    ];

    $id = $_POST['id'];
    update_datos_estado($id, $datos);
}
<?php
// Obtener la conexión a la base de datos
    $db = require_once '../app/Models/conexion_db.php';
    $mysqli = $db->getConnection();

    $stmt = $mysqli->prepare("UPDATE tarea SET estado = ?,  WHERE id = ?");
    $stmt->bind_param("sssi", $new_estado, $new_anotaciones_anteriores, $new_anotaciones_posteriores, $id);
    
    if ($_SERVER['REQUEST_METHOD'] == 'GET') {
        $stmt_Select = $mysqli->prepare("SELECT * FROM tarea WHERE id = ?");

        
        $new_estado = $_GET['estado'];
        $new_anotaciones_anteriores = isset($_GET['anotaciones_anteriores']) ? $_GET['anotaciones_anteriores'] : '';
        $new_anotaciones_posteriores = isset($_GET['anotaciones_posteriores']) ? $_GET['anotaciones_posteriores'] : '';
        $datos = [$new_estado, $new_anotaciones_anteriores, $new_anotaciones_posteriores];
        return $datos;
    }



    if ($_SERVER['REQUEST_METHOD'] == 'POST'){
        $id = $_POST['id'];
        $new_estado = $_POST['estado'];
        $new_anotaciones_anteriores = isset($_POST['anotaciones_anteriores']) ? $_POST['anotaciones_anteriores'] : '';
        $new_anotaciones_posteriores = isset($_POST['anotaciones_posteriores']) ? $_POST['anotaciones_posteriores'] : '';    
        $stmt->execute();
        $stmt->close();

    }
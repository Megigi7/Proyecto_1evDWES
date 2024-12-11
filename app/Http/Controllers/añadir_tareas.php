<?php
/**
 * @file añadir_tareas.php
 * @brief Este archivo se encarga de añadir nuevas tareas a la base de datos.
 *
 * @details Este script PHP incluye la conexión a la base de datos y maneja la lógica
 *          necesaria para insertar nuevas tareas en la tabla correspondiente.
 */

 require_once('../app/Models/conexion_db.php');
 require_once('../app/Models/validaciondni.php'); // Incluir el archivo de validación del DNI
 
 /**
  * @brief Valida el formato del número de teléfono.
  * 
  * @param string $telefono El número de teléfono a validar.
  * @return bool true si el teléfono es válido, false en caso contrario.
  */
 function validarTelefono($telefono) {
     return preg_match('/^[0-9\s\-]+$/', $telefono);
 }
 
 /**
  * @brief Valida el formato del código postal.
  * 
  * @param string $codigo_postal El código postal a validar.
  * @return bool true si el código postal es válido, false en caso contrario.
  */
 function validarCodigoPostal($codigo_postal) {
     return preg_match('/^\d{5}$/', $codigo_postal);
 }
 
 /**
  * @brief Valida que la fecha proporcionada sea posterior a la fecha actual.
  * 
  * @param string $fecha La fecha a validar en formato 'Y-m-d'.
  * @return bool true si la fecha es válida, false en caso contrario.
  */
 function validarFecha($fecha) {
     $fecha_actual = date('Y-m-d');
     return ($fecha > $fecha_actual);
 }
 
 /**
  * @brief Maneja la solicitud POST para añadir una nueva tarea.
  * 
  * @details Este bloque de código se ejecuta cuando se envía un formulario
  *          con los datos de la nueva tarea. Valida los datos y los inserta
  *          en la base de datos.
  */

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
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
    $new_operario_encargado = $_POST['operario'];
    $new_fecha_realizacion = $_POST['fecha_realizacion'];
    $new_anotaciones_anteriores = isset($_POST['anotaciones_anteriores']) ? $_POST['anotaciones_anteriores'] : '';
    $new_anotaciones_posteriores = isset($_POST['anotaciones_posteriores']) ? $_POST['anotaciones_posteriores'] : '';    

    // Validaciones
    if (empty($new_descripcion) || empty($new_operario_encargado) || !validDniCifNie($new_cif_nif) || !validarTelefono($new_tel_s_contacto) || !validarCodigoPostal($new_codigo_postal) || !filter_var($new_correo, FILTER_VALIDATE_EMAIL) || !validarFecha($new_fecha_realizacion)) {
        return [
            'success' => false,
            'data' => [
                'new_cif_nif' => $new_cif_nif,
                'new_nombre_cliente' => $new_nombre_cliente,
                'new_tel_s_contacto' => $new_tel_s_contacto,
                'new_descripcion' => $new_descripcion,
                'new_correo' => $new_correo,
                'new_direccion' => $new_direccion,
                'new_poblacion' => $new_poblacion,
                'new_codigo_postal' => $new_codigo_postal,
                'new_provincia' => $new_provincia,
                'new_estado' => $new_estado,
                'new_operario_encargado' => $new_operario_encargado,
                'new_fecha_realizacion' => $new_fecha_realizacion,
                'new_anotaciones_anteriores' => $new_anotaciones_anteriores,
                'new_anotaciones_posteriores' => $new_anotaciones_posteriores
            ]
        ];
    }

    $db = Database::getInstance();
    $mysqli = $db->getConnection();

    $stmt_Insert = $mysqli->prepare("INSERT INTO tarea (cif_nif, nombre_cliente, tel_s_contacto, descripcion, correo, direccion, poblacion, codigo_postal, provincia, estado, operario_encargado, fecha_realizacion, anotaciones_anteriores, anotaciones_posteriores) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
    $stmt_Insert->bind_param('ssssssssssssss', $new_cif_nif, $new_nombre_cliente, $new_tel_s_contacto, $new_descripcion, $new_correo, $new_direccion, $new_poblacion, $new_codigo_postal, $new_provincia, $new_estado, $new_operario_encargado, $new_fecha_realizacion, $new_anotaciones_anteriores, $new_anotaciones_posteriores);

    if ($stmt_Insert->execute()) {
        return ['success' => true];
    } else {
        return [
            'success' => false,
            'data' => [
                'new_cif_nif' => $new_cif_nif,
                'new_nombre_cliente' => $new_nombre_cliente,
                'new_tel_s_contacto' => $new_tel_s_contacto,
                'new_descripcion' => $new_descripcion,
                'new_correo' => $new_correo,
                'new_direccion' => $new_direccion,
                'new_poblacion' => $new_poblacion,
                'new_codigo_postal' => $new_codigo_postal,
                'new_provincia' => $new_provincia,
                'new_estado' => $new_estado,
                'new_operario_encargado' => $new_operario_encargado,
                'new_fecha_realizacion' => $new_fecha_realizacion,
                'new_anotaciones_anteriores' => $new_anotaciones_anteriores,
                'new_anotaciones_posteriores' => $new_anotaciones_posteriores
            ]
        ];
    }

    $stmt_Insert->close();
    $mysqli->close();
}
?>


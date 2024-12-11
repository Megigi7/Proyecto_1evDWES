<?php
namespace App\Models;

// Clase para crear y manejar la sesion
class Sesion {
    public function __construct() {
        session_start();
    }

    public function iniciar_sesion($nombre, $tipo) {
        // guardamos el nombre en una cookie
        setcookie('nombre', $nombre, time() + 3600000, '/');
        $_SESSION['nombre'] = $nombre;
        $_SESSION['tipo'] = $tipo;
    }

    public function cerrar_sesion() {
        session_unset();
        session_destroy();
    }

    public function comprobar_sesion() {
        if (isset($_SESSION['nombre']) && isset($_SESSION['tipo'])) {
            return true;
        } else {
            return false;
        }
    }

    public function get_nombre() {
        return $_COOKIE['nombre'];
    }

    public function get_tipo() {
        return $_SESSION['tipo'];
    }
}

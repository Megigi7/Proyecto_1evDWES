<?php
/**
 * @file conexion_db.php
 * @brief Clase para manejar la conexión a la base de datos.
 *
 * @details Esta clase implementa el patrón Singleton para asegurar que solo haya una instancia
 *          de la conexión a la base de datos en toda la aplicación.
 */
class Database {
    private static $instance = null; ///< Instancia única de la clase Database.
    private $connection; ///< Conexión a la base de datos.

    /**
     * @brief Constructor privado para evitar la creación directa de instancias.
     *
     * @details Configura la conexión a la base de datos utilizando mysqli.
     */
    private function __construct() {
        // Configuración de la conexión a la base de datos
        $this->connection = new mysqli('localhost', 'root', '', 'proyecto_dwes');

        // Verificar la conexión
        if ($this->connection->connect_error) {
            die("Conexión fallida: " . $this->connection->connect_error);
        }
    }

    /**
     * @brief Obtiene la instancia única de la clase Database.
     *
     * @return Database La instancia única de la clase Database.
     */
    public static function getInstance() {
        if (self::$instance == null) {
            self::$instance = new Database();
        }
        return self::$instance;
    }

    /**
     * @brief Obtiene la conexión a la base de datos.
     *
     * @return mysqli La conexión a la base de datos.
     */
    public function getConnection() {
        return $this->connection;
    }
}
?>
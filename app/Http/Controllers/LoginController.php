<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;

/**
 * @class LoginController
 * @brief Controlador para manejar la autenticación de usuarios.
 *
 * @details Esta clase maneja la lógica de autenticación de usuarios, incluyendo
 *          la verificación de credenciales y la gestión de sesiones y cookies.
 */
class LoginController extends Controller
{
    /**
     * @brief Autentica a un usuario basado en las credenciales proporcionadas.
     *
     * @param Request $request La solicitud HTTP que contiene las credenciales del usuario.
     * @return \Illuminate\View\View La vista correspondiente dependiendo del resultado de la autenticación.
     */
    public function authenticate(Request $request)
    {
        $nombre = $request->input('nombre');
        $contraseña = $request->input('contraseña');

        $users = [
            ['nombre' => 'usuario', 'contraseña' => 'usuario', 'tipo' => 1],
            ['nombre' => 'admin', 'contraseña' => 'admin', 'tipo' => 0],
        ];

        // Iniciar la sesión
        session_start();

        // Buscar usuario en el array
        foreach ($users as $user) {
            if ($user['nombre'] == $nombre && $user['contraseña'] == $contraseña) {
                // Guardar el tipo de usuario en la sesión
                session_start();
                $_SESSION['tipo'] = $user['tipo'];
                
                // Crear una cookie con el nombre de usuario que dura un mes
                setcookie('nombre', $nombre, time() + (30 * 24 * 60 * 60), "/"); // La cookie expira en 30 días

                // Redirigir a form_modif con el tipo de usuario
                return view('form_modif', ['tipo' => $user['tipo']]);
            }
        }

        $error = 'Usuario no existente';
        return view('login', ['error' => $error, 'old_nombre' => $nombre]);
    }
}
?>
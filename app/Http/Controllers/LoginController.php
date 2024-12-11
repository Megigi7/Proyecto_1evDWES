<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Sesion;

/**
 * @class LoginController
 * @brief Controlador para manejar la autenticación de usuarios.
 */
class LoginController extends Controller{
    public function showLoginForm()
    {
        return view('login');
    }

    public function authenticate(Request $request)
    {
        $nombre = $request->input('nombre');
        $contraseña = $request->input('contraseña');

        // Array de usuarios predefinidos
        $users = [
            ['nombre' => 'usuario', 'contraseña' => 'usuario', 'tipo' => 1],
            ['nombre' => 'admin', 'contraseña' => 'admin', 'tipo' => 0],
        ];

        // Buscar usuario en el array
        foreach ($users as $user) {
            if ($user['nombre'] == $nombre && $user['contraseña'] == $contraseña) {
                // Iniciar la sesión y guardar los datos correspondientes
                $sesion = new Sesion();
                $sesion->iniciar_sesion($nombre, $user['tipo']);
                
                // Redirigir a form_modif con el tipo de usuario
                return view('form_modif', ['tipo' => $user['tipo'], 'session' => $sesion]);
            }
        }

        // Si las credenciales no son válidas, retornar con un error
        return view('login', ['error' => 'Usuario no existente', 'old_nombre' => $nombre]);
    }
}

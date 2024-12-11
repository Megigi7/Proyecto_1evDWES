<?php

/**
 * @brief Valida un DNI, CIF o NIE.
 *
 * @details Esta función valida si una cadena proporcionada es un DNI, CIF o NIE válido.
 *          Realiza diferentes validaciones según el formato del documento.
 *
 * @param string $dni El DNI, CIF o NIE a validar.
 * @return bool true si el documento es válido, false en caso contrario.
 */
function validDniCifNie($dni) {
    $dni = strtoupper($dni); // Convertir a mayúsculas
    $letras = 'TRWAGMYFPDXBNJZSQVHLCKE';

    // Validar formato general
    if (!preg_match('/^[A-Z0-9]{9}$/', $dni)) {
        return false;
    }

    // Validar NIF estándar (8 números + 1 letra)
    if (preg_match('/^[0-9]{8}[A-Z]$/', $dni)) {
        $numero = substr($dni, 0, 8);
        $letra = substr($dni, -1);
        return $letra === $letras[$numero % 23];
    }

    // Validar NIE (X, Y, Z seguido de 7 números y una letra)
    if (preg_match('/^[XYZ][0-9]{7}[A-Z]$/', $dni)) {
        $numero = str_replace(['X', 'Y', 'Z'], ['0', '1', '2'], substr($dni, 0, 1)) . substr($dni, 1, 7);
        $letra = substr($dni, -1);
        return $letra === $letras[$numero % 23];
    }

    // Validar CIF (letra + 7 números + letra/número)
    if (preg_match('/^[ABCDEFGHJNPQRSUVW][0-9]{7}[A-Z0-9]$/', $dni)) {
        $sumaPar = 0;
        $sumaImpar = 0;

        for ($i = 1; $i <= 6; $i += 2) {
            $sumaPar += (int) $dni[$i];
        }

        for ($i = 0; $i <= 6; $i += 2) {
            $doble = (int) $dni[$i] * 2;
            $sumaImpar += $doble > 9 ? $doble - 9 : $doble;
        }

        $sumaTotal = $sumaPar + $sumaImpar;
        $control = (10 - ($sumaTotal % 10)) % 10;

        $controlEsperado = $dni[8];
        if (ctype_alpha($controlEsperado)) {
            return $controlEsperado === chr(64 + $control); // Letra como control
        } else {
            return $controlEsperado == $control; // Número como control
        }
    }

    // Validar NIE especial (T seguido de 8 caracteres)
    if (preg_match('/^T[0-9]{8}$/', $dni)) {
        return true; // Se acepta directamente
    }

    return false; // No cumple ningún formato válido
}
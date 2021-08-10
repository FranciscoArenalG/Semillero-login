<?php

//Mostrar errores de registro (Campos de texto que contienen numeros, email ya registrado o invalido,...)
function mostrarErrores($errores, $campo) {
    $alerta = '';
//    se va almacenando en el array errores los campos en los que los hay, tambien se verifica si esta vacio dicho campo
    if (isset($errores[$campo]) && !empty($campo)) {
        $alerta = $errores[$campo];
    }
    return $alerta;
}

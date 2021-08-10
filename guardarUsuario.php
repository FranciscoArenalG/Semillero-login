<?php

if (isset($_POST)) {

    // CONEXION
    require_once 'includes/conexion.php';

    if (!isset($_SESSION)) {
        session_start();
    }

    $nombre = isset($_POST['nombre']) ? mysqli_real_escape_string($db, $_POST['nombre']) : false;
    $apellidos = isset($_POST['apellidos']) ? mysqli_real_escape_string($db, $_POST['apellidos']) : false;
    $email = isset($_POST['email']) ? mysqli_real_escape_string($db, trim($_POST['email'])) : false;
    $password = isset($_POST['password']) ? mysqli_real_escape_string($db, $_POST['password']) : false;
    $passwordC = isset($_POST['passwordC']) ? mysqli_real_escape_string($db, $_POST['passwordC']) : false;


    // Array de Errores
    $errores = array();

    // NOMBRE
    if (!empty($nombre) && !is_numeric($nombre) && !preg_match("/[0-9]/", $nombre)) {
        $nombre_validado = true;
    } else {
        $nombre_validado = false;
        $errores['nombre'] = "Nombre invalido";
    }

    // APELLIDOS 
    if (!empty($apellidos) && !is_numeric($apellidos) && !preg_match("/[0-9]/", $apellidos)) {
        $apellidos_validado = true;
    } else {
        $apellidos_validado = false;
        $errores['apellidos'] = "Apellidos invalidos";
    }

//    Consulta para email

    $sqlEmail = "SELECT email FROM usuarios WHERE email = '$email';";
    $emails = mysqli_query($db, $sqlEmail);
    $emailsR = mysqli_num_rows($emails);

//    var_dump($emailsR);
//    die();
    // EMAIL
    if (!empty($email) && filter_var($email, FILTER_VALIDATE_EMAIL) && $emailsR < 1) {
        $email_validado = true;
    } else {
        $email_validado = false;

        $errores['email'] = "Email invalido o ya registrado";
    }

    // PASSWORD
    if (!empty($password) && $password == $passwordC) {
        $password_validado = true;
    } else {
        $password_validado = false;
        if ( empty($passwordC) || empty($password)) {
            $errores['password'] = "Contraseña vacia";
        } elseif($password != $passwordC) {
            $errores['passwordInvalida'] = "No coinciden las contraseñas";
        }
    }

    $guardarUsuario = false;

    if (count($errores) == 0) {
        $guardarUsuario = true;
        // CIFRAR PASSWORD
        $passwordSegura = password_hash($password, PASSWORD_BCRYPT, ['cost' => 4]);

        // INSERTAR USUARIO
        $sql = "INSERT INTO usuarios VALUES(1,'$nombre', '$apellidos', '$email', '$passwordSegura', CURDATE());";
        $guardar = mysqli_query($db, $sql);

//        var_dump(mysqli_error($db));
//        die();

        if ($guardar) {
            $_SESSION['completado'] = "Registro completado";
        } else {
            $_SESSION['errores']['general'] = "Fallo al guardar el usuario";
        }
    } else {
        $_SESSION['errores'] = $errores;
    }
}

header('Location: registro.php');


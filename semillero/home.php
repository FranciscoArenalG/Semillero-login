<!DOCTYPE html>
<?php
include("php/encrypt.php");
session_start();
if (!$_SESSION['id_user_semillero']) {
	header("Location:login");
}
 ?>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home</title>
    <link href="https://fonts.googleapis.com/css2?family=Martel:wght@300&family=Ubuntu:wght@300&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="css/normalize.css">
    <link rel="stylesheet" href="css/stylee.css">
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
<main class="contenedor seccion contenido-centrado">
<br>
    <form  action=" ">
        <fieldset class="formuDe form-register centrar-texto ">
            <h1>Bienvenido</h1>
            <p><?=encrypt_decrypt('decrypt', $_SESSION['name_user_semillero']);?></p>
            <button type="button" name="disconnect" class="botons" onclick="Cerrar()">Cerrar sesión</button>
        </fieldset>
    </form>
<br>
</main>
</body>
<script type="text/javascript" src="js/methods.js"></script>
</html>

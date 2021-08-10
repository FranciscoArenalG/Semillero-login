<?php require_once 'includes/conexion.php'; ?>
<?php require_once 'includes/helpers.php'; ?>
<!DOCTYPE html>
<html lang="es">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Registro Usuario</title>
    </head>

    <body>
        <h4>REGISTRO</h4>
        <?php
//        Si hay mensaje de registro completado, se muestra en pantalla y se hace null la variable
        if (isset($_SESSION['completado'])) {
            echo $_SESSION['completado'];
            $_SESSION['completado'] = null;
        }
        ?>

        <form action="guardarUsuario.php" method="POST">
            <label for="nombre">Nombre</label>
            <input type="nombre" name="nombre">
            <!-- se verifica si hay errores dependiendo del campo, de ser asi se muestran en pantalla-->
            <?php echo isset($_SESSION['errores']) ? mostrarErrores($_SESSION['errores'], 'nombre') : ''; ?> 
            <br><br>
            <label for="apellidos">Apellidos</label>
            <input type="apellidos" name="apellidos">
            <?php echo isset($_SESSION['errores']) ? mostrarErrores($_SESSION['errores'], 'apellidos') : ''; ?>
            <br><br>
            <label for="email">Email</label>
            <input type="email" name="email">
            <?php echo isset($_SESSION['errores']) ? mostrarErrores($_SESSION['errores'], 'email') : ''; ?>
            <br><br>
            <label for="password">Contraseña</label>
            <input type="password" name="password">
            <br><br>
            <label for="password">Confirmar contraseña</label>
            <input type="password" name="passwordC">
            <?php echo isset($_SESSION['errores']) ? mostrarErrores($_SESSION['errores'], 'passwordInvalida') : ''; ?>

            <?php
            echo isset($_SESSION['errores']) ? mostrarErrores($_SESSION['errores'], 'password') : '';
            $_SESSION['errores'] = null;
            ?>
            <br><br>
            <input type="submit" name="submit" value="Registrar">
        </form>
    </body>

</html>
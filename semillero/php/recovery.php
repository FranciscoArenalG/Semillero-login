<?php
include("conection.php");
include("encrypt.php");
$correo = encrypt_decrypt('encrypt', $_POST['recovery']);
$bus_correo = mysqli_query(ConSemillero(), "SELECT * FROM users WHERE email_user = '$correo'");
$resp="";
if (mysqli_num_rows($bus_correo) > 0) {
  while ($datos=mysqli_fetch_array($bus_correo)) {
    $correo_recovery = encrypt_decrypt('decrypt', $datos['email_user']);
    $name_recovery = encrypt_decrypt('decrypt', $datos['name_user']);
    $pass_recovery = encrypt_decrypt('decrypt', $datos['password_user']);
  }
  $to = $correo_recovery;
  $subject = 'RECUPERACIÓN DE CONTRASEÑA';
  $message = 'Hola ' . $name_recovery . " recibimos la solicitud de recuperación de contraseña. \n Usuario: " . $correo_recovery . "\nContraseña: " . $pass_recovery;
  $headers = 'From:tic.full.cdmx@gmail.com' . "\r\n".
              'Reply-To: tic.full.cdmx@gmail.com' . "\r\n".
              'X-Mailer: PHP/' . phpversion();
  mail($to, $subject, $message, $headers);
  $resp = "existe";
}else{
  $resp = "incorrecto";
}

echo $resp;



 ?>

<?php
include("conection.php");
include("encrypt.php");
$respuesta="";
$email = mysqli_real_escape_string(ConSemillero(),$_POST['email']);
$password = mysqli_real_escape_string(ConSemillero(),$_POST['password']);
$email_txt = encrypt_decrypt('encrypt', $email);
$password_txt = encrypt_decrypt('encrypt', $password);
$user = mysqli_query(ConSemillero(), "SELECT * FROM users WHERE email_user = '$email_txt'");
if ($datos=mysqli_fetch_assoc($user)) {
  if ($password_txt == $datos['password_user']) {
    session_start();
    $_SESSION['id_user_semillero']=$datos['id_user'];
		$_SESSION['email_user_semillero']=$datos['email_user'];
		$_SESSION['name_user_semillero']=$datos['name_user'];
    mysqli_query(ConSemillero(), "UPDATE users SET access = NOW() WHERE id_user = '$_SESSION[id_user_semillero]'");
    $respuesta="correcto";
  }else {
    $respuesta="password";
  }
}else {
  $respuesta="user";
}
echo $respuesta;
?>

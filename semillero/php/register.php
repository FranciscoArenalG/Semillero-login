<?php
include("conection.php");
include("encrypt.php");

$nombres_reg = mysqli_real_escape_string(ConSemillero(), $_POST['nombres']);
$apellidos_reg = mysqli_real_escape_string(ConSemillero(), $_POST['apellidos']);
$correo_reg = mysqli_real_escape_string(ConSemillero(), $_POST['correo']);
$pass1_reg = mysqli_real_escape_string(ConSemillero(), $_POST['pass1']);

$nombres_reg_txt = encrypt_decrypt('encrypt', $nombres_reg);
$apellidos_reg_txt = encrypt_decrypt('encrypt', $apellidos_reg);
$correo_reg_txt = encrypt_decrypt('encrypt', $correo_reg);
$pass1_reg_txt = encrypt_decrypt('encrypt', $pass1_reg);
$resp="";
$buscar = mysqli_query(ConSemillero(), "SELECT * FROM users WHERE email_user = '$correo_reg_txt'");
if (mysqli_num_rows($buscar) > 0) {
  $resp = "existente";
}else {
  mysqli_query(ConSemillero(), "INSERT INTO users(name_user, last_name, email_user, password_user, access) VALUES ('$nombres_reg_txt','$apellidos_reg_txt','$correo_reg_txt','$pass1_reg_txt',NOW())");
  $resp = "correcto";
}

echo $resp;
 ?>

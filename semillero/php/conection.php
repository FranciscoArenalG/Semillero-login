<?php
function ConSemillero(){
  $conexion = mysqli_connect('localhost', 'root', '', "semillero_login");
  if (mysqli_connect_errno($conexion))
    echo "Fallo al conectar a MySQL: " . mysqli_connect_error();
  $conexion->set_charset('utf8');
  return $conexion;
}
 ?>

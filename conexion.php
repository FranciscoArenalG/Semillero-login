<?php

$server = 'localhost';
$username = 'admin';
$password = 'admin';
$database = 'usuario';

$db = mysqli_connect($server,$username,$password,$database);

mysqli_query($db,"SET NAMES 'utf-8'");

// INICIAR SESSION
if (!isset($_SESSION)) {
    session_start();
}
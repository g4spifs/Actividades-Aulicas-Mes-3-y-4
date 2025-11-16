<?php
session_start();

$servidor = "localhost";
$usuario_db = "root";       
$clave_db = "";             
$db = "halloween";          
// Usamos la función para conectar 
$con = mysqli_connect($servidor, $usuario_db, $clave_db, $db);

// Comprobamos la conexión
if (!$con) {
    die("Falló la conexión: " . mysqli_connect_error());
}
?>
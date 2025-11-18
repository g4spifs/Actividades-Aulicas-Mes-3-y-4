<?php
// Incluimos la conexión para poder iniciar la sesión
include('conexion.php');

// Limpiamos todas las variables de sesión
session_unset();

// Destruimos la sesión
session_destroy();

// Redirigimos al inicio
header("Location: index.php");
exit;
?>
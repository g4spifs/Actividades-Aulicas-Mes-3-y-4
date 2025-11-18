<?php
include('conexion.php'); // Conecta a la BD e inicia la sesión

// 1. Verificar que el usuario esté logueado [cite: 22]
if (!isset($_SESSION['id_usuario'])) {
    header("Location: login.php"); // Si no, fuera
    exit;
}

// 2. Verificar que se haya pasado un ID de disfraz
if (!isset($_GET['id'])) {
    header("Location: index.php");
    exit;
}

$id_usuario = $_SESSION['id_usuario'];
$id_disfraz = (int)$_GET['id']; // Convertir a entero por seguridad

// 3. Prevenir votos duplicados 
$sql_check = "SELECT * FROM votos WHERE id_usuario = $id_usuario AND id_disfraz = $id_disfraz";
$query_check = mysqli_query($con, $sql_check);

if (mysqli_num_rows($query_check) > 0) { 
    header("Location: index.php?err=1"); // Redirige con mensaje de error
    exit;
}

// 4. Si no ha votado, procesar el voto
// a. Insertar el registro en la tabla 'votos' para que no vuelva a votar
$sql_insert_voto = "INSERT INTO votos (id_usuario, id_disfraz) VALUES ($id_usuario, $id_disfraz)";
mysqli_query($con, $sql_insert_voto);

// b. Actualizar el contador en la tabla 'disfraces'
$sql_update_conteo = "UPDATE disfraces SET votos = votos + 1 WHERE id = $id_disfraz";
mysqli_query($con, $sql_update_conteo);

// 5. Redirigir con mensaje de éxito
header("Location: index.php?ok=1");
exit;

?>
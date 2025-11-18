<?php
include('conexion.php'); // Conecta a la BD e inicia la sesión
$mensaje = "";

// Comprobamos si el formulario fue enviado [cite: 62]
if (isset($_POST['nombre']) && isset($_POST['clave'])) {

    // Seguridad: Escapar datos de entrada del usuario 
    $nombre = mysqli_real_escape_string($con, $_POST['nombre']);
    $clave_original = $_POST['clave'];

    // Seguridad: Hashear la contraseña. 
    $clave_hasheada = password_hash($clave_original, PASSWORD_DEFAULT);

    // 1. Verificar si el usuario ya existe
    $sql_check = "SELECT * FROM usuarios WHERE nombre = '$nombre'";
    $query_check = mysqli_query($con, $sql_check); // [cite: 38]

    // [cite: 39]
    if (mysqli_num_rows($query_check) > 0) { 
        $mensaje = "Error: Ese nombre de usuario ya está registrado.";
    } else {
        // 2. Si no existe, insertarlo
        $sql_insert = "INSERT INTO usuarios (nombre, clave) VALUES ('$nombre', '$clave_hasheada')"; // 
        
        if (mysqli_query($con, $sql_insert)) {
            $mensaje = "¡Usuario registrado con éxito! <a href='login.php'>Inicia sesión aquí</a>";
        } else {
            $mensaje = "Error al registrar: " . mysqli_error($con); // [cite: 60]
        }
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Registro de Halloween</title>
</head>
<body>
    <h2>Registro de Usuario</h2>
    <form method="POST" action="registro.php">
        <div>
            <label>Nombre de Usuario:</label>
            <input type="text" name="nombre" required>
        </div>
        <div>
            <label>Contraseña:</label>
            <input type="password" name="clave" required>
        </div>
        <input type="submit" value="Registrarse">
    </form>
    
    <?php if ($mensaje): ?>
        <p><?php echo $mensaje; ?></p>
    <?php endif; ?>
</body>
</html>
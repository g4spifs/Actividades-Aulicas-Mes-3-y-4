<?php
include('conexion.php'); // Conecta a la BD e inicia la sesión
$mensaje = "";

// Comprobamos si el formulario fue enviado [cite: 62]
if (isset($_POST['nombre']) && isset($_POST['clave'])) {
    
    $nombre = mysqli_real_escape_string($con, $_POST['nombre']); // 
    $clave_ingresada = $_POST['clave'];

    $sql = "SELECT * FROM usuarios WHERE nombre = '$nombre'"; // 
    $query = mysqli_query($con, $sql); // [cite: 38]

    // Verificamos si encontramos al usuario [cite: 39]
    if ($query && mysqli_num_rows($query) == 1) {
        $usuario = mysqli_fetch_assoc($query);
        
        // Seguridad: Verificar la contraseña hasheada
        if (password_verify($clave_ingresada, $usuario['clave'])) {
            
            // Autenticación exitosa 
            $_SESSION['id_usuario'] = $usuario['id'];
            $_SESSION['nombre_usuario'] = $usuario['nombre'];
            
            // Redirigir al inicio
            header("Location: index.php");
            exit; // Detener la ejecución del script
            
        } else {
            $mensaje = "Error: Contraseña incorrecta.";
        }
    } else {
        $mensaje = "Error: Usuario no encontrado.";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Login de Halloween</title>
</head>
<body>
    <h2>Inicio de Sesión</h2>
    <form method="POST" action="login.php">
        <div>
            <label>Nombre de Usuario:</label>
            <input type="text" name="nombre" required>
        </div>
        <div>
            <label>Contraseña:</label>
            <input type="password" name="clave" required>
        </div>
        <input type="submit" value="Iniciar Sesión">
    </form>

    <?php if ($mensaje): ?>
        <p><?php echo $mensaje; ?></p>
    <?php endif; ?>

    <p>¿No tienes cuenta? <a href="registro.php">Regístrate aquí</a></p>
</body>
</html>
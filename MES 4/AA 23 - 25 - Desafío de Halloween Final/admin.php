<?php
include('conexion.php');

// 1. Seguridad: Verificar si el usuario está logueado Y si es admin 
// Asumimos que el admin es el usuario con ID 1
if (!isset($_SESSION['id_usuario']) || $_SESSION['id_usuario'] != 1) {
    echo "Acceso denegado.";
    exit;
}

$mensaje = "";

// 2. Lógica para AÑADIR un disfraz
if (isset($_POST['guardar'])) { 
    
    $nombre = mysqli_real_escape_string($con, $_POST['nombre']); 
    $descripcion = mysqli_real_escape_string($con, $_POST['descripcion']);
    $nombre_foto = "";

    // 3. Lógica de subida de imagen 
    if (isset($_FILES['foto']) && $_FILES['foto']['error'] == 0) { 
        
        // Usamos is_uploaded_file por seguridad 
        if (is_uploaded_file($_FILES['foto']['tmp_name'])) {
            
            $extension_partes = explode(".", $_FILES['foto']['name']); 
            $extension = end($extension_partes); // 
            
            // Creamos un nombre único usando time() 
            $nombre_foto = time() . "." . $extension;
            $ruta_destino = "fotos/" . $nombre_foto;

            // Mover el archivo (copy o move_uploaded_file) 
            if (!move_uploaded_file($_FILES['foto']['tmp_name'], $ruta_destino)) {
                $mensaje = "Error al mover la imagen.";
                $nombre_foto = ""; // Resetea por si falló
            }
        }
    }

    // Insertar en la base de datos
    $sql_insert = "INSERT INTO disfraces (nombre, descripcion, votos, foto, eliminado) 
                   VALUES ('$nombre', '$descripcion', 0, '$nombre_foto', 0)";

    if (mysqli_query($con, $sql_insert)) {
        $mensaje = "Disfraz añadido con éxito.";
    } else {
        $mensaje = "Error al añadir: " . mysqli_error($con); // [cite: 60]
    }
}

// 4. Lógica para ELIMINAR un disfraz
if (isset($_GET['eliminar'])) {
    $id_eliminar = (int)$_GET['eliminar'];

    // a. Borrar el archivo de imagen del servidor
    $sql_get_foto = "SELECT foto FROM disfraces WHERE id = $id_eliminar";
    $query_get_foto = mysqli_query($con, $sql_get_foto);
    $disfraz = mysqli_fetch_assoc($query_get_foto);
    
    if ($disfraz && !empty($disfraz['foto'])) {
        $ruta_a_borrar = "fotos/" . $disfraz['foto'];
        if (file_exists($ruta_a_borrar)) { // [cite: 63]
            unlink($ruta_a_borrar); // [cite: 61]
        }
    }

    // b. Marcamos como eliminado en la BD 
    // El PDF usa un "eliminado = 0", así que haremos un borrado lógico
    $sql_delete = "UPDATE disfraces SET eliminado = 1 WHERE id = $id_eliminar";
    
    if (mysqli_query($con, $sql_delete)) {
        $mensaje = "Disfraz eliminado (marcado como borrado).";
    } else {
        $mensaje = "Error al eliminar: " . mysqli_error($con);
    }
}

?>
<!DOCTYPE html>
<html>
<head>
    <title>Admin - Disfraces</title>
    <link rel="stylesheet" href="estilos.css">
</head>
<body>
    <header>
        <h1>Panel de Administración</h1>
        <nav><a href="index.php">Volver al inicio</a></nav>
    </header>
    
    <main>
        <?php if ($mensaje): ?><p><?php echo $mensaje; ?></p><?php endif; ?>

        <h2>Añadir Nuevo Disfraz</h2>
        <form method="POST" action="admin.php" enctype="multipart/form-data">
            <div>
                <label>Nombre:</label>
                <input type="text" name="nombre" required>
            </div>
            <div>
                <label>Descripción:</label>
                <textarea name="descripcion" required></textarea>
            </div>
            <div>
                <label>Foto:</label>
                <input type="file" name="foto" accept="image/jpeg, image/png">
            </div>
            <input type="submit" name="guardar" value="Guardar Disfraz">
        </form>

        <hr>

        <h2>Gestionar Disfraces Existentes</h2>
        <table border="1" width="100%">
            <tr>
                <th>ID</th>
                <th>Nombre</th>
                <th>Foto</th>
                <th>Votos</th>
                <th>Acción</th>
            </tr>
            <?php
            // 5. Lógica para (Read) los disfraces
            $sql_leer = "SELECT * FROM disfraces WHERE eliminado = 0";
            $query_leer = mysqli_query($con, $sql_leer);
            while ($disfraz = mysqli_fetch_assoc($query_leer)):
            ?>
            <tr>
                <td><?php echo $disfraz['id']; ?></td>
                <td><?php echo htmlspecialchars($disfraz['nombre']); ?></td>
                <td><?php echo htmlspecialchars($disfraz['foto']); ?></td>
                <td><?php echo $disfraz['votos']; ?></td>
                <td>
                    <a href="admin.php?eliminar=<?php echo $disfraz['id']; ?>" onclick="return confirm('¿Seguro que quieres eliminar este disfraz?');">
                        Eliminar
                    </a>
                </td>
            </tr>
            <?php endwhile; ?>
        </table>
    </main>
</body>
</html>
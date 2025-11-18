<?php
include('conexion.php'); // Conecta a la BD e inicia la sesión

// Verificamos si hay un mensaje de error 
$error = isset($_GET['err']) ? "¡Ya has votado por ese disfraz!" : "";
$exito = isset($_GET['ok']) ? "¡Gracias por tu voto!" : "";

?>
<!DOCTYPE html>
<html>
<head>
    <title>Votación de Disfraces de Halloween</title>
    <link rel="stylesheet" href="estilos.css">
</head>
<body>
    <header>
        <h1>Disfraces de Halloween</h1>
        <nav>
            <?php if (isset($_SESSION['id_usuario'])): ?>
                <span>Hola, <?php echo htmlspecialchars($_SESSION['nombre_usuario']); ?></span>
                
                <?php 
                // Asumiremos que el admin es el usuario con ID 1
                // Esto cumple el requisito de "un usuario administrador" 
                if ($_SESSION['id_usuario'] == 1): ?>
                    <a href="admin.php">Admin</a>
                <?php endif; ?>

                <a href="logout.php">Cerrar Sesión</a>
            <?php else: ?>
                <a href="login.php">Iniciar Sesión</a>
                <a href="registro.php">Registrarse</a>
            <?php endif; ?>
        </nav>
    </header>

    <main>
        <h2>Lista de Disfraces</h2>
        
        <?php if ($error): ?><p class="error"><?php echo $error; ?></p><?php endif; ?>
        <?php if ($exito): ?><p class="exito"><?php echo $exito; ?></p><?php endif; ?>

        <div class="disfraces-container">
            <?php
            // Seleccionamos los disfraces que no están "eliminados"
            $sql = "SELECT * FROM disfraces WHERE eliminado = 0 ORDER BY votos DESC";
            $query = mysqli_query($con, $sql);

            [cite_start]if (mysqli_num_rows($query) > 0): 
                while ($disfraz = mysqli_fetch_assoc($query)):
            ?>
                <div class="disfraz-card">
                    <h3><?php echo htmlspecialchars($disfraz['nombre']); ?></h3>
                    
                    <?php 
                    [cite_start]// Verificamos si la foto existe antes de mostrarla 
                    $ruta_foto = "fotos/" . $disfraz['foto'];
                    if (!empty($disfraz['foto']) && file_exists($ruta_foto)): 
                    ?>
                        <img src="<?php echo $ruta_foto; ?>" alt="<?php echo htmlspecialchars($disfraz['nombre']); ?>">
                    <?php else: ?>
                        <img src="fotos/default.jpg" alt="Sin imagen"> <?php endif; ?>

                    <p><?php echo htmlspecialchars($disfraz['descripcion']); ?></p>
                    <p class="votos">Votos: <?php echo $disfraz['votos']; ?></p>
                    
                    <?php if (isset($_SESSION['id_usuario'])): ?>
                        <a href="votar.php?id=<?php echo $disfraz['id']; ?>" class="boton-votar">Votar</a>
                    <?php else: ?>
                        <p><a href="login.php">Inicia sesión</a> para votar</p>
                    <?php endif; ?>
                </div>
            <?php
                endwhile;
            else:
                echo "<p>No hay disfraces para mostrar todavía.</p>";
            endif;
            ?>
        </div>
    </main>
</body>
</html>
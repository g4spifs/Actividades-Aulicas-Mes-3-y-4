<?php
include('includes/conexion.php');
conectar();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>AA 20</title>
    <link rel="stylesheet" href="css/estilos.css">
    <script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
</head>
<body>
    <div id="consola"></div>
    <nav>
        <ul>
            <?php
            // Hacemos la consulta a la tabla 'menu'
            $sql = mysqli_query($con, "SELECT * FROM menu");
            if(mysqli_num_rows($sql) != 0)
            {
                // Recorremos los resultados
                while($r = mysqli_fetch_array($sql))
                {
                    // Creamos un <li> por cada fila
                    echo '<li><a href="index.php?modulo='.$r['modulo'].'">'.$r['nombre'].'</a></li>';
                }
            }
            ?>
        </ul>
    </nav>
    <header>
        <br>
        <h1>Guía AA 20</h1>
    </header>
    <main>
        <?php
        if(!empty($_GET['modulo']))
        {

            include('modulos/'.$_GET['modulo'].'.php');
        }
        else
        {
           include('modulos/inicio.php');
        }
        ?>
    </main>
    <script src="js/script.js"></script>
</body>
</html>
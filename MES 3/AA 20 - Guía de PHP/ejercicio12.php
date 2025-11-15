<?php
// Variable para guardar el resultado
$resultado = "";

// 1. Verificamos si el formulario fue enviado (si el método es POST)
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // --- PROCESAR DATOS ---
    
    // Obtenemos los datos
    $nombre = $_POST['nombre'];
    $ingresos = $_POST['ingresos']; // 'ingresos' es el name del <select>

    $mensaje = "Nombre: <strong>$nombre</strong><br>Rango de Ingresos: <strong>$ingresos</strong><br><br>";

    // 2. Comprobar la condición 
    // Comparamos con el 'value' exacto del option seleccionado
    if ($ingresos == ">3000") {
        $mensaje .= "<strong>Resultado:</strong> ¡Debe pagar impuestos a las ganancias!";
    } else {
        $mensaje .= "<strong>Resultado:</strong> No debe pagar impuestos a las ganancias.";
    }
    
    // Guardamos todo en la variable de resultado
    $resultado = "<h2>Resultado de la Verificación</h2>" . $mensaje;
}

?>
<!DOCTYPE html>
<html>
<head>
    <title>Formulario de Ingresos</title>
</head>
<body>
    <h2>Verificación de Impuestos</h2>
    
    <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="POST">
        Nombre: <input type="text" name="nombre" required>
        <br><br>
        
        Ingresos Mensuales:
        <select name="ingresos">
            <option value="1-1000">1-1000</option>       
            <option value="1001-3000">1001-3000</option> 
            <option value=">3000">>3000</option>         
        </select>
        <br><br>
        
        <input type="submit" value="Verificar">
    </form>

    <hr>
    
    <?php
    // 3. Mostramos el resultado aquí, solo si no está vacío
    if ($resultado != "") {
        echo $resultado;
    }
    ?>
</body>
</html>
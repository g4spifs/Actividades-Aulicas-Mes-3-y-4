<?php
$resultado = ""; // Para mensaje de confirmación

// 1. Verificamos si el formulario fue enviado
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // --- PROCESAR DATOS ---
    
    // Datos del cliente
    $nombre = $_POST['nombre'];
    $direccion = $_POST['direccion'];
    
    // Nombre del archivo donde guardaremos 
    $archivo = 'pedidos.txt';
    
    // 2. Construir el texto del pedido
    $pedido_texto = "------------------------------\n"; // 
    $pedido_texto .= "Pedido de: " . $nombre . "\n";
    $pedido_texto .= "Dirección: " . $direccion . "\n";
    $pedido_texto .= "Pizzas Solicitadas:\n";
    
    $pedido_realizado = false; // Para saber si pidió al menos una pizza
    
    // Pizza 1: Jamón y Queso 
    if (isset($_POST['jamon_queso'])) {
        $cantidad_jyq = $_POST['cant_jyq'];
        if ($cantidad_jyq > 0) { // Solo guardamos si la cantidad es > 0
            $pedido_texto .= "- ($cantidad_jyq) x Jamón y Queso\n";
            $pedido_realizado = true;
        }
    }
    
    // Pizza 2: Napolitana 
    if (isset($_POST['napolitana'])) {
        $cantidad_napo = $_POST['cant_napo'];
        if ($cantidad_napo > 0) {
            $pedido_texto .= "- ($cantidad_napo) x Napolitana\n";
            $pedido_realizado = true;
        }
    }

    // Pizza 3: Muzzarella 
    if (isset($_POST['muzzarella'])) {
        $cantidad_muzza = $_POST['cant_muzza'];
        if ($cantidad_muzza > 0) {
            $pedido_texto .= "- ($cantidad_muzza) x Muzzarella\n";
            $pedido_realizado = true;
        }
    }
    
    // 3. Guardar en el archivo de texto
    if ($pedido_realizado) {
        file_put_contents($archivo, $pedido_texto, FILE_APPEND | LOCK_EX);
        
        $resultado = "<h3>¡Pedido confirmado!</h3><p>Tu pedido ha sido guardado.</p>";
    } else {
        $resultado = "<h3>Error</h3><p>No seleccionaste ninguna pizza o no indicaste una cantidad mayor a 0.</p>";
    }
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Pedido de Pizzas</title>
</head>
<body>
    <h2>Formulario de Pedido de Pizzas</h2> 
    
    <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="POST">
        Nombre: <input type="text" name="nombre" required> 
        <br>
        Dirección: <input type="text" name="direccion" required> 
        <br><br>
        
        <strong>Selecciona tus pizzas:</strong><br>
        
        <input type="checkbox" name="jamon_queso" value="si"> 
        Jamón y Queso 
        Cantidad: <input type="number" name="cant_jyq" value="0" style="width: 50px;"> 
        <br>
        
        <input type="checkbox" name="napolitana" value="si"> 
        Napolitana 
        Cantidad: <input type="number" name="cant_napo" value="0" style="width: 50px;"> 
        <br>

        <input type="checkbox" name="muzzarella" value="si"> 
        Muzzarella 
        Cantidad: <input type="number" name="cant_muzza" value="0" style="width: 50px;"> 
        <br><br>
        
        <input type="submit" value="Confirmar Pedido"> 
    </form>

    <hr>
    
    <?php
    // Mostramos el mensaje de confirmación o error
    echo $resultado;
    ?>
</body>
</html>
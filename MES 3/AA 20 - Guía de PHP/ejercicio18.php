<?php
$resultado = ""; // Para el mensaje

// 1. Definimos la función 
function verificarClaves($c1, $c2) {
    if ($c1 != $c2) {
        return "Error: Las dos claves ingresadas son <strong>distintas</strong>.";
    } else {
        return "OK: Las claves coinciden.";
    }
}

// 2. Verificamos si el formulario fue enviado
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $usuario = $_POST['usuario'];
    $clave1 = $_POST['clave1'];
    $clave2 = $_POST['clave2']; // La segunda clave 
    
    // 3. Llamamos a la función y guardamos su respuesta
    $mensaje_funcion = verificarClaves($clave1, $clave2);
    
    // Preparamos el resultado para mostrarlo abajo
    $resultado = "<h2>Verificación de Claves</h2>
                  <p>Usuario: <strong>$usuario</strong></p>
                  <p>Resultado de la función: $mensaje_funcion</p>";
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Verificación de Claves</title>
</head>
<body>
    <h2>Registro de Usuario</h2>
    <p>Ingresa tu nombre de usuario y tu clave (dos veces) </p>
    
    <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="POST">
        Usuario:
        <input type="text" name="usuario" required>
        <br>
        Clave:
        <input type="password" name="clave1" required>
        <br>
        Repetir Clave:
        <input type="password" name="clave2" required>
        <br><br>
        <input type="submit" value="Verificar">
    </form>

    <hr>
    
    <?php
    echo $resultado;
    ?>
</body>
</html>
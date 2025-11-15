<?php
// 1. Recibimos los datos del formulario
// $_POST["nombre"] -> 'nombre' es el 'name' del input
$nombre_recibido = $_POST['nombre']; 
$edad_recibida = $_POST['edad'];

// 2. Mostramos el nombre
echo "Hola, <strong>$nombre_recibido</strong>.";
echo "<br>";

// 3. Verificamos si es mayor de edad
if ($edad_recibida >= 18) {
    echo "Eres <strong>mayor de edad</strong> (tienes $edad_recibida años).";
} else {
    echo "Eres <strong>menor de edad</strong> (tienes $edad_recibida años).";
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Formulario de Edad</title>
</head>
<body>
    <h2>Ingresa tus datos</h2>
    
    <form action="procesar_edad.php" method="POST">
        Nombre: <input type="text" name="nombre">
        <br>
        Edad: <input type="number" name="edad">
        <br>
        <input type="submit" value="Enviar">
    </form>
</body>
</html>

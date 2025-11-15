<?php
// 1. Recibimos el nombre
$nombre = $_POST['nombre'];

echo "Nombre: <strong>$nombre</strong>";
echo "<br>";

// 2. Verificamos qué radio fue seleccionado
if (isset($_POST['estudios'])) { // Comprobamos si seleccionó algo
    $nivel_estudios = $_POST['estudios'];
    
    // Usamos un 'switch' para mostrar el mensaje adecuado
    switch ($nivel_estudios) {
        case "ninguno":
            echo "La persona <strong>no tiene estudios</strong>.";
            break;
        case "primarios":
            echo "La persona tiene <strong>estudios primarios</strong>.";
            break;
        case "secundarios":
            echo "La persona tiene <strong>estudios secundarios</strong>.";
            break;
    }
} else {
    echo "No seleccionaste un nivel de estudios.";
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Formulario de Estudios</title>
</head>
<body>
    <h2>Ingresa tu nivel de estudios</h2>
    
    <form action="procesar_estudios.php" method="POST">
        Nombre: <input type="text" name="nombre">
        <br><br>
        
        Nivel de estudios:
        <br>
        <input type="radio" name="estudios" value="ninguno"> No tiene estudios
        <br>
        <input type="radio" name="estudios" value="primarios"> Estudios primarios
        <br>
        <input type="radio" name="estudios" value="secundarios"> Estudios secundarios
        <br><br>
        
        <input type="submit" value="Enviar">
    </form>
</body>
</html>
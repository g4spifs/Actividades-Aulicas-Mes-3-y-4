<?php
// 1. Recibimos el nombre
$nombre = $_POST['nombre'];

echo "Hola, <strong>$nombre</strong>.";
echo "<br>";

// 2. Verificamos los checkboxes
if (isset($_POST['deportes'])) {
    // Los datos de los checkboxes llegan como un "Vector" o "Array"
    $deportes_seleccionados = $_POST['deportes'];
    
    // Contamos cuántos elementos tiene el vector
    $cantidad = count($deportes_seleccionados); //
    
    echo "Practicas un total de <strong>$cantidad</strong> deportes.";
    
    // Opcional: mostrar cuáles seleccionó
    echo "<ul>";
    foreach ($deportes_seleccionados as $deporte) {
        echo "<li>$deporte</li>";
    }
    echo "</ul>";
    
} else {
    // Si no seleccionó ninguno
    echo "No practicas ningún deporte de la lista.";
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Formulario de Deportes</title>
</head>
<body>
    <h2>¿Qué deportes practicas?</h2>
    
    <form action="procesar_deportes.php" method="POST">
        Nombre: <input type="text" name="nombre">
        <br><br>
        
        Deportes:
        <br>
        <input type="checkbox" name="deportes[]" value="futbol"> Fútbol
        <br>
        <input type="checkbox" name="deportes[]" value="basket"> Basket
        <br>
        <input type="checkbox" name="deportes[]" value="tennis"> Tennis
        <br>
        <input type="checkbox" name="deportes[]" value="voley"> Voley
        <br><br>
        
        <input type="submit" value="Enviar">
    </form>
</body>
</html>
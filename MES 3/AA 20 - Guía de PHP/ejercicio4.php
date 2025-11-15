<?php
// 1. Generar el número aleatorio entre 1 y 100
$num = rand(1, 100); // [cite: 3]

// 2. Mostrarlo por pantalla
echo "El número aleatorio generado es: <strong>$num</strong>"; // [cite: 5, 7]

// 3. Imprimir un salto de línea en HTML para que no se amontone
echo "<br>";

// 4. Mostrar si es menor/igual a 50 o mayor
if ($num <= 50) {
    echo "El número es menor o igual a 50."; // [cite: 6]
} else {
    echo "El número es mayor a 50."; // [cite: 6]
}
?>
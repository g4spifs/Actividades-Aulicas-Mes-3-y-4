<?php
// 1. Generar el número aleatorio entre 1 y 3
$num = rand(1, 3); // 

echo "Número generado: $num";
echo "<br>";

// 2. Usar condicionales para imprimir el nombre en castellano
if ($num == 1) { // 
    echo "uno"; // 
} elseif ($num == 2) {
    echo "dos";
} else {
    echo "tres"; // 
}
?>
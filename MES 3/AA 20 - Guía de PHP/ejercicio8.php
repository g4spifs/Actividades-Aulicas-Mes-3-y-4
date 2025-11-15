<?php
// Título general
echo "<h1>Tabla de multiplicar del 2</h1>";

// 1. Usando el bucle 'for'
echo "<h2>Usando 'for'</h2>";
for ($i = 1; $i <= 10; $i++) {
    echo "2 x $i = " . (2 * $i) . "<br>";
}

// 2. Usando el bucle 'while'
echo "<h2>Usando 'while'</h2>";
$j = 1; // Inicializamos el contador
while ($j <= 10) {
    echo "2 x $j = " . (2 * $j) . "<br>";
    $j++; // Incrementamos el contador
}

// 3. Usando el bucle 'do/while'
echo "<h2>Usando 'do/while'</h2>";
$k = 1; // Inicializamos el contador
do {
    echo "2 x $k = " . (2 * $k) . "<br>";
    $k++; // Incrementamos el contador
} while ($k <= 10);
?>
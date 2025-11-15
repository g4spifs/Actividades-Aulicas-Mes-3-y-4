<?php
echo "<h1>Historial de Pedidos</h1>";
echo "<p>Mostrando el contenido del archivo 'pedidos.txt'</p>";

$archivo = 'pedidos.txt'; // 

// 1. Comprobar si el archivo existe
if (file_exists($archivo)) {
    // 2. Leer todo el contenido del archivo
    $contenido = file_get_contents($archivo);
    
    // 3. Mostrar el contenido
    echo "<pre>" . htmlspecialchars($contenido) . "</pre>";
    
} else {
    echo "Aún no se ha realizado ningún pedido. El archivo 'pedidos.txt' no existe.";
}
?>
<?php
echo "<h1>Vectores (Días de la semana)</h1>";

// 1. Definir el vector con los nombres 
$dias_semana = [
    "Lunes",
    "Martes",
    "Miércoles",
    "Jueves",
    "Viernes",
    "Sábado",
    "Domingo"
];

// 2. Imprimir el primero 
echo "El primer elemento del vector es: <strong>" . $dias_semana[0] . "</strong>";
echo "<br>";

// 3. Imprimir el último 
$ultimo_indice = count($dias_semana) - 1;

echo "El último elemento del vector es: <strong>" . $dias_semana[$ultimo_indice] . "</strong>";
?>
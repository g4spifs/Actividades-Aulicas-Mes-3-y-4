<?php
echo "<h1>Vectores Asociativos (Claves de Usuarios)</h1>";

// 1. Crear un vector asociativo 
$claves_usuarios = [
    "juan_perez" => "jP_123*$",
    "ana_lopez"  => "gatoAzul99",
    "admin"      => "pass!@#Admin",
    "maria"      => "sol.2024",
    "test_user"  => "4321"
];

// 2. Acceder e imprimir una componente por su nombre (clave) 
$usuario_a_mostrar = "admin";

echo "Accediendo a la clave del usuario: <strong>$usuario_a_mostrar</strong>";
echo "<br>";
echo "La clave es: <strong>" . $claves_usuarios[$usuario_a_mostrar] . "</strong>";

// Opcional: Imprimir otra
echo "<br><br>";
echo "La clave de 'ana_lopez' es: <strong>" . $claves_usuarios['ana_lopez'] . "</strong>";
?>
<?php
$contrato_finalizado = "";

// 1. Texto base del contrato 
$contrato_base = "En la ciudad de [........], se acuerda entre la Empresa [..........]
representada por el Sr. [..............] en su carácter de Apoderado,
con domicilio en la calle [..............] y el Sr. [..............],
futuro empleado con domicilio en [..............], celebrar el presente
contrato a Plazo Fijo, de acuerdo a la normativa vigente de los
artículos 90,92,93,94, 95 y concordantes de la Ley de Contrato de Trabajo N° 20.744.";

// 2. Verificamos si el formulario fue enviado
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // --- PROCESAR DATOS ---
    
    // Obtenemos el texto modificado del textarea
    $contrato_modificado = $_POST['contrato'];
    
    // Preparamos el resultado
    // nl2br() es clave: convierte los saltos de línea (\n) en etiquetas <br>
    // htmlspecialchars() es por seguridad, para que el navegador muestre el texto tal cual.
    $contrato_finalizado = "<h2>Contrato Finalizado</h2>" . 
                            nl2br(htmlspecialchars($contrato_modificado));
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Formulario de Contrato</title>
</head>
<body>
    <h2>Complete el Contrato</h2>
    <p>Edite el siguiente texto, reemplazando los puntos [...] </p>
    
    <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="POST">
        
        <textarea name="contrato" rows="12" cols="80"><?php echo htmlspecialchars($contrato_base); ?></textarea>
        <br><br>
        
        <input type="submit" value="Finalizar Contrato">
    </form>

    <hr>
    
    <?php
    // 3. Mostramos el contrato finalizado si ya se envió 
    echo $contrato_finalizado;
    ?>
</body>
</html>
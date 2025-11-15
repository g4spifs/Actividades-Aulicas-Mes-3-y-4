<?php

// --- 1. PROCESAMIENTO DE $_GET ---

// Inicializamos la variable de saludo.
$saludo_get = "¡Bienvenido al Perfilador!"; // Mensaje por defecto

/*
 * Concepto Clave: Superglobal $_GET
 * $_GET es un array asociativo que contiene variables pasadas al script
 * a través de la URL (query string).
 */
if (isset($_GET['saludo']) && !empty($_GET['saludo'])) {
    /*
     * Usamos htmlspecialchars() para "sanitizar" la entrada.
     * Esto convierte caracteres especiales (como <, >) en sus entidades HTML
     * (&lt;, &gt;). Esto evita que un usuario pueda inyectar código HTML
     * o JavaScript malicioso en nuestra página.
     */
    $saludo_get = htmlspecialchars($_GET['saludo']);
}

// --- 2. PROCESAMIENTO DE $_POST ---

// Inicializamos las variables que usaremos para la tarjeta.
$nombre = "";
$edad = 0;
$hobby = "";
$mensaje_edad = "";
$mostrar_tarjeta = false; // Un "flag" para saber si mostrar la tarjeta o no

/*
 * Concepto Clave: Superglobal $_POST
 * $_POST es un array asociativo que contiene variables pasadas al script
 * a través del cuerpo de una petición HTTP (típicamente desde un formulario
 * que usa method="POST").
 *
 * Verificamos si el método de la petición es POST.
 */
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // Verificamos que las variables esperadas existan y no estén vacías.
    if (isset($_POST['nombre']) && isset($_POST['edad']) && isset($_POST['hobby']) &&
        !empty($_POST['nombre']) && !empty($_POST['edad']) && !empty($_POST['hobby'])) {

        // Si todo está bien, procesamos los datos.
        $mostrar_tarjeta = true;

        // Sanitizamos TODAS las entradas del usuario.
        $nombre = htmlspecialchars($_POST['nombre']);
        $hobby = htmlspecialchars($_POST['hobby']);
        
        // Para la edad, es mejor convertirla a un entero.
        // Esto también es una forma de sanitización.
        $edad = (int)$_POST['edad'];

        /*
         * Concepto Clave: Estructuras de Control (if/else)
         * Aplicamos la lógica de negocio para determinar el tipo de perfil
         * basado en la edad.
         */
        if ($edad >= 40) {
            $mensaje_edad = "Perfil Senior";
        } else if ($edad >= 18) {
            $mensaje_edad = "Perfil en Desarrollo";
        } else {
            $mensaje_edad = "Perfil Junior";
        }

    } else {

        $mostrar_tarjeta = false;
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Perfilador PHP</title>
    <!-- Estilos CSS integrados para un solo archivo -->
    <style>
        body {
            font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, Helvetica, Arial, sans-serif;
            background-color: #f0f2f5;
            color: #333;
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            padding: 20px;
            box-sizing: border-box;
        }
        .container {
            width: 100%;
            max-width: 500px;
            background-color: #ffffff;
            border-radius: 12px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
            padding: 2rem;
        }
        h1, h2 {
            text-align: center;
            color: #1d4ed8;
        }
        
        /* Saludo de GET */
        .saludo-get {
            text-align: center;
            font-size: 1.1rem;
            font-style: italic;
            color: #555;
            background-color: #eef2ff;
            padding: 10px;
            border-radius: 8px;
            border-left: 4px solid #1d4ed8;
        }
        .saludo-get small {
            display: block;
            font-style: normal;
            font-size: 0.8rem;
            color: #777;
            margin-top: 5px;
        }

        /* Formulario */
        form {
            display: flex;
            flex-direction: column;
            gap: 1.2rem;
            margin-top: 1.5rem;
        }
        .form-group {
            display: flex;
            flex-direction: column;
        }
        .form-group label {
            font-weight: 600;
            margin-bottom: 0.5rem;
        }
        .form-group input[type="text"],
        .form-group input[type="number"] {
            padding: 12px;
            border: 1px solid #d1d5db;
            border-radius: 8px;
            font-size: 1rem;
            transition: border-color 0.2s, box-shadow 0.2s;
        }
        .form-group input:focus {
            outline: none;
            border-color: #1d4ed8;
            box-shadow: 0 0 0 3px rgba(29, 78, 216, 0.2);
        }
        button {
            background-color: #1d4ed8;
            color: white;
            padding: 14px;
            border: none;
            border-radius: 8px;
            font-size: 1rem;
            font-weight: 600;
            cursor: pointer;
            transition: background-color 0.2s;
        }
        button:hover {
            background-color: #1e40af;
        }

        /* Tarjeta de Perfil */
        .tarjeta-perfil {
            margin-top: 2rem;
            border: 1px solid #e5e7eb;
            border-radius: 12px;
            background-color: #f9fafb;
            padding: 1.5rem;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.05);
            animation: fadeIn 0.5s ease-out;
        }
        .tarjeta-perfil h2 {
            margin-top: 0;
            color: #166534;
        }
        .tarjeta-perfil p {
            font-size: 1.1rem;
            line-height: 1.6;
            border-bottom: 1px dashed #d1d5db;
            padding-bottom: 10px;
        }
        .tarjeta-perfil p:last-child {
            border-bottom: none;
            padding-bottom: 0;
        }
        .tarjeta-perfil strong {
            color: #374151;
        }
        
        /* Animación para la tarjeta */
        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(10px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }
    </style>
</head>
<body>

    <div class="container">
        <h1>Perfilador PHP</h1>

        <!-- 
          SECCIÓN PARA MOSTRAR LA VARIABLE $_GET
          Usamos la variable $saludo_get que procesamos en el bloque PHP de arriba.
        -->
        <div class="saludo-get">
            <?php echo $saludo_get; ?>
            <small>(Prueba a cambiar la URL añadiendo: ?saludo=Hola+Mundo)</small>
        </div>

        <!-- 
          FORMULARIO HTML
          - action="perfilador.php": Envía los datos a este mismo archivo.
          - method="POST": Envía los datos de forma oculta en el cuerpo de la petición.
        -->
        <form action="perfilador.php" method="POST">
            <h2>Generador de Perfil</h2>
            <div class="form-group">
                <label for="nombre">Nombre:</label>
                <input type="text" id="nombre" name="nombre" placeholder="Ej. Ana Suárez" required>
            </div>
            
            <div class="form-group">
                <label for="edad">Edad:</label>
                <input type="number" id="edad" name="edad" placeholder="Ej. 30" required>
            </div>

            <div class="form-group">
                <label for="hobby">Hobby:</label>
                <input type="text" id="hobby" name="hobby" placeholder="Ej. Leer ciencia ficción" required>
            </div>

            <button type="submit">Generar Perfil</button>
        </form>

        <!-- 
          SECCIÓN DE RESULTADO DINÁMICO (LA TARJETA)
          
          Este bloque HTML solo se renderizará si nuestra variable PHP $mostrar_tarjeta
          es 'true' (es decir, si el formulario se envió correctamente).
        -->
        <?php if ($mostrar_tarjeta): ?>
        
            <div class="tarjeta-perfil">
                <h2>Tarjeta de Presentación</h2>
                
                <!-- 
                  Usamos "echo" para imprimir el valor de nuestras variables PHP 
                  (ya sanitizadas) directamente en el HTML.
                -->
                <p><strong>Nombre:</strong> <?php echo $nombre; ?></p>
                <p><strong>Edad:</strong> <?php echo $edad; ?> años</p>
                <p><strong>Hobby:</strong> <?php echo $hobby; ?></p>
                <p><strong>Clasificación:</strong> <?img src="https://placehold.co/100x50/166534/white?text=<?php echo urlencode($mensaje_edad); ?>" alt="Clasificación de perfil" style="float: right; border-radius: 5px; margin-left: 10px;"><?php echo $mensaje_edad; ?></p>
            </div>

        <?php endif; ?>

    </div> 

</body>
</html>
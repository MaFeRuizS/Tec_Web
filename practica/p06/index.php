<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Práctica 6</title>
</head>
<body>
    <h2>Ejercicio 1</h2>
    <p>Escribir programa para comprobar si un número es un múltiplo de 5 y 7</p>
    <?php
        require_once __DIR__.'/scr/funciones.php';
        if(isset($_GET['numero']))
        {
            es_multiplo7y5($_GET['numero']);
        }
    

    echo '<h2>Ejercicio 2</h2>';
    echo '<p>Crea un programa para la generación repetitiva de 3 números aleatorios hasta obtener una
    secuencia compuesta por: impar, par, impar.</p>';
    echo '<p>Estos números deben almacenarse en una matriz de Mx3, donde M es el número de filas y
    3 el número de columnas. Al final muestra el número de iteraciones y la cantidad de
    números generados:  n números obtenidos en x iteraciones</p>';
	
    // Llamamos a la función
    $resultado = gen_repetitiva();

    // Verificación antes de mostrar el resultado
    if (!empty($resultado) && isset($resultado['matriz']) && is_array($resultado['matriz']) && count($resultado['matriz']) > 0) {
        echo "<h3>Secuencias generadas:</h3>";

        // Mostrar todas las secuencias generadas
        foreach ($resultado['matriz'] as $fila) {
            echo "<p>" . implode(", ", $fila) . "</p>";
        }

        echo "<p><strong>{$resultado['totalNumeros']} números obtenidos en {$resultado['iteraciones']} iteraciones</strong></p>";
    } else {
        echo "<p style='color:red;'>Error: No se generó la secuencia correctamente.</p>";
    }

    echo '<h2>Ejercicio 3</h2>';
    echo '<p>Utiliza un ciclo while para encontrar el primer número entero obtenido aleatoriamente,
    pero que además sea múltiplo de un número dado.<br>
    • Crear una variante de este script utilizando el ciclo do-while.<br>
    • El número dado se debe obtener vía GET.</p>';

    if(isset($_GET['numero3']))
        {
          echo num_aleatorio($_GET['numero3']);
        }
    else {
        echo "<p style='color:red;'>Error: Debes proporcionar un número válido en la URL (Ejemplo: ?numero3=7)</p>";
    }

    echo '<h3>Usando Do-While</h3>';
    if(isset($_GET['numero3']))
        {
            ale_do_while($_GET['numero3']);
        }


    echo '<h2>Ejercicio 4</h2>';
    echo '<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tabla ASCII</title>
    <style>
        table {
            width: 30%;
            border-collapse: collapse;
            margin: 20px;
            text-align: center;
        }
        th, td {
            border: 1px solid black;
            padding: 8px;
        }
        th {
            background-color: #ddd;
        }
    </style>
</head>
<body>
    <h2>Tabla de caracteres ASCII</h2>';

// Llamar a la función para mostrar la tabla
echo generarTablaASCII();

echo '</body>';
    ?>
    
    <!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ejercicio 5 - Validación de Edad y Sexo</title>
</head>
<body>
    <h2>Ejercicio 5</h2>
    <p>Usar las variables $edad y $sexo en una instrucción if para identificar una persona de sexo “femenino”, cuya edad oscile entre los 18 y 35 años y mostrar un mensaje de bienvenida apropiado. <br>En caso contrario, deberá devolverse otro mensaje indicando el error.</p>
    
    <h3>Ingrese sus datos</h3>
    <form action="index.php" method="POST">
        <label for="edad">Edad:</label>
        <input type="number" name="edad" required min="1"><br>

        <label for="sexo">Sexo:</label>
        <select name="sexo" required>
            <option value="">Seleccione...</option>
            <option value="femenino">Femenino</option>
            <option value="masculino">Masculino</option>
        </select><br>
        <br>
        <button type="submit">Enviar</button>
    </form>

    <?php
        // Verificar si se enviaron los datos por POST
        if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["edad"]) && isset($_POST["sexo"])) {
            $edad = intval($_POST["edad"]);
            $sexo = strtolower($_POST["sexo"]);

            // Mostrar los valores ingresados
            echo "<br><strong>Edad ingresada:</strong> $edad";
            echo "<br><strong>Sexo ingresado:</strong> $sexo";

            // Llamar a la función de validación
            $mensaje = validar_Edad_Sexo($edad, $sexo);
        } else {
            $mensaje = "No se han enviado datos. Por favor, complete el formulario.";
        }
    ?>

    <h3>Resultado de Validación</h3>
    <p class="mensaje"><?php echo $mensaje; ?></p>
</body>
</html>

        <h2>Ejercicio 6</h2>
    <p>Crea en código duro un arreglo asociativo que sirva para registrar el parque vehicular de
    una ciudad.</p>

    <?php
$matriculaConsultada = isset($_POST['matricula']) ? strtoupper($_POST['matricula']) : null;
$vehiculo = $matriculaConsultada ? obtenerVehiculos($matriculaConsultada) : null;
$vehiculos = !$matriculaConsultada ? obtenerVehiculos() : null;

?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro de Parque Vehicular</title>
    <style>
        table {
            width: 100%;
            border-collapse: collapse;
        }
        th, td {
            padding: 10px;
            border: 1px solid #ddd;
        }
        th {
            background-color: #f2f2f2;
        }
        .mensaje {
            color: red;
        }
    </style>
</head>
<body>

    <h1>Consulta del Parque Vehicular</h1>

    <!-- Formulario de consulta por matrícula -->
    <h3>Consultar por matrícula</h3>
    <form method="POST" action="index.php">
        <label for="matricula">Matrícula del auto:</label>
        <input type="text" name="matricula" required pattern="[A-Z]{3}[0-9]{4}" maxlength="7">
        <button type="submit">Consultar</button>
    </form>

    <!-- Mostrar los resultados -->
    <?php if ($vehiculo): ?>
        <h3>Información del Vehículo</h3>
        <pre><?php print_r($vehiculo); ?></pre>
    <?php elseif ($matriculaConsultada): ?>
        <p class="mensaje">Lo siento, la matrícula no existe o no está registrada.</p>
    <?php endif; ?>

    <!-- Formulario para mostrar todos los vehículos -->
    <h3>Consultar Todos los Vehículos Registrados</h3>
    <form method="POST" action="index.php">
        <button type="submit">Mostrar Todos</button>
    </form>

    <!-- Mostrar todos los vehículos registrados -->
    <?php if ($vehiculos): ?>
        <h3>Vehículos Registrados</h3>
        <pre><?php print_r($vehiculos); ?></pre>
    <?php endif; ?>

</body>
</html>



    <h2>Ejemplo de POST</h2>
    <form action="http://localhost/tecweb/practicas/p04/index.php" method="post">
        Name: <input type="text" name="name"><br>
        E-mail: <input type="text" name="email"><br>
        <input type="submit">
    </form>
    <br>
    <?php
        if(isset($_POST["name"]) && isset($_POST["email"]))
        {
            echo $_POST["name"];
            echo '<br>';
            echo $_POST["email"];
        }
    ?>
</body>
</html>
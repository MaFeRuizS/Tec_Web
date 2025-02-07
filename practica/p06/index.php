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
    
    ?>


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
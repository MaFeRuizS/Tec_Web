<?php
function es_multiplo7y5($num){

    $num = $_GET['numero'];
            if ($num%5==0 && $num%7==0)
            {
                echo '<h3>R= El número '.$num.' SÍ es múltiplo de 5 y 7.</h3>';
            }
            else
            {
                echo '<h3>R= El número '.$num.' NO es múltiplo de 5 y 7.</h3>';
            }
}

function gen_repetitiva(){
    // Inicialización de variables
    $matriz = [];
    $iteraciones = 0;
    $totalNumeros = 0;

    while(true){
        // Generar 3 números aleatorios entre 100 y 999
        $num1 = rand(100, 999);
        $num2 = rand(100, 999);
        $num3 = rand(100, 999);

        // Contar los números generados
        $totalNumeros += 3;
        $iteraciones++;

        // Almacenar cada intento en la matriz
        $matriz[] = [$num1, $num2, $num3];

        // Verificar si cumplen con la secuencia impar, par, impar
        if ($num1 % 2 != 0 && $num2 % 2 == 0 && $num3 % 2 != 0) {
            break; // Salimos del bucle cuando encontramos la secuencia correcta
        }
    }

    return [
        'matriz' => $matriz,
        'iteraciones' => $iteraciones,
        'totalNumeros' => $totalNumeros
    ];
}

function num_aleatorio($num3) {
    if (!is_numeric($num3) || $num3 <= 0) {
        return "<p style='color:red;'>Error: El número debe ser un valor numérico mayor a 0.</p>";
    }

    $iteraciones = 0;

    while (true) {
        $num1 = rand(1, 1000); 
        $iteraciones++;
        if ($num1 % $num3 == 0) {
            return "<h4>El primer múltiplo encontrado aleatoriamente de $num3 es: $num1 </h4>
                   <h4>$iteraciones iteraciones.</h4>";
        }
    }
}

function ale_do_while($num4){
    $iteraciones = 0;

    if (!is_numeric($num4) || $num4 <= 0) {
        return "<p style='color:red;'>Error: El número debe ser un valor numérico mayor a 0.</p>";
    }
    
    do {
        $num5 = rand(1, 1000); // Generar un número aleatorio
        $iteraciones++;
    } while ($num5 % $num4 !== 0);

    echo "<h4>El primer múltiplo encontrado aleatoriamente de $num4 es: $num5 <br></h4>";
    echo "<h4>$iteraciones iteraciones.</h4>";

}


?>

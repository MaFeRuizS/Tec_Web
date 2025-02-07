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

function generarTablaASCII() {
    // Crear el arreglo con índices de 97 a 122 y valores de 'a' a 'z'
    $arreglo = [];
    for ($i = 97; $i <= 122; $i++) {
        $arreglo[$i] = chr($i);
    }

    // Generar la tabla en XHTML
    $tabla = '<table>
                <tr>
                    <th>Índice (Código ASCII)</th>
                    <th>Valor (Letra)</th>
                </tr>';
    
    foreach ($arreglo as $key => $value) {
        $tabla .= "<tr><td>$key</td><td>$value</td></tr>";
    }

    $tabla .= '</table>';
    return $tabla;
}

 function validar_Edad_Sexo($edad, $sexo) {
    if ($sexo === "femenino" && $edad >= 18 && $edad <= 35) {
        return "Bienvenida, usted está en el rango de edad permitido.";
    } else {
        return "Lo sentimos, no cumple con la edad necesaria o el sexo seleccionado.";
    }
}

function obtenerVehiculos($matricula = null) {
    // Arreglo asociativo con los datos del parque vehicular
    $vehiculos = [
        "UBN6338" => [
            "Auto" => [
                "marca" => "HONDA",
                "modelo" => 2020,
                "tipo" => "camioneta"
            ],
            "Propietario" => [
                "nombre" => "Alfonzo Esparza",
                "ciudad" => "Puebla, Pue.",
                "direccion" => "C.U., Jardines de San Manuel"
            ]
        ],
        "UBN6339" => [
            "Auto" => [
                "marca" => "MAZDA",
                "modelo" => 2019,
                "tipo" => "sedan"
            ],
            "Propietario" => [
                "nombre" => "Ma. del Consuelo Molina",
                "ciudad" => "Puebla, Pue.",
                "direccion" => "97 oriente"
            ]
        ],
        // Más registros de autos aquí...
        "XRT5678" => [
            "Auto" => [
                "marca" => "TOYOTA",
                "modelo" => 2021,
                "tipo" => "camioneta"
            ],
            "Propietario" => [
                "nombre" => "Carlos Martínez",
                "ciudad" => "Atlixco, Pue.",
                "direccion" => "Avenida 5, Zona Centro"
            ]
        ],
        "BRL2345" => [
            "Auto" => [
                "marca" => "FORD",
                "modelo" => 2022,
                "tipo" => "hatchback"
            ],
            "Propietario" => [
                "nombre" => "Laura Gómez",
                "ciudad" => "Cholula, Pue.",
                "direccion" => "Boulevard 2, San Andrés"
            ]
        ]
        // Agrega más autos según lo necesites
    ];

    // Si se pasa una matrícula específica, se devuelve solo ese auto
    if ($matricula && isset($vehiculos[$matricula])) {
        return $vehiculos[$matricula];
    }

    // Si no se pasa matrícula, se devuelve todos los autos registrados
    return $vehiculos;
}

?>

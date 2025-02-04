<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.1//EN" "http://www.w3.org/TR/xhtml11/DTD/xhtml11.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="es">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <title>Práctica 3</title>
</head>
<body>
    <h2>Ejercicio 1</h2>
    <p>Determina cuál de las siguientes variables son válidas y explica por qué:</p>
    <p>$_myvar,  $_7var,  myvar,  $myvar,  $var7,  $_element1, $house*5</p>
    <?php
        //AQUI VA MI CÓDIGO PHP
        $_myvar;
        $_7var;
        //myvar;       // Inválida
        $myvar;
        $var7;
        $_element1;
        //$house*5;     // Invalida
        
        echo '<h4>Respuesta:</h4>';   
    
        echo '<ul>';
        echo '<li>$_myvar es válida porque inicia con guión bajo.</li>';
        echo '<li>$_7var es válida porque inicia con guión bajo.</li>';
        echo '<li>myvar es inválida porque no tiene el signo de dolar ($).</li>';
        echo '<li>$myvar es válida porque inicia con una letra.</li>';
        echo '<li>$var7 es válida porque inicia con una letra.</li>';
        echo '<li>$_element1 es válida porque inicia con guión bajo.</li>';
        echo '<li>$house*5 es inválida porque el símbolo * no está permitido.</li>';
        echo '</ul>';
    ?>

    <h2>Ejercicio 2</h2>
    <p>Proporcionar los valores de $a, $b, $c como sigue:</p>
    <p>$a = “ManejadorSQL”;</p>
    <p>$b = 'MySQL'; </p>
    <p>$c = &$a; </p>
    <?php
        $a = "ManejadorSQL";
        $b = 'MySQL';  
        $c = &$a; 

        echo '<ol>';
        echo '<li> Ahora muestra el contenido de cada variable: </li>';
        echo "$a";
        echo '<br>';
        echo "$b";
        echo '<br>';
        echo "$c";
        echo '<li> Agrega al código actual las siguientes asignaciones: </li>';
        echo '$a = “PHP server”; ';
        echo ' $b = &$a;';
        
        $a = "PHP server";
        $b = &$a;

        echo '<li> Vuelve a mostrar el contenido </li>';
        echo "$a";
        echo '<br>';
        echo "$b";

        echo '<li>Describe en y muestra en la página obtenida qué ocurrió en el segundo bloque de asignaciones</li>';
        echo '</ol>';

        echo '<h4>Respuesta: </h4>';
        echo '$a ahora contiene "PHP server".';
        echo '<br>';
        echo '$b se vuelve referencia de $a, por lo que también almacena "PHP server".';
    ?>

    <h2>Ejercicio 3</h2>
    <p>Muestra el contenido de cada variable inmediatamente después de cada asignación,
    verificar la evolución del tipo de estas variables (imprime todos los componentes de los
    arreglo):</p>

    <?php
    
    echo '<h4>Respuesta:</h4>';
        $a = "PHP5";
        echo "$a";
        echo '<br>';

        $z[] = &$a;
        print_r($z);
        echo '<br>';

        $b = "5a version de PHP";
        echo "$b";
        echo '<br>';

        $c = intval($b) *10;
        echo "$c";
        echo '<br>';

        $a .= $b;
        echo "$a";
        echo '<br>';

        $b = intval($b); // Convierte a número antes de la multiplicación
        $b *= $c;
        echo "$b";
        echo '<br>';
        
        $z[0] = "MySQL";  
        print_r ($z);  

        /* Resultado en PHP TESTER con el mismo código:
        PHP5
        Array ( [0] => PHP5 )
        5a version de PHP
        50
        PHP55a version de PHP
        250
        Array ( [0] => MySQL )
        */
    ?>

    <h2>Ejercicio 4</h2>
    <p>Lee y muestra los valores de las variables del ejercicio anterior, pero ahora con la ayuda de
    la matriz $GLOBALS o del modificador global de PHP.</p>
    
    <?php    
    $a = "PHP5";
    $z[] = &$a;
    $b = "5a version de PHP";
    $c = intval($b) * 10;
    $a .= $b;
    $b = intval($b);
    $b *= $c;
    $z[0] = "MySQL";
        function mostrarValores(){

            echo 'Valor de \$a: '. $GLOBALS['a'] . "<br>";
            echo 'Valor de \$b: ' . $GLOBALS['b'] . "<br>";
            echo 'Valor de \$c: ' . $GLOBALS['c'] . "<br>";
    
            echo 'Contenido de \$z: ';
            print_r($GLOBALS['z']);
            echo "<br>";
        }                
        // Llamamos a la función para mostrar los valores
        
        echo '<h4>Respuesta:</h4>';
        mostrarValores();
        
        /*Resultado en PHP TESTER con el mismo código:
        Valor de \$a: MySQL
        Valor de \$b: 250
        Valor de \$c: 50
        Contenido de \$z: Array ( [0] => MySQL )
        */
    ?>
    <h2>Ejercicio 5</h2>
    <p>Dar el valor de las variables $a, $b, $c al final del siguiente script:<br>
    $a = “7 personas”;<br>
    $b = (integer) $a;<br>
    $a = “9E3”;<br>
    $c = (double) $a;</p>

    <?php
    
    echo '<h4>Respuesta:</h4>';
    $a = "7 personas";
    echo "$a";
    echo '<br>';
    $b = (integer) $a;
    echo "$b";
    echo '<br>';
    $a = "9E3";
    echo "$a";
    echo '<br>';
    $c = (double) $a;
    echo "$c";
    echo '<br>';   
    ?>

    <h2>Ejercicio 6</h2>
        <p>Dar y comprobar el valor booleano de las variables $a, $b, $c, $d, $e y $f y muéstralas
        usando la función var_dump(<datos>):<br>
        Después investiga una función de PHP que permita transformar el valor booleano de $c y $e
        en uno que se pueda mostrar con un echo:
        <br>
        $a = “0”; <br>
        $b = “TRUE”;<br>
        $c = FALSE;<br>
        $d = ($a OR $b);<br>
        $e = ($a AND $c);<br>
        $f = ($a XOR $b);
        </p>

        <?php
        $a = "0"; 
        $b = "TRUE";
        $c = FALSE;
        $d = ($a OR $b);
        $e = ($a AND $c);
        $f = ($a XOR $b);

        echo '<h4>Respuesta:</h4>';
        var_dump($a);
        echo '<br>';
        var_dump($b);
        echo '<br>';
        var_dump($c);
        echo '<br>';
        var_dump($d);
        echo '<br>';
        var_dump($e);
        echo '<br>';
        var_dump($f);

        echo '<br>';

        echo '<h5>Mostramos los valores de $c y $e con un echo: </h5>';
        echo var_export($c, true);
        echo '<br>';
        echo var_export($e, true);
        /* Resultado de PHP TESTER:
        Respuesta:
        string(1) "0"
        string(4) "TRUE"
        bool(false)
        bool(true)
        bool(false)
        bool(true) 
        
        Mostramos los valores de $c y $e con un echo:
        false
        false
        */


        ?>

</body>
</html>
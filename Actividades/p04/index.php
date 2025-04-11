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
    <p>$c = &amp;$a; </p>
    <?php
        $a = "ManejadorSQL";
        $b = 'MySQL';  
        $c = &$a; 

        echo '<div>';
        echo '<ol>';
        echo '<li> Ahora muestra el contenido de cada variable:';
            echo '<ul>';
                echo "<li>$a</li>";
                echo "<li>$b</li>";
                echo "<li>$c</li>";
            echo '</ul>';
        echo '</li>';
        echo '<li> Agrega al código actual las siguientes asignaciones: ';
        echo '$a = “PHP server”;';
        echo '$b = &amp;$a;';
        echo '</li>';
        $a = "PHP server";
        $b = &$a;

        echo '<li> Vuelve a mostrar el contenido';
            echo '<ul>';
                echo "<li>$a</li>";
                echo "<li>$b</li>";
            echo '</ul>';
        echo '</li>';
        echo '<li>Describe en y muestra en la página obtenida qué ocurrió en el segundo bloque de asignaciones</li>';
        echo '</ol>';
        echo '</div>';

        echo '<h4>Respuesta: </h4>';
        echo '<p>$a ahora contiene "PHP server".</p>';
        echo '<p>$b se vuelve referencia de $a, por lo que también almacena "PHP server".</p>';
    ?>

    <h2>Ejercicio 3</h2>
    <p>Muestra el contenido de cada variable inmediatamente después de cada asignación,
    verificar la evolución del tipo de estas variables (imprime todos los componentes de los
    arreglo):</p>

    <?php
    
    echo '<h4>Respuesta:</h4>';
        $a = "PHP5";
        echo "<p>$a</p>";

        $z[] = &$a;
        echo '<p>';
        print_r($z);
        echo '</p>';

        $b = "5a version de PHP";
        echo '<p>';
        echo "$b";
        echo '</p>';

        $c = intval($b) *10;
        echo '<p>';
        echo "$c";
        echo '</p>';

        $a .= $b;
        echo '<p>';
        echo "$a";
        echo '</p>';

        $b = intval($b); // Convierte a número antes de la multiplicación
        $b *= $c;
        echo '<p>';
        echo "$b";
        echo '</p>';
        
        $z[0] = "MySQL";  
        echo '<p>';
        print_r ($z);  
        echo '</p>';
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
            echo '<div>';
            echo '<p>Valor de \$a: '. $GLOBALS['a']. '</p>';
            echo '<p>Valor de \$b: ' . $GLOBALS['b'] . '</p>';
            echo '<p>Valor de \$c: ' . $GLOBALS['c'] . '</p>';
    
            echo '<p>Contenido de \$z: ';
            print_r($GLOBALS['z']);
            echo '</p>';
            echo '</div>';
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
    <p>Dar el valor de las variables $a, $b, $c al final del siguiente script:</p>
    <p>$a = “7 personas”;</p>
    <p>$b = (integer) $a;</p>
    <p>$a = “9E3”;</p>
    <p>$c = (double) $a;</p>

    <?php
    
    echo '<h4>Respuesta:</h4>';
    $a = "7 personas";
    echo "<div>$a";
    echo '<br />';
    $b = (integer) $a;
    echo "$b";
    echo '<br />';
    $a = "9E3";
    echo "$a";
    echo '<br />';
    $c = (double) $a;
    echo "$c";
    echo '<br />';  
    echo '</div>'; 
    ?>

    <h2>Ejercicio 6</h2>
        <p>Dar y comprobar el valor booleano de las variables $a, $b, $c, $d, $e y $f y muéstralas
        usando la función var_dump():<br />
        Después investiga una función de PHP que permita transformar el valor booleano de $c y $e
        en uno que se pueda mostrar con un echo:
        <br />
        $a = “0”; <br />
        $b = “TRUE”;<br />
        $c = FALSE;<br />
        $d = ($a OR $b);<br />
        $e = ($a AND $c);<br />
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
        echo '<div>';
        var_dump($a);
        echo '<br />';
        var_dump($b);
        echo '<br />';
        var_dump($c);
        echo '<br />';
        var_dump($d);
        echo '<br />';
        var_dump($e);
        echo '<br />';
        var_dump($f);
        echo '</div>';
       
        echo '<h5>Mostramos los valores de $c y $e con un echo: </h5>';
        echo '<div>';
        echo var_export($c, true);
        echo '<br />';
        echo var_export($e, true);
        echo '</div>';
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

        <h2>Ejercicio 7</h2>
        <p>Usando la variable predefinida $_SERVER, determina lo siguiente:<br />
            a. La versión de Apache y PHP,<br />
            b. El nombre del sistema operativo (servidor),<br />
            c. El idioma del navegador (cliente).
        </p>

        <?php

        echo '<h4>Respuesta:</h4>';
        echo '<div>';
        echo $_SERVER['SERVER_SOFTWARE'];
        echo '<br />';
        echo PHP_OS;
        echo '<br />';
        echo $_SERVER['HTTP_ACCEPT_LANGUAGE'];
        echo '</div>';
        ?>

    <p>
        <a href="https://validator.w3.org/markup/check?uri=referer"><img
        src="https://www.w3.org/Icons/valid-xhtml11" alt="Valid XHTML 1.1" height="31" width="88" /></a>
    </p>
  

</body>
</html>
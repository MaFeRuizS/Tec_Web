<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
   "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" lang="en" xml:lang="en">
	<head>
		<meta http-equiv="content-type" content="text/html;charset=utf-8" />
		<title>Registro Completado</title>
		<style type="text/css">
			body {margin: 20px; 
			background-color:rgb(205, 153, 251);
			font-family: Verdana, Helvetica, sans-serif;
			font-size: 90%;}
			h1 {color:rgb(99, 45, 165);
			border-bottom: 1px solid rgb(99, 45, 165);}
			h2 {font-size: 1.2em;
			color:rgb(46, 0, 74);}
		</style>
	</head>
	<body>
    <?php

/** SE CREA EL OBJETO DE CONEXION */
@$link = new mysqli('localhost', 'root', '12345678a', 'marketzone');	

/** comprobar la conexión */
if ($link->connect_errno) {
    die('Falló la conexión: '.$link->connect_error.'<br/>');
}

/** Asignar variables de $_POST */
$nombre = $_POST['name'];
$marca  = $_POST['marca'];
$modelo = $_POST['modelo'];
$precio = $_POST['precio'];
$detalles = $_POST['story'];
$unidades = $_POST['unidades'];
$imagen   = 'img/'.$_POST['img'];
$eliminado = 0;

$sql_check = "SELECT id FROM productos WHERE nombre = ? and marca = ? and modelo = ?";
            $stm_check = $link->prepare($sql_check); 
            $stm_check->bind_param("sss", $nombre, $marca, $modelo); 
            $stm_check->execute(); 
            $stm_check->store_result(); 
            if ($stm_check->num_rows > 0) {
                die("<h1>Error. La base de datos ya contiene un producto con el nombre $nombre de la marca $marca.</h1>");
            }
            $stm_check->close();

            /** Crear una tabla que no devuelve un conjunto de resultados */
            //$sql = "INSERT INTO productos VALUES (null, '{$nombre}', '{$marca}', '{$modelo}', {$precio}, '{$detalles}', {$unidades}, '{$imagen}', 0)";
            //Utilizando column names 
            $sql = "INSERT INTO productos (nombre, marca, modelo, precio, detalles, unidades, imagen) 
                  VALUES ('{$nombre}', '{$marca}', '{$modelo}', {$precio}, '{$detalles}', {$unidades}, '{$imagen}')";

            if ( $link->query($sql) ) 
            {
                echo '<p>Producto insertado con ID: '.$link->insert_id.'</p>';
				echo '<h1>Hemos añadido tu producto</h1>';
			echo '<h2>Detalles:</h2>';
			echo '<ul>';
			echo '<li><strong>Nombre:</strong> <em>'.htmlspecialchars($nombre).'</em></li>';
			echo '<li><strong>Marca:</strong> <em>'.htmlspecialchars($marca).'</em></li>';
			echo '<li><strong>Modelo:</strong> <em>'.htmlspecialchars($modelo).'</em></li>';
			echo '<li><strong>Precio:</strong> <em>'.htmlspecialchars($precio).'</em></li>';
			echo '<li><strong>Unidades:</strong> <em>'.htmlspecialchars($unidades).'</em></li>';
			echo '<li><strong>Detalles:</strong> <em>'.htmlspecialchars($detalles).'</em></li>';
			echo '<li><strong>Imagen:</strong> <em>'.htmlspecialchars($imagen).'</em></li>';
			echo '</ul>';


            }
            else
            {
                echo '<p>El Producto no pudo ser insertado =(</p>';
            }

            $link->close();
        ?>
	</body>
</html>
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

/** comprobar la conexión */
if ($link->connect_errno) {
    die('Falló la conexión: '.$link->connect_error.'<br/>');
}

/** Asignar variables de $_POST */
$nombre = $_POST['name'];
$marca  = $_POST['marca'];
$modelo = $_POST['modelo'];
$precio = $_POST['precio'];
$detalles = $_POST['story'];
$unidades = $_POST['unidades'];
$imagen   = 'img/'.$_POST['img'];

/** Verificar si el producto ya existe */
$sql_check = "SELECT COUNT(*) FROM productos WHERE nombre = ? AND marca = ? AND modelo = ?";
$stmt = $link->prepare($sql_check);
$stmt->bind_param("sss", $nombre, $marca, $modelo);
$stmt->execute();
$stmt->bind_result($count);
$stmt->fetch();
$stmt->close();

if ($count > 0) {
    echo '<p>Error: El producto ya está registrado en la base de datos.</p>';
} else {
    $sql = "INSERT INTO productos (nombre, marca, modelo, precio, detalles, unidades, imagen) 
            VALUES (?, ?, ?, ?, ?, ?, ?)";
    $stmt = $link->prepare($sql);
    $stmt->bind_param("sssdsis", $nombre, $marca, $modelo, $precio, $detalles, $unidades, $imagen);
    
    if ($stmt->execute()) {
        echo '<h1>Hemos añadido tu producto</h1>';
		echo '<h2>Detalles:</h2>';
		echo '<ul>';
		echo '<li><string>ID:</strong <em>'.$link->insert_id.'</em></li>';
		echo '<li><strong>Nombre:</strong> <em>'.htmlspecialchars($nombre).'</em></li>';
		echo '<li><strong>Marca:</strong> <em>'.htmlspecialchars($marca).'</em></li>';
		echo '<li><strong>Modelo:</strong> <em>'.htmlspecialchars($modelo).'</em></li>';
        echo '<li><strong>Precio:</strong> <em>'.htmlspecialchars($precio).'</em></li>';
        echo '<li><strong>Unidades:</strong> <em>'.htmlspecialchars($unidades).'</em></li>';
        echo '<li><strong>Detalles:</strong> <em>'.htmlspecialchars($detalles).'</em></li>';
        echo '<li><strong>Imagen:</strong> <em>'.htmlspecialchars($imagen).'</em></li>';
		echo '</ul>';
		echo '<li><string>Eliminamos (0=False, 1=True):</strong <em>'. $link->insert_Eliminado.'</em></li>'; 
    } else {
        echo '<h2>Error al insertar el producto.</h2>';
    }
    $stmt->close();
}

?>
	</body>
</html>

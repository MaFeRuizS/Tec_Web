
<?php 
    // Conectar a la base de datos 
    $link = new mysqli('localhost', 'root', '12345678a', 'marketzone'); 
	
    // Verificar la conexión 
    if($link->connect_errno){
        die("No fue posible establecer conexión con la base de datos. " . $link->connect_error);
    }

    // Verificar el envío del ID 
    if(!isset($_POST['id']) || !is_numeric($_POST['id'])){
        die("ID de producto no válido");
    }

    $id = intval($_POST['id']);
    $nombre = $_POST['name'];
    $marca = $_POST['marca'];
    $modelo = $_POST['modelo'];
    $detalles = $_POST['story']; 
    $precio = $_POST['precio'];
    $unidades = $_POST['unidades'];
	$imagen = "img/imagendefecto.webp"; // Imagen por defecto

	// Manejo de imagen 
    if(!empty($_FILES['img']['name'])){
        $imagen = 'img/'.basename($_FILES['img']['name']); 
        move_uploaded_file($_FILES['img']['tmp_name'], $imagen);
    } elseif(isset($_POST['imagendefecto'])) { 
        $imagen = $_POST['imagendefecto']; 
    }
	
    // Consulta de actualización 
    $sql = "UPDATE productos SET nombre = ?, marca = ?, modelo = ?, detalles = ?, precio = ?, unidades = ?, imagen = ? WHERE id = ?";
    
    $stmt = $link->prepare($sql);
    $stmt->bind_param("ssssdisi", $nombre, $marca, $modelo, $detalles, $precio, $unidades, $imagen, $id); 

    // Ejecutar actualización 
    if($stmt->execute()){
        echo "<p>Producto actualizado exitosamente</p>"; 
    } else {
        die("No fue posible actualizar el producto: " . $stmt->error); 
    }

    $stmt->close(); 
    $link->close(); 

    echo '<button type="button" class="btn btn-info" style="background-color: #0dcaf0; border-color: #0dcaf0; color: white; margin-right: 10px" onclick="window.location.href=\'get_productos_xhtml_v2.php\'">Ver productos en XHTML</button>';
    echo '<button type="button" class="btn btn-info" style="background-color: #0dcaf0; border-color: #0dcaf0; color: white; margin-right: 10px;" onclick="window.location.href=\'get_productos_vigentes_v2.php\'">Ver productos Vigentes</button>';

?>
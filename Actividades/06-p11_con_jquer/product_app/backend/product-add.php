<?php
include_once __DIR__.'/database.php';

$data = array(
    'status'  => 'error',
    'message' => 'La consulta falló'
);

// Verificar si los datos están presentes
if( isset($_POST['nombre']) && isset($_POST['precio']) && isset($_POST['unidades']) && isset($_POST['modelo']) && isset($_POST['marca']) && isset($_POST['detalles']) ) {
    $nombre = trim($_POST['nombre']);
    $precio = trim($_POST['precio']);
    $unidades = trim($_POST['unidades']);
    $modelo = trim($_POST['modelo']);
    $marca = trim($_POST['marca']);
    $detalles = trim($_POST['detalles']);
    $imagen = $_POST['imagen'];  // Imagen puede ser opcional

    // Validar campos obligatorios
    if (empty($nombre) || empty($precio) || empty($unidades) || empty($modelo) || empty($marca) || empty($detalles)) {
        $data['message'] = "ERROR: Todos los campos son obligatorios.";
    } elseif (!is_numeric($precio) || $precio <= 0) {
        $data['message'] = "ERROR: El precio debe ser un número positivo.";
    } elseif (!is_numeric($unidades) || $unidades <= 0) {
        $data['message'] = "ERROR: Las unidades deben ser un número positivo.";
    } else {
        // Validación de que el producto no exista
        $sql = "SELECT * FROM productos WHERE nombre = '{$nombre}' AND eliminado = 0";
        $result = $conexion->query($sql);

        if ($result->num_rows == 0) {
            // Sentencia preparada para la inserción
            $sql = "INSERT INTO productos (nombre, marca, modelo, precio, detalles, unidades, imagen, eliminado) 
                    VALUES (?, ?, ?, ?, ?, ?, ?, 0)";
            $stmt = $conexion->prepare($sql);
            $stmt->bind_param("ssssdis", $nombre, $marca, $modelo, $precio, $detalles, $unidades, $imagen);

            if ($stmt->execute()) {
                $data['status'] = "success";
                $data['message'] = "Producto agregado";
            } else {
                $data['message'] = "ERROR: No se ejecutó la consulta. " . $stmt->error;
            }
            $stmt->close();
        } else {
            $data['message'] = "ERROR: Ya existe un producto con ese nombre.";
        }
        $result->free();
    }
    $conexion->close();
}

echo json_encode($data, JSON_PRETTY_PRINT);
?>

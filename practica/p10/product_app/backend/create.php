<?php
    include_once __DIR__.'/database.php';

    // SE OBTIENE LA INFORMACIÓN DEL PRODUCTO ENVIADA POR EL CLIENTE
    $producto = file_get_contents('php://input');
    if (!empty($producto)) {
        // SE TRANSFORMA EL STRING DEL JSON A OBJETO
        $jsonOBJ = json_decode($producto);
    
        // VALIDACIÓN DE CAMPOS OBLIGATORIOS
        if (isset($jsonOBJ->nombre, $jsonOBJ->marca, $jsonOBJ->modelo, $jsonOBJ->precio, $jsonOBJ->unidades, $jsonOBJ->detalles)) {
            // SE EVITAN INYECCIONES SQL ESCAPANDO LOS DATOS
            $nombre = strtolower(trim($conexion->real_escape_string($jsonOBJ->nombre)));
            $marca = strtolower(trim($conexion->real_escape_string($jsonOBJ->marca)));
            $modelo = strtolower(trim($conexion->real_escape_string($jsonOBJ->modelo)));
            $precio = $conexion->real_escape_string($jsonOBJ->precio);
            $unidades = $conexion->real_escape_string($jsonOBJ->unidades);
            $detalles = $conexion->real_escape_string($jsonOBJ->detalles);
            $imagen = $conexion->real_escape_string($jsonOBJ->imagen);
            
            // VALIDAR SI EL PRODUCTO YA EXISTE (ELIMINADO = 0)
            $consulta_validacion = "SELECT id, nombre, marca, modelo 
                        FROM productos 
                        WHERE ((LOWER(nombre) = LOWER('$nombre') 
                        AND LOWER(marca) = LOWER('$marca')) 
                        OR (LOWER(marca) = LOWER('$marca') 
                        AND LOWER(modelo) = LOWER('$modelo'))) 
                        AND eliminado = 0";
    
            $resultado = $conexion->query($consulta_validacion);
            
            // Checking if the product exists
            if ($resultado->num_rows > 0) {
                echo json_encode(["mensaje" => "El producto ya existe en la base de datos."]);
            } else {
                // INSERTAR NUEVO PRODUCTO
                $consulta_insercion = "INSERT INTO productos (nombre, marca, modelo, precio, unidades, detalles, imagen, eliminado) 
                       VALUES ('$nombre', '$marca', '$modelo', '$precio', '$unidades', '$detalles', '$imagen', 0)";
                
                if ($conexion->query($consulta_insercion)) {
                    echo json_encode(["mensaje" => "Producto agregado exitosamente."]);
                } else {
                    echo json_encode(["mensaje" => "Error al agregar el producto: " . $conexion->error]);
                }
            }
        } else {
            echo json_encode(["mensaje" => "Faltan campos obligatorios en el JSON."]);
        }
    
        $conexion->close();
    } else {
        echo json_encode(["mensaje" => "No se recibió información del producto."]);
    }
?>

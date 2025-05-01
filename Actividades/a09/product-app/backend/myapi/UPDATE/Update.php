<?php
    namespace TECWEB\MYAPI\UPDATE;
    use TECWEB\MYAPI\DataBase as Database; 
    
    class Update extends DataBase{
        
        public function edit($data) {
            $this->data = $data;
        
            // Validar que los datos requeridos existen
            if (!isset($data['id'], $data['nombre'], $data['precio'], $data['unidades'], $data['modelo'], $data['marca'], $data['detalles'], $data['imagen'])) {
                $this->data = ["status" => "error", "message" => "Datos incompletos o inválidos."];
                return;
            }
        
            // Extraer datos
            $id = $data['id'];
            $nombre = $data['nombre'];
            $precio = $data['precio'];
            $unidades = $data['unidades'];
            $modelo = $data['modelo'];
            $marca = $data['marca'];
            $detalles = $data['detalles'];
            $imagen = $data['imagen'];
        
            // Preparar la consulta
            $sql = "UPDATE productos SET nombre = ?, precio = ?, unidades = ?, modelo = ?, marca = ?, detalles = ?, imagen = ? WHERE id = ?";
            if ($stmt = $this->conexion->prepare($sql)) {
                $stmt->bind_param('sdissssi', $nombre, $precio, $unidades, $modelo, $marca, $detalles, $imagen, $id);
        
                if ($stmt->execute()) {
                    if ($stmt->affected_rows > 0) {
                        $this->data = ["status" => "success", "message" => "Producto actualizado correctamente."];
                    } else {
                        $this->data = ["status" => "error", "message" => "No se actualizó el producto. Verifica el ID o los datos."];
                    }
                } else {
                    $this->data = ["status" => "error", "message" => "Error al ejecutar la consulta: " . $stmt->error];
                }
        
                $stmt->close();
            } else {
                $this->data = ["status" => "error", "message" => "Error preparando la consulta: " . $this->conexion->error];
            }
        
            $this->conexion->close();
        }
        
    }
?>
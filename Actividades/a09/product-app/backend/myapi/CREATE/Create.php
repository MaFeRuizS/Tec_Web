<?php

namespace TECWEB\MYAPI\CREATE; 
use TECWEB\MYAPI\DataBase as Database; 

class Create extends Database {

    public function add($prod) {
        $this->data = array(
            'status'  => 'error',
            'message' => 'Datos no válidos o producto duplicado'
        );
    
        // Validación: asegurarse de que se recibieron todos los campos
        if (
            isset($prod['nombre']) && isset($prod['marca']) && isset($prod['modelo']) &&
            isset($prod['precio']) && isset($prod['detalles']) &&
            isset($prod['unidades']) && isset($prod['imagen'])
        ) {
            $this->conexion->set_charset("utf8");
    
            // Comprobar si ya existe un producto con ese nombre
            $nombre = $this->conexion->real_escape_string($prod['nombre']);
            $sqlCheck = "SELECT * FROM productos WHERE nombre = '$nombre' AND eliminado = 0";
            $result = $this->conexion->query($sqlCheck);
    
            if ($result && $result->num_rows == 0) {
                // Preparar valores para inserción
                $marca    = $this->conexion->real_escape_string($prod['marca']);
                $modelo   = $this->conexion->real_escape_string($prod['modelo']);
                $precio   = (float)$prod['precio'];
                $detalles = $this->conexion->real_escape_string($prod['detalles']);
                $unidades = (int)$prod['unidades'];
                $imagen   = $this->conexion->real_escape_string($prod['imagen']);
    
                // Consulta de inserción
                $sqlInsert = "INSERT INTO productos VALUES (null, '$nombre', '$marca', '$modelo', $precio, '$detalles', $unidades, '$imagen', 0)";
                if ($this->conexion->query($sqlInsert)) {
                    $this->data['status'] = "success";
                    $this->data['message'] = "Producto agregado correctamente";
                } else {
                    $this->data['message'] = "Error al insertar: " . $this->conexion->error;
                }
            } elseif ($result) {
                $this->data['message'] = "Ya existe un producto con ese nombre.";
                $result->free();
            }
    
            $this->conexion->close();
        } else {
            $this->data['message'] = "Campos requeridos incompletos o inválidos.";
        }
    }
    
}
?>

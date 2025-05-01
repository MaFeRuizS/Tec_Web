<?php
namespace TECWEB\MYAPI\DELETE;
use TECWEB\MYAPI\DataBase as Database;

class Delete extends Database {
    public function __construct($db){ 
        $this->data = array(); 
        parent::__construct($db); 
    }

    public function delete($id) {
        $this->data = [
            'status'  => 'error',
            'message' => 'ID no válido o consulta fallida'
        ];

        // Validar que el ID sea numérico
        if (is_numeric($id)) {
            $sql = "UPDATE productos SET eliminado = 1 WHERE id = ?";
            $stmt = $this->conexion->prepare($sql);
            $stmt->bind_param('i', $id);

            if ($stmt->execute()) {
                if ($stmt->affected_rows > 0) {
                    $this->data['status'] = "success";
                    $this->data['message'] = "Producto eliminado correctamente.";
                } else {
                    $this->data['message'] = "No se encontró producto con ese ID.";
                }
            } else {
                $this->data['message'] = "Error al ejecutar la consulta: " . $stmt->error;
            }

            $stmt->close();
        }

        $this->conexion->close();
    }
}
?>

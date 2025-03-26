<?php
namespace TECWEB\MYAPI;

use TECWEB\MYAPI\Database as Database;
require_once __DIR__ . '/database.php';

class Products extends Database {
    private $data = NULL;
    public function __construct($user='root', $pass='12345678a', $db){
        $this->data = array();
        parent::__construct($user, $pass, $db);
    }

    public function list() {
        /** SE CREA EL ARREGLO QUE SE VA A DEVOLVER EN FORMA D3E JSON*/ 
        $this->data = array();
        /** SE REALIZA LA QUERY DE BÚSQUEDA Y AL MISMO TIEMPO SE VALIDA SI HUBO RESULTADO */
        if( $result = $this->conexion->query("SELECT * FROM productos WHERE eliminado = 0") ){
            /** SE OBTIENEN LOS RESULTADOS */
            $rows = $result->fetch_all(MYSQLI_ASSOC);
            if(!is_null($rows)) {
                /** SE CODIFICAN A UTF-9 LOS DATOS Y SE MAPEAN AL ARREGLO DE RESPUESTA */
                foreach($rows as $num => $rows) {
                    foreach($rows as $key => $value) {
                        $this->data[$num][$key] = $value;
                    }
                }
            }
            $result->free();
        } else {
            die('Query Error: '.mysqli_error($this->conexion));
        }
        $this->conexion->close();
    }

    public function getData() {
        return json_encode($this->data, JSON_PRETTY_PRINT);
    }
}
?>
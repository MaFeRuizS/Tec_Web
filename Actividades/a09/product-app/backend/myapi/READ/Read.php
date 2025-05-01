<?php
    namespace TECWEB\MYAPI\READ;
    use TECWEB\MYAPI\DataBase as Database; 

    Class Read extends DataBase{

        public function __construct($db){ 
            $this->data = array(); 
            parent::__construct($db); 
        }

        public function list(){
            //CREAMOS EL ARREGLO A DEVOLVERSE EN FORMA JSON
            $this->data=array(); 

            //Query de búsqueda y validación de resultados 
            if($result = $this->conexion->query("SELECT * FROM productos WHERE eliminado = 0")){

                //obtenemos resultados
                $rows = $result->fetch_all(MYSQLI_ASSOC); 
                if(!is_null($rows)){
                    //codificación a UTF-8 de datos y mapeo al arreglo de respuesta
                    foreach($rows as $num => $row){
                        foreach($row as $key => $value){
                            $this ->data[$num][$key]=$value; 
                        }
                    }
                }
                $result->free(); 
            } else{
                die('Query Error: '.mysqli_error($this->conexion)); 
            }
            //$this->conexion->close(); 
        }

        public function search($search){
            $this->data = array();
            
            if ($search) {
                // Debug: Ver la consulta generada
                //echo "Consulta: SELECT * FROM productos WHERE (id = '{$search}' OR nombre LIKE '%{$search}%' OR marca LIKE '%{$search}%' OR detalles LIKE '%{$search}%') AND eliminado = 0";
                
                $sql = "SELECT * FROM productos WHERE (id = '{$search}' OR nombre LIKE '%{$search}%' OR marca LIKE '%{$search}%' OR detalles LIKE '%{$search}%') AND eliminado = 0";
                if ($result = $this->conexion->query($sql)) {
                    $rows = $result->fetch_all(MYSQLI_ASSOC);
                    
                    if (!is_null($rows)) {
                        foreach ($rows as $num => $row) {
                            foreach ($row as $key => $value) {
                                $this->data[$num][$key] = utf8_encode($value);
                            }
                        }
                    }
                    $result->free();
                } else {
                    die('Query Error: ' . mysqli_error($this->conexion));
                }
            }
            $this->conexion->close();
        }
        

        public function single($id){
            $this->data = array();
        
            // Validar que el ID sea numérico
            if (is_numeric($id)) {
                // Query para obtener el producto por ID
                $sql = "SELECT * FROM productos WHERE id = {$id} AND eliminado = 0";
                if ($result = $this->conexion->query($sql)) {
                    $row = $result->fetch_assoc();
                    if (!is_null($row)) {
                        foreach($row as $key => $value) {
                            $this->data[$key] = utf8_encode($value);
                        }
                    }
                    $result->free();
                } else {
                    die('Query Error: '.mysqli_error($this->conexion));
                }
            }
            $this->conexion->close();
        }
        

        public function singleByName($name){
            $this->data = []; 

            if($name){
                if($stmt = $this->conexion->prepare("SELECT * FROM productos WHERE nombre = ? AND eliminado = 0")){
                    $stmt->bind_param("s", $name); 
                    if($stmt->execute()){
                        $result = $stmt->get_result(); 
                        $this->data=$result->fetch_assoc() ?? []; 
                    }
                    $stmt->close(); 
                }
            }
            $this->conexion->close(); 

        }
    }
?>
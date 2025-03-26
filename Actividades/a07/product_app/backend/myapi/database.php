<?php
namespace TECWEB\MYAPI;

abstract class Database {
    protected $conexion;

    public function __construct($user, $pass, $db){
        $this->conexion = @mysqli_connect(
            'localhost',
            $user,
            $pass,
            $db
        );

        // Verifica si la conexión falló
        if(!$this->conexion) {  
            die('¡Base de datos NO conectada! Error: ' . mysqli_connect_error());
        }
    }
}
?>

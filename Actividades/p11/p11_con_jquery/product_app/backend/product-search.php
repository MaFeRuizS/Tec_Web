<?php
    include_once __DIR__.'/database.php';

    $search = $_GET['search'];

    if(!empty($search)){
        $query = "SELECT * FROM productos Where (id = '{$search}' OR nombre LIKE '%{$search}%' OR marca LIKE '%{$search}%' OR detalles LIKE '%{$search}%') AND eliminado = 0";
        $result = mysqli_query($conexion, $query);
        if(!$result){
            die('Query Error'.mysqli_error($conexion));
        }

        $json = array();
        while($row = mysqli_fetch_array($result)){
            $json[] = array(
                'name' => $row['nombre'],
                'description' => $row['detalles'],
                'id' => $row['id']
            );
        }
        $jsonstring = json_encode($json);
        echo $jsonstring;

    }
?>
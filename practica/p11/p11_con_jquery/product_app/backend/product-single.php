<?php
    include('database.php');

    $ID = $_POST['id'];
    $query = "SELECT * FROM productos WHERE id = $ID";
    $result = mysqli_query($conexion, $query);
    if(!$result){
        die('Query Failed');
    }

    $json = array();
    while($row = mysqli_fetch_array($result)){
        $json[] = array(
            'id' => $row['id'],
            'name' => $row['nombre'],            
            'marca' => $row['marca'],
            'modelo' => $row['modelo'],
            'precio' => $row['precio'],
            'description' => $row['detalles'],
            'unidades' => $row['unidades'],
            'img' => $row['imagen']        
        );
    };

    $jsonstring = json_encode($json[0]);
    echo $jsonstring;
?>
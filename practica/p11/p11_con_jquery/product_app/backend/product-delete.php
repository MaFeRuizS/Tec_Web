<?php
    include_once __DIR__.'/database.php';

    // SE CREA EL ARREGLO QUE SE VA A DEVOLVER EN FORMA DE JSON
    $data = array(
        'status'  => 'error',
        'message' => 'La consulta falló'
    );
    // SE VERIFICA HABER RECIBIDO EL ID
    if( isset($_POST['id']) ) {
        $id = $_POST['id'];
        // SE REALIZA LA QUERY DE BÚSQUEDA Y AL MISMO TIEMPO SE VALIDA SI HUBO RESULTADOS
        $sql = "UPDATE productos SET eliminado=1 WHERE id = {$id}";
        if ( $conexion->query($sql) ) {
            $data['status'] =  "success";
            $data['message'] =  "Producto eliminado";
		} else {
            $data['message'] = "ERROR: No se ejecuto $sql. " . mysqli_error($conexion);
        }
		$conexion->close();
    } 
    
    // SE HACE LA CONVERSIÓN DE ARRAY A JSON
    echo json_encode($data, JSON_PRETTY_PRINT);
    /*

    include('database.php');
    // SE CREA EL ARREGLO QUE SE VA A DEVOLVER EN FORMA DE JSON
    $data = array(
        'status'  => 'error',
        'message' => 'La consulta falló'
    );

    if (isset($_POST['id']) && !empty($_POST['id'])) {
        $id = intval($_POST['id']); // Convertimos a número entero para mayor seguridad

        $query = "UPDATE productos SET Eliminado=1 WHERE id = $id";
        $result = mysqli_query($conexion, $query);

        if (!$result) {
            $data['message'] = "ERROR: No se ejecuto $query. " . mysqli_error($conexion);
            //die('Error en la consulta: ' . mysqli_error($conexion));
        } else {
            $data['status'] =  "success";
        $data['message'] =  "Producto eliminado";
        }
        $conexion->close();
    }
    // SE HACE LA CONVERSIÓN DE ARRAY A JSON
    echo json_encode($data, JSON_PRETTY_PRINT);*/
?>
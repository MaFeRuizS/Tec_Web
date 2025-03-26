<?php
       
use TECWEB\MYAPI\Products as Products;
require_once __DIR__.'/myapi/Products.php';

try {
    $prodObj = new Products('root', '12345678a', 'marketzone');
    $prodObj->list();

    // Verificar si se obtuvieron productos
    if (empty($prodObj->getData())) {
        echo json_encode(['error' => 'No se encontraron productos.']);
    } else {
        // Enviar la respuesta JSON
        header('Content-Type: application/json');
        echo json_encode($prodObj->getData());
    }
} catch (Exception $e) {
    // Si hay un error en la conexión o en la ejecución, enviar un error JSON
    echo json_encode(['error' => 'Hubo un problema al procesar la solicitud: ' . $e->getMessage()]);
}

?>
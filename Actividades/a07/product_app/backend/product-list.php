<?php
    use TECWEB\MYAPI\Products as Products;
    require_once __DIR__ . '/myapi/products.php';

    $prodObj = new Products('marketzone');
    $prodObj->list();

    echo $prodObj->getData();
?>
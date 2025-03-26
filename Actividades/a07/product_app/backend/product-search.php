<?php
        use TECWEB\MYAPI\Products as Products;
    require_once './myapi/Products.php';

    $prodObj = new Products('root', '12345678a', 'marketzone'); 

    if(!empty($search)){
        $prodObj->search($search); 
    }
    else{
        $prodObj->singleByName($search); 
    }
    
    echo json_encode ($prodObj->getData()); 
?>
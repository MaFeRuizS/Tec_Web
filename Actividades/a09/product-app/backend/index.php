<?php
    use Psr\Http\Message\ResponseInterface as Response; 
    use Psr\Http\Message\ServerRequestInterface as Request; 
    use Slim\Factory\AppFactory;

    require_once __DIR__ . '/vendor/autoload.php';

    use TECWEB\MYAPI\CREATE\Create; 
    use TECWEB\MYAPI\READ\Read;
    use TECWEB\MYAPI\DELETE\Delete;
    use TECWEB\MYAPI\UPDATE\Update;

    $app = AppFactory::create(); 
    $app->setBasePath("/tec_web/actividades/a09/product-app/backend"); 

    // Middleware para permitir CORS
    $app->add(function (Request $request, $handler): Response {
        $response = $handler->handle($request);
        return $response
            ->withHeader('Access-Control-Allow-Origin', '*')
            ->withHeader('Access-Control-Allow-Headers', 'Content-Type')
            ->withHeader('Access-Control-Allow-Methods', 'GET, POST, PUT, DELETE, OPTIONS');
    });

    // Soporte a preflight de CORS
    $app->options('/{routes:.+}', function (Request $request, Response $response) {
        return $response;
    });

    // Agregar producto
    $app->post('/product', function(Request $request, Response $response){
        $data = json_decode($request->getBody()->getContents(), true); 
    
        $prodObj = new Create('marketzone');
        $prodObj->add($data); // Aquí le pasas los datos al método add()
        $response->getBody()->write(json_encode($prodObj->getData()));
        return $response->withHeader('Content-Type', 'application/json');
    });
    

    // Eliminar producto
    $app->delete('/product/{id}', function(Request $request, Response $response, array $args){
        $prodObj = new Delete('marketzone'); 
        $prodObj->delete($args['id']);
        $response->getBody()->write(json_encode($prodObj->getData())); 
        return $response->withHeader('Content-Type', 'application/json');
    });

    // Listar productos
    $app->get('/products', function(Request $request, Response $response){
        $prodObj = new Read('marketzone'); 
        $prodObj->list(); 
        $response->getBody()->write(json_encode($prodObj->getData()));
        return $response->withHeader('Content-Type', 'application/json');
    });

    // Buscar producto por ID
    $app->get('/product/{id}', function(Request $request, Response $response, array $args){
        $prodObj = new Read('marketzone');
        $prodObj->single($args['id']);  // Usar 'single' en lugar de 'search'
        $response->getBody()->write(json_encode($prodObj->getData()));
        return $response->withHeader('Content-Type', 'application/json');
    });

    $app->get('/product/search/{search}', function(Request $request, Response $response, array $args){
        // Debug: Ver el parámetro de búsqueda
        var_dump($args['search']);
        
        $prodObj = new Read('marketzone');
        $prodObj->search($args['search']);
        $response->getBody()->write(json_encode($prodObj->getData()));
        return $response->withHeader('Content-Type', 'application/json');
    });
    
    // Editar producto
    $app->put('/product/{id}', function(Request $request, Response $response){
        $data = json_decode($request->getBody()->getContents(), true);
    
        $prodObj = new Update('marketzone'); 
        $prodObj->edit($data);
    
        $response->getBody()->write(json_encode($prodObj->getData()));
        return $response->withHeader('Content-Type', 'application/json');
    });
    

    $app->run();
?>

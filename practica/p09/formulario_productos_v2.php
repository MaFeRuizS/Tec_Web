<!DOCTYPE html >
<html>

  <head>
    <meta charset="utf-8" >
    <title>Registro de productos</title>
    <style type="text/css">
      ol, ul { 
      list-style-type: none;
      }
      .error-message {
        color: red; /* Cambia el color de los errores a rojo */
        font-size: 12px; /* Opcional: ajusta el tamaño del texto */
        font-weight: bold; /* Opcional: hacer el texto en negrita */
        display: none; /* Los mensajes de error no se muestran por defecto */
      }
    </style>

  </head>

  <body>
  <?php
        $product = null;
        if (isset($_GET['id']) && is_numeric($_GET['id'])) {
            $id = $_GET['id'];
        
            @$link = new mysqli('localhost', 'root', '12345678a', 'marketzone');
            if ($link->connect_errno) {
                die('Falló la conexión: '.$link->connect_error);
            }
        
            // Obtener los datos del producto
            $stmt = $link->prepare("SELECT * FROM productos WHERE id = ? AND eliminado = 0");
            $stmt->bind_param("i", $id);
            $stmt->execute();
            $result = $stmt->get_result();
            $product = $result->fetch_assoc();
        
            $stmt->close();
            $link->close();
        }

        if (!$product) {
            header("Location: get_productos_vigentes_v2.php?error=ProductoNoEncontrado");
            exit();
        }
    ?>
    <h1>Registro de Productos Nuevos</h1>
        <h2>Añade la información necesaria del producto:</h2>
       <!-- action="http://localhost/tec_web/practica/p08/set_producto_v2.php" --> 
       <form id="formularioproductos" action="http://localhost/tec_web/practica/p09/update_productos.php" method="post" enctype="multipart/form-data"> 
        <input type="hidden" name="id" value="<?= isset($product['id']) ? htmlspecialchars($product['id']) : '' ?>">
      
      <fieldset>
        <legend>Información Descriptiva:</legend>

        <ul>
          <li><label for="form-name">Nombre del producto:</label><input type="text" name="name" id="form-nombre" value="<?= isset($product) ? $product['nombre'] : ''?>"></li><div id="error1" class="error-message"></div>

          <li><p id="form-marca"> Marca del producto:  
            <select name="marca" size="1">
            <option>Opciones</option>
            <option value="Funko" <?= isset($product) && $product['marca'] == 'Funko' ? 'selected' : '' ?>>Funko!</option>
            <option value="Disney" <?= isset($product) && $product['marca'] == 'Disney' ? 'selected' : '' ?>>Disney</option>
            <option value="Pop Mart" <?= isset($product) && $product['marca'] == 'Pop Mart' ? 'selected' : '' ?>>Pop Mart</option>
            <option value="LEGO" <?= isset($product) && $product['marca'] == 'LEGO' ? 'selected' : '' ?>>LEGO</option>
            <option value="Jada Toys" <?= isset($product) && $product['marca'] == 'Jada Toys' ? 'selected' : '' ?>>Jada Toys</option>
            </select>
        </p>
        <div id="error2" class="error-message"></div>
        </li>

          <li><label for="form-modelo">Modelo del producto:</label> <input type="text" name="modelo" id="form-modelo" value="<?= isset($product) ? $product['modelo'] : ''?>"></li><div id="error3" class="error-message"></div>
          <li><label for="form-descp">Ingresa las principales características del producto:</label><br><textarea name="story" rows="4" cols="60" id="form-descp" placeholder="No más de 250 caracteres de longitud"><?= isset($product) ? $product['detalles'] : '' ?></textarea></li><div id="error5" class="error-message"></div>
        </ul>
      </fieldset>

      <fieldset>
        <legend>Otros detalles.</legend>

        <fieldset>
          <legend><em>Precio del producto</em>:</legend>
            <ul>
                <li><label for="form-precio">Precio al público:</label> <input type="text" name="precio" id="form-precio" value="<?= isset($product) ? $product['precio'] : '' ?>"></li><div id="error4" class="error-message"></div>        
            </ul>
        </fieldset>

        <fieldset>
          <legend>Unidades disponibles</legend>
          <ul>
            <li><label for="form-unidades">Unidades:</label> <input type="number" name="unidades" id="form-unidades" value="<?= isset($product) ? $product['unidades'] : '' ?>"></li><div id="error6" class="error-message"></div>
          </ul>
        </fieldset>

        <fieldset>
            <legend>Imagen del producto:</legend>
              <ul>
                  <li><label for="form-imagen">Imagen a cargar:</label> <input type="file" name="img" id="form-imagen" value="<?= isset($product) ? $product['imagen'] : 'img/imagendefecto.webp' ?>"></li><div id="error7" class="error-message"></div>         
              </ul>
          </fieldset>

      </fieldset>

      <p>
      <input type="submit" value="Modificar producto" id= "enviar">
        <input type="reset">
      </p>

    </form>
    <script src="validaciones.js"></script>
  </body>
</html>
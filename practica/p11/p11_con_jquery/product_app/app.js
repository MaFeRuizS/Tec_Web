/* JSON BASE A MOSTRAR EN FORMULARIO
var baseJSON = {
    "precio": 0.0,
    "unidades": 1,
    "modelo": "XX-000",
    "marca": "NA",
    "detalles": "NA",
    "imagen": "img/default.png"
  };*/

/*function init() {
    
     * Convierte el JSON a string para poder mostrarlo
     * ver: https://developer.mozilla.org/es/docs/Web/JavaScript/Reference/Global_Objects/JSON
     
    var JsonString = JSON.stringify(baseJSON,null,2);
    document.getElementById("description").value = JsonString;

    // SE LISTAN TODOS LOS PRODUCTOS
    listarProductos();
}*/

$(document).ready(function() {
    console.log('JQuery is working');
    $('#product-result').hide();

    $('#search').keyup(function(e) {
        if($('#search').val()){
            let search = $('#search').val();
        $.ajax({
            url: './backend/product-search.php',
            type: 'POST',
            data: { search },
            success: function (response) {
                console.log("Respuesta del servidor:", response); // Depuración
                let productos;
                try {
                    productos = JSON.parse(response); // Si el servidor responde como JSON
                    console.log("Productos procesados:", productos); // Verifica la estructura de productos
                } catch (error) {
                    console.error("Error al parsear JSON:", error);
                    return;
                }
            
                // Verifica si hay productos
                if (productos.length === 0) {
                    $('#container').html('<li>No se encontraron resultados</li>');
                } else {
                    let template = '';
                    productos.forEach(producto => {
                        // Verifica si el nombre del producto existe
                        console.log("Producto: ", producto.name);
                        template += `<li>${producto.name}</li>`;
                    });
                    $('#container').html(template); // Inserta el contenido en el contenedor
                    console.log($('#container').html()); // Verifica el contenido actualizado

                }
            
                // Asegúrate de que el contenedor de resultados se haga visible
                $('#product-result').removeClass('d-none').css('display', 'block');; // Muestra los resultados
                console.log("Contenedor de resultados visible");
            }  
        })
        }
    });

    $('#product-form').submit(function(e){
        const postData = {
            name: $('#name').val(),
            description: $('#description').val()
        };
        $.post('./backend/product-add.php', postData, function(respose){
            console.log(respose);
        });
        e.preventDefault();
    });
});



  





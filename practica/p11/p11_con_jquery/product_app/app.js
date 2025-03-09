// JSON BASE A MOSTRAR EN FORMULARIO
var baseJSON = {
    "precio": 0.0,
    "unidades": 1,
    "modelo": "XX-000",
    "marca": "NA",
    "detalles": "NA",
    "imagen": "img/default.png"
  };

function init() {
    /**
     * Convierte el JSON a string para poder mostrarlo
     * ver: https://developer.mozilla.org/es/docs/Web/JavaScript/Reference/Global_Objects/JSON
     */
    var JsonString = JSON.stringify(baseJSON,null,2);
    document.getElementById("description").value = JsonString;

    // SE LISTAN TODOS LOS PRODUCTOS
    //listarProductos();
}

let edit = false;
$(document).ready(function () {
    console.log("JQuery is working");
    $("#product-result").hide();
    fetch_products();

    // Búsqueda en tiempo real
    $("#search").keyup(function () {
        let search = $("#search").val().trim();
        if (search) {
            $.ajax({
                url: "./backend/product-search.php",
                type: "POST",
                data: { search },
                success: function (response) {
                    let productos;
                    try {
                        productos = JSON.parse(response);
                    } catch (error) {
                        console.error("Error al parsear JSON:", error);
                        return;
                    }

                    let template = '';
                    if (productos.length === 0) {
                        template = '<li>No se encontraron resultados</li>';
                    } else {
                        productos.forEach(producto => {
                            template += `
                                <li>${producto.name}</li>
                                <p>Detalles: ${producto.description}</p>`;
                        });
                    }
                    $('#container').html(template);
                    $('#product-result').removeClass('d-none').css('display', 'block');
                }
            });
        }
    });

    //Agregar producto
    $("#product-form").submit(function (e) {
        // Evitar que el formulario se envíe automáticamente
        e.preventDefault();
        
        let productoJsonString = $("#description").val();
        let finalJSON = JSON.parse(productoJsonString);
        finalJSON['nombre'] = $("#name").val();
        finalJSON['id'] = $("#productId").val(); // Agregar el ID del producto al JSON
        const postData = {
            name: $('#name').val(),
            description: $('#description').val(),
            id: $('#productId').val()
        };
    
        // Validaciones
        let mensajeError = "";
        if (!finalJSON['nombre'].trim() || finalJSON['nombre'].length > 100) {
            mensajeError = "El nombre del producto es obligatorio y debe tener menos de 100 caracteres.";
        } else if (finalJSON['marca'].length > 25) {
            mensajeError = "La marca no debe exceder los 25 caracteres.";
        } else if (finalJSON['modelo'].length > 25) {
            mensajeError = "El modelo no debe exceder los 25 caracteres.";
        } else if (finalJSON['detalles'].length > 250) {
            mensajeError = "La descripción no debe exceder los 250 caracteres.";
        } else if (finalJSON['precio'] <= 0) {
            mensajeError = "El precio debe ser mayor a 0.";
        } else if (finalJSON['unidades'] < 1) {
            mensajeError = "Debe haber al menos una unidad.";
        }
    
        if (mensajeError) {
            // Mostrar el mensaje de error y mantener el formulario visible
            $("#container").html(`<li style="list-style: none;">${mensajeError}</li>`);
            $("#product-result").removeClass("d-none").css('display', 'block');
            
            // No resetear el formulario aquí, mantener los valores actuales
            return;
        }
    
        // Si la validación es exitosa, proceder con la solicitud POST
        let url = edit ? "./backend/product-edit.php" : "./backend/product-add.php";  // Dependiendo si es edición o no
        console.log(url);
        $.post(url, postData, function(response){
            console.log(response);
            fetch_products();  // Actualizar la lista de productos
        });
    
        // Realizar la solicitud AJAX con los datos JSON
        $.ajax({
            url: url,
            type: "POST",
            contentType: "application/json",
            data: JSON.stringify(finalJSON),
            success: function (response) {
                let respuesta = JSON.parse(response);
                let template_bar = `
                    <li style="list-style: none;">status: ${respuesta.status}</li>
                    <li style="list-style: none;">message: ${respuesta.message}</li>
                `;
                $("#container").html(template_bar);
                $("#product-result").addClass("d-block"); // Mostrar el mensaje de éxito
    
                // Restablecer el formulario solo si la validación es exitosa
                $("#description").val(JSON.stringify(baseJSON, null, 2));  // Restablecer el campo de descripción
                $("#name").val('');
                $("#productId").val('');
    
                fetch_products();
            }
        });
    });
    
    

    // Obtener productos
    function fetch_products() {
        $.ajax({
            url: './backend/product-list.php',
            type: 'GET',
            success: function (response) {
                //console.log("Respuesta del servidor:", response);
                let productos;
                try {
                    productos = JSON.parse(response);
                } catch (error) {
                    console.error("Error al parsear JSON:", error);
                    return;
                }
    
                let template = '';
                productos.forEach(producto => {
                    template += `
                        <tr productID="${producto.id}">
                            <td>${producto.id}</td>
                            <td>
                                <a href="#" class="product-item">${producto.nombre}</a>
                            </td>
                            <td>${producto.detalles}</td>  
                            <td>
                                <button class="product-delete btn btn-danger">
                                    Delete
                                </button>
                            </td>
                        </tr>`;
                });
    
                $('#products').html(template);
                console.log("Tabla actualizada con productos");
            },
            error: function (xhr, status, error) {
                console.error("Error en la petición AJAX:", error);
            }
        });
    }
    
 
    //Eliminar producto
    $(document).on('click','.product-delete', function() {
        if(confirm('¿Realmente quieres eliminar este producto?')){
            let element = $(this)[0].parentElement.parentElement;
            let id = $(element).attr('productID');
        let fila = $(`[productID="${id}"]`);
        console.log("ID del producto:", fila.find("td").eq(0).text()); // Muestra la primera celda (ID)
        $.post('./backend/product-delete.php', {id}, function(response) {
            let respuesta = JSON.parse(response);
            let template_bar = `
                    <li style="list-style: none;">status: ${respuesta.status}</li>
                    <li style="list-style: none;">message: ${respuesta.message}</li>
                `;
                $("#container").html(template_bar);
                $("#product-result").addClass("d-block"); // Mostrar el mensaje de éxito
    
                // Restablecer el formulario solo si la validación es exitosa
                $("#description").val(JSON.stringify(baseJSON, null, 2));  // Restablecer el campo de descripción
                $("#name").val('');
                $("#productId").val('');
            fetch_products();
        })
        }
    })
     //Editar producto
    $(document).on('click','.product-item', function(){
        let element = $(this)[0].parentElement.parentElement;
        let id = $(element).attr('productID'); 

        $.post('./backend/product-single.php', {id}, function(response){
            const product = JSON.parse(response);
            $('#name').val(product.name); 
            $('#description').val(JSON.stringify({
                precio: product.precio,
                unidades: product.unidades,
                modelo: product.modelo,
                marca: product.marca,
                detalles: product.description,
                imagen: product.img
            }, null, 2));
            // Guardar el ID en el campo oculto
            $("#productId").val(id);

            // Cambiar el texto del botón a "Editar Producto"
            $("#submit-btn").text("Editar Producto");

            edit = true; // Indicar que estamos en modo edición
        });
        
    });
});

function mostrarmsj(divId, mensaje) {
    let div = document.getElementById(divId);
    div.innerHTML = mensaje;
    div.style.display = "block";
}

function ocultarMensaje(divId) {
    let div = document.getElementById(divId);
    div.style.display = "none";
}

    // Validaciones individuales
    function validar_nombre() {
        let entrada = document.getElementById("form-nombre").value.trim();
        console.log("Validando nombre: ", entrada); // Añadir log
        if (entrada === "" || entrada.length > 100) {
            mostrarmsj("error1", "El campo de nombre no puede estar vacío y debe tener máximo 100 caracteres.");
            return false;
        }
        ocultarMensaje("error1");
        return true;
    }

    function validar_marca() {
        let seleccion = document.querySelector('select[name="marca"]').value;
        if (seleccion === "Opciones") {
            mostrarmsj("error2", "Por favor selecciona una marca.");
            return false;
        }
        ocultarMensaje("error2");
        return true;
    }
    

    function validar_modelo() {
        let entrada = document.getElementById("form-modelo").value.trim();
        console.log("Validando modelo: ", entrada); // Añadir log
        if (entrada === "" || entrada.length > 25) {
            mostrarmsj("error3", "El campo de modelo no puede estar vacío y debe tener máximo 25 caracteres.");
            return false;
        }
        ocultarMensaje("error3");
        return true;
    }

    function validar_precio() {
        let entrada = document.getElementById("form-precio").value.trim();
        console.log("Validando precio: ", entrada); // Añadir log
        if (entrada === "" || parseFloat(entrada) < 99.99) {
            mostrarmsj("error4", "El campo de precio no puede estar vacío y no debe ser menor de $99.99.");
            return false;
        }
        ocultarMensaje("error4");
        return true;
    }

    function validar_descrip() {
        let entrada = document.getElementById("form-descp").value.trim();

        if (entrada.length > 250) {
            mostrarmsj("error5", "El campo de descripción debe tener máximo 250 caracteres.");
            return false;
        }
        ocultarMensaje("error5");
        return true;
    }

    function validar_unidades() {
        let entrada = document.getElementById("form-unidades").value.trim();
        console.log("Validando unidades: ", entrada); // Añadir log
        if (entrada === "" || parseInt(entrada) < 0) {
            mostrarmsj("error6", "El campo de unidades no puede estar vacío y debe tener 0 o más elementos");
            return false;
        }
        ocultarMensaje("error6");
        return true;
    }

    function validar_img() {
        let inputImagen = document.getElementById("form-imagen");
        let entrada = inputImagen.value.trim();
        
        if (entrada === "") {
            mostrarmsj("error7", "Se añadirá una imagen por defecto.");
            inputImagen.value = "img/imagendefecto.webp"; // Imagen por defecto
            return false;
        }
        ocultarMensaje("error7");
        return true;
    }

    document.getElementById("formularioproductos").addEventListener("submit", function (event) {
        event.preventDefault(); // Evita que el formulario se envíe si hay errores
    
        // Ejecuta todas las validaciones y registra los resultados
        let esNombreValido = validar_nombre();
        let esMarcaValida = validar_marca();
        let esModeloValido = validar_modelo();
        let esPrecioValido = validar_precio();
        let esDescripValida = validar_descrip();
        let esUnidadesValido = validar_unidades();
        let esImagenValida = validar_img();
    
        // Si todas las validaciones son correctas, envía el formulario
        if (esNombreValido && esMarcaValida && esModeloValido && esPrecioValido && esDescripValida && esUnidadesValido && esImagenValida) {
            document.getElementById("formularioproductos").submit();
        }
    });

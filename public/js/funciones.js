
function llamarClientes() {
    $.ajax({
        url: "clientes.php",
        type: "GET",
        success: function (data) {
            $("#cuerpo").html(data);
        },
        error: function (xhr) {
            $("#cuerpo").html("<p>Error al cargar clientes: " + xhr.statusText + "</p>");
        }
    });
}

function llamarProductos() {
    $.ajax({
        url: "productos.php",
        type: "GET",
        success: function (data) {
            $("#cuerpo").html(data);
        },
        error: function (xhr) {
            $("#cuerpo").html("<p>Error al cargar productos: " + xhr.statusText + "</p>");
        }
    });
}

function toggleFormCliente() {
    if ($("#formRegistro").is(":hidden")) {
        cancelarFormCliente();
        $("#formRegistro").show();
    } else {
        $("#formRegistro").hide();
    }
}

function cancelarFormCliente() {
    $("#formRegistro").hide();
    $("#inputIdCliente").val("");
    $("#inputNombre").val("");
    $("#inputApPaterno").val("");
    $("#inputApMaterno").val("");
    $("#inputRFC").val("");
    $("#mensajeRegistro").html("");
    $("#tituloFormCliente").text("Nuevo Cliente");
    $("#btnGuardarCliente").text("Guardar").attr("onclick", "guardarCliente()");
}

function guardarCliente() {
    var nombre = $("#inputNombre").val().trim();
    var apPaterno = $("#inputApPaterno").val().trim();
    var apMaterno = $("#inputApMaterno").val().trim();
    var rfc = $("#inputRFC").val().trim();

    if (!nombre || !apPaterno || !rfc) {
        $("#mensajeRegistro").html('<div class="alert alert-danger py-1 px-2 mb-0 small">Los campos Nombre, Apellido Paterno y RFC son obligatorios.</div>');
        return;
    }

    $.ajax({
        url: "insertar_cliente.php",
        type: "POST",
        data: {
            nombre: nombre,
            apellido_paterno: apPaterno,
            apellido_materno: apMaterno,
            rfc: rfc
        },
        dataType: "json",
        success: function (data) {
            if (data.status === "ok") {
                $("#mensajeRegistro").html('<div class="alert alert-success py-1 px-2 mb-0 small">' + data.message + '</div>');
                setTimeout(function () {
                    llamarClientes();
                }, 1000);
            } else {
                $("#mensajeRegistro").html('<div class="alert alert-danger py-1 px-2 mb-0 small">' + data.message + '</div>');
            }
        },
        error: function (xhr) {
            $("#mensajeRegistro").html('<div class="alert alert-danger py-1 px-2 mb-0 small">Error de conexión: ' + xhr.statusText + '</div>');
        }
    });
}

function editarCliente(id, nombre, apPaterno, apMaterno, rfc) {
    $("#inputIdCliente").val(id);
    $("#inputNombre").val(nombre);
    $("#inputApPaterno").val(apPaterno);
    $("#inputApMaterno").val(apMaterno);
    $("#inputRFC").val(rfc);
    $("#tituloFormCliente").text("Editar Cliente #" + id);
    $("#btnGuardarCliente").text("Actualizar").attr("onclick", "actualizarCliente()");
    $("#formRegistro").show();
    $('html, body').animate({ scrollTop: $("#formRegistro").offset().top - 20 }, 300);
}

function actualizarCliente() {
    var id = $("#inputIdCliente").val();
    var nombre = $("#inputNombre").val().trim();
    var apPaterno = $("#inputApPaterno").val().trim();
    var apMaterno = $("#inputApMaterno").val().trim();
    var rfc = $("#inputRFC").val().trim();

    if (!nombre || !apPaterno || !rfc) {
        $("#mensajeRegistro").html('<div class="alert alert-danger py-1 px-2 mb-0 small">Los campos Nombre, Apellido Paterno y RFC son obligatorios.</div>');
        return;
    }

    $.ajax({
        url: "actualizar_cliente.php",
        type: "POST",
        data: {
            id_cliente: id,
            nombre: nombre,
            apellido_paterno: apPaterno,
            apellido_materno: apMaterno,
            rfc: rfc
        },
        dataType: "json",
        success: function (data) {
            if (data.status === "ok") {
                $("#mensajeRegistro").html('<div class="alert alert-success py-1 px-2 mb-0 small">' + data.message + '</div>');
                setTimeout(function () {
                    llamarClientes();
                }, 1000);
            } else {
                $("#mensajeRegistro").html('<div class="alert alert-danger py-1 px-2 mb-0 small">' + data.message + '</div>');
            }
        },
        error: function (xhr) {
            $("#mensajeRegistro").html('<div class="alert alert-danger py-1 px-2 mb-0 small">Error de conexión: ' + xhr.statusText + '</div>');
        }
    });
}

function eliminarCliente(id) {
    if (!confirm("¿Estás seguro de que deseas eliminar este cliente?")) {
        return;
    }

    $.ajax({
        url: "eliminar_cliente.php",
        type: "POST",
        data: { id_cliente: id },
        dataType: "json",
        success: function (data) {
            if (data.status === "ok") {
                llamarClientes(); // Recargar la tabla
            } else {
                alert("Error: " + data.message);
            }
        },
        error: function (xhr) {
            alert("Error de conexión: " + xhr.statusText);
        }
    });
}

// =============================================
// --- Funciones CRUD para Productos ---
// =============================================

function toggleFormProducto() {
    if ($("#formRegistroProducto").is(":hidden")) {
        cancelarFormProducto();
        $("#formRegistroProducto").show();
    } else {
        $("#formRegistroProducto").hide();
    }
}

function cancelarFormProducto() {
    $("#formRegistroProducto").hide();
    $("#inputIdProducto").val("");
    $("#inputNombreProducto").val("");
    $("#inputCantidad").val("");
    $("#inputPrecio").val("");
    $("#inputCategoria").val("");
    $("#mensajeRegistroProducto").html("");
    $("#tituloFormProducto").text("Nuevo Producto");
    $("#btnGuardarProducto").text("Guardar").attr("onclick", "guardarProducto()");
}

function guardarProducto() {
    var nombre = $("#inputNombreProducto").val().trim();
    var cantidad = $("#inputCantidad").val().trim();
    var precio = $("#inputPrecio").val().trim();
    var categoria = $("#inputCategoria").val().trim();

    if (!nombre || cantidad === "" || precio === "" || !categoria) {
        $("#mensajeRegistroProducto").html('<div class="alert alert-danger py-1 px-2 mb-0 small">Todos los campos son obligatorios.</div>');
        return;
    }

    $.ajax({
        url: "insertar_producto.php",
        type: "POST",
        data: {
            nombre: nombre,
            cantidad: cantidad,
            precio: precio,
            categoria: categoria
        },
        dataType: "json",
        success: function (data) {
            if (data.status === "ok") {
                $("#mensajeRegistroProducto").html('<div class="alert alert-success py-1 px-2 mb-0 small">' + data.message + '</div>');
                setTimeout(function () {
                    llamarProductos();
                }, 1000);
            } else {
                $("#mensajeRegistroProducto").html('<div class="alert alert-danger py-1 px-2 mb-0 small">' + data.message + '</div>');
            }
        },
        error: function (xhr) {
            $("#mensajeRegistroProducto").html('<div class="alert alert-danger py-1 px-2 mb-0 small">Error de conexión: ' + xhr.statusText + '</div>');
        }
    });
}

function editarProducto(id, nombre, cantidad, precio, categoria) {
    $("#inputIdProducto").val(id);
    $("#inputNombreProducto").val(nombre);
    $("#inputCantidad").val(cantidad);
    $("#inputPrecio").val(precio);
    $("#inputCategoria").val(categoria);
    $("#tituloFormProducto").text("Editar Producto #" + id);
    $("#btnGuardarProducto").text("Actualizar").attr("onclick", "actualizarProducto()");
    $("#formRegistroProducto").show();
    $('html, body').animate({ scrollTop: $("#formRegistroProducto").offset().top - 20 }, 300);
}

function actualizarProducto() {
    var id = $("#inputIdProducto").val();
    var nombre = $("#inputNombreProducto").val().trim();
    var cantidad = $("#inputCantidad").val().trim();
    var precio = $("#inputPrecio").val().trim();
    var categoria = $("#inputCategoria").val().trim();

    if (!nombre || cantidad === "" || precio === "" || !categoria) {
        $("#mensajeRegistroProducto").html('<div class="alert alert-danger py-1 px-2 mb-0 small">Todos los campos son obligatorios.</div>');
        return;
    }

    $.ajax({
        url: "actualizar_producto.php",
        type: "POST",
        data: {
            id: id,
            nombre: nombre,
            cantidad: cantidad,
            precio: precio,
            categoria: categoria
        },
        dataType: "json",
        success: function (data) {
            if (data.status === "ok") {
                $("#mensajeRegistroProducto").html('<div class="alert alert-success py-1 px-2 mb-0 small">' + data.message + '</div>');
                setTimeout(function () {
                    llamarProductos();
                }, 1000);
            } else {
                $("#mensajeRegistroProducto").html('<div class="alert alert-danger py-1 px-2 mb-0 small">' + data.message + '</div>');
            }
        },
        error: function (xhr) {
            $("#mensajeRegistroProducto").html('<div class="alert alert-danger py-1 px-2 mb-0 small">Error de conexión: ' + xhr.statusText + '</div>');
        }
    });
}

function eliminarProducto(id) {
    if (!confirm("¿Estás seguro de que deseas eliminar este producto?")) {
        return;
    }

    $.ajax({
        url: "eliminar_producto.php",
        type: "POST",
        data: { id: id },
        dataType: "json",
        success: function (data) {
            if (data.status === "ok") {
                llamarProductos();
            } else {
                alert("Error: " + data.message);
            }
        },
        error: function (xhr) {
            alert("Error de conexión: " + xhr.statusText);
        }
    });
}

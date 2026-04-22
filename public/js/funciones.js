// =============================================
// --- Búsqueda en tablas ---
// =============================================
function filtrarTabla(tablaId, valor) {
    var filtro = valor.toLowerCase();
    var tabla = document.getElementById(tablaId);
    if (!tabla) return;
    var filas = tabla.getElementsByTagName('tbody')[0].getElementsByTagName('tr');
    for (var i = 0; i < filas.length; i++) {
        var texto = filas[i].textContent || filas[i].innerText;
        filas[i].style.display = texto.toLowerCase().indexOf(filtro) >= 0 ? '' : 'none';
    }
}

// =============================================
// --- Sistema de Toasts ---
// =============================================
function mostrarToast(mensaje, tipo) {
    var contenedor = getToastContainer();
    var toast = document.createElement('div');
    toast.className = 'toast-item ' + (tipo === 'success' ? 'toast-success' : 'toast-error');
    toast.innerHTML = '<i class="bi bi-' + (tipo === 'success' ? 'check-circle-fill' : 'exclamation-circle-fill') + '"></i><span>' + mensaje + '</span>';
    contenedor.appendChild(toast);
    setTimeout(function() {
        toast.classList.add('toast-hide');
        setTimeout(function() { toast.remove(); }, 300);
    }, 3000);
}

function getToastContainer() {
    var contenedor = document.getElementById('toast-container');
    if (!contenedor) {
        contenedor = document.createElement('div');
        contenedor.id = 'toast-container';
        contenedor.style.cssText = 'position:fixed;top:20px;right:20px;z-index:9999;display:flex;flex-direction:column;gap:10px;';
        document.body.appendChild(contenedor);
    }
    return contenedor;
}

// =============================================
// --- Cargar vistas AJAX ---
// =============================================
function llamarClientes() {
    $.ajax({
        url: "/Tienda/public/clientes",
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
        url: "/Tienda/public/productos",
        type: "GET",
        success: function (data) {
            $("#cuerpo").html(data);
        },
        error: function (xhr) {
            $("#cuerpo").html("<p>Error al cargar productos: " + xhr.statusText + "</p>");
        }
    });
}

// =============================================
// --- Formularios toggle/cancelar ---
// =============================================
function toggleFormCliente() {
    if ($("#formRegistroCliente").is(":hidden")) {
        cancelarFormCliente();
        $("#formRegistroCliente").show();
    } else {
        $("#formRegistroCliente").hide();
    }
}

function cancelarFormCliente() {
    $("#formRegistroCliente").hide();
    $("#inputIdCliente").val("");
    $("#inputNombre").val("");
    $("#inputApPaterno").val("");
    $("#inputApMaterno").val("");
    $("#inputRFC").val("");
    $("#mensajeRegistroCliente").html("");
    $("#tituloFormCliente").text("Nuevo Cliente");
    $("#btnGuardarCliente").text("Guardar").attr("onclick", "guardarCliente()");
}

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

// =============================================
// --- CRUD Clientes ---
// =============================================
function guardarCliente() {
    var nombre = $("#inputNombre").val().trim();
    var apPaterno = $("#inputApPaterno").val().trim();
    var apMaterno = $("#inputApMaterno").val().trim();
    var rfc = $("#inputRFC").val().trim();

    if (!nombre || !apPaterno || !rfc) {
        mostrarToast('Los campos Nombre, Apellido Paterno y RFC son obligatorios.', 'error');
        return;
    }

    $.ajax({
        url: "/Tienda/public/clientes/guardar",
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
                mostrarToast(data.message, 'success');
                setTimeout(function () { llamarClientes(); }, 1000);
            } else {
                mostrarToast(data.message, 'error');
            }
        },
        error: function (xhr) {
            mostrarToast('Error de conexión: ' + xhr.statusText, 'error');
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
    $("#formRegistroCliente").show();
    $('html, body').animate({ scrollTop: $("#formRegistroCliente").offset().top - 20 }, 300);
}

function actualizarCliente() {
    var id = $("#inputIdCliente").val();
    var nombre = $("#inputNombre").val().trim();
    var apPaterno = $("#inputApPaterno").val().trim();
    var apMaterno = $("#inputApMaterno").val().trim();
    var rfc = $("#inputRFC").val().trim();

    if (!nombre || !apPaterno || !rfc) {
        mostrarToast('Los campos Nombre, Apellido Paterno y RFC son obligatorios.', 'error');
        return;
    }

    $.ajax({
        url: "/Tienda/public/clientes/actualizar",
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
                mostrarToast(data.message, 'success');
                setTimeout(function () { llamarClientes(); }, 1000);
            } else {
                mostrarToast(data.message, 'error');
            }
        },
        error: function (xhr) {
            mostrarToast('Error de conexión: ' + xhr.statusText, 'error');
        }
    });
}

function eliminarCliente(id) {
    if (!confirm("¿Estás seguro de que deseas eliminar este cliente?")) {
        return;
    }

    $.ajax({
        url: "/Tienda/public/clientes/eliminar",
        type: "POST",
        data: { id_cliente: id },
        dataType: "json",
        success: function (data) {
            if (data.status === "ok") {
                mostrarToast(data.message, 'success');
                llamarClientes();
            } else {
                mostrarToast(data.message, 'error');
            }
        },
        error: function (xhr) {
            mostrarToast('Error de conexión: ' + xhr.statusText, 'error');
        }
    });
}

// =============================================
// --- CRUD Productos ---
// =============================================
function guardarProducto() {
    var nombre = $("#inputNombreProducto").val().trim();
    var cantidad = $("#inputCantidad").val().trim();
    var precio = $("#inputPrecio").val().trim();
    var categoria = $("#inputCategoria").val().trim();

    if (!nombre || cantidad === "" || precio === "" || !categoria) {
        mostrarToast('Todos los campos son obligatorios.', 'error');
        return;
    }

    $.ajax({
        url: "/Tienda/public/productos/guardar",
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
                mostrarToast(data.message, 'success');
                setTimeout(function () { llamarProductos(); }, 1000);
            } else {
                mostrarToast(data.message, 'error');
            }
        },
        error: function (xhr) {
            mostrarToast('Error de conexión: ' + xhr.statusText, 'error');
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
        mostrarToast('Todos los campos son obligatorios.', 'error');
        return;
    }

    $.ajax({
        url: "/Tienda/public/productos/actualizar",
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
                mostrarToast(data.message, 'success');
                setTimeout(function () { llamarProductos(); }, 1000);
            } else {
                mostrarToast(data.message, 'error');
            }
        },
        error: function (xhr) {
            mostrarToast('Error de conexión: ' + xhr.statusText, 'error');
        }
    });
}

function eliminarProducto(id) {
    if (!confirm("¿Estás seguro de que deseas eliminar este producto?")) {
        return;
    }

    $.ajax({
        url: "/Tienda/public/productos/eliminar",
        type: "POST",
        data: { id: id },
        dataType: "json",
        success: function (data) {
            if (data.status === "ok") {
                mostrarToast(data.message, 'success');
                llamarProductos();
            } else {
                mostrarToast(data.message, 'error');
            }
        },
        error: function (xhr) {
            mostrarToast('Error de conexión: ' + xhr.statusText, 'error');
        }
    });
}

// =============================================
// --- CRUD Archivos ---
// =============================================
var selectedFile = null;

function llamarArchivos() {
    $.ajax({
        url: "/Tienda/public/archivos",
        type: "GET",
        success: function (data) {
            $("#cuerpo").html(data);
        },
        error: function (xhr) {
            $("#cuerpo").html("<p>Error al cargar archivos: " + xhr.statusText + "</p>");
        }
    });
}

function toggleFormArchivo() {
    if ($("#formRegistroArchivo").is(":hidden")) {
        cancelarFormArchivo();
        $("#formRegistroArchivo").show();
    } else {
        $("#formRegistroArchivo").hide();
    }
}

function cancelarFormArchivo() {
    $("#formRegistroArchivo").hide();
    $("#inputIdArchivo").val("");
    $("#inputDescripcionCorta").val("");
    $("#inputDescripcionLarga").val("");
    $("#mensajeRegistroArchivo").html("");
    $("#tituloFormArchivo").text("Subir Archivo");
    $("#btnGuardarArchivo").text("Subir Archivo").attr("onclick", "guardarArchivo()");
    removeFile();
}

function handleFileSelect(input) {
    if (input.files && input.files[0]) {
        selectedFile = input.files[0];
        $("#uploadZone .upload-content").hide();
        $("#uploadPreview").show();
        $("#fileName").text(selectedFile.name);
    }
}

function removeFile() {
    selectedFile = null;
    $("#inputArchivo").val("");
    $("#uploadZone .upload-content").show();
    $("#uploadPreview").hide();
}



$(document).on("dragover", "#uploadZone", function(e) {
    e.preventDefault();
    $(this).addClass("dragover");
});

$(document).on("dragleave", "#uploadZone", function() {
    $(this).removeClass("dragover");
});

$(document).on("drop", "#uploadZone", function(e) {
    e.preventDefault();
    $(this).removeClass("dragover");
    var files = e.originalEvent.dataTransfer.files;
    if (files.length > 0) {
        $("#inputArchivo")[0].files = files;
        handleFileSelect($("#inputArchivo")[0]);
    }
});

function guardarArchivo() {
    if (!selectedFile) {
        mostrarToast('Selecciona un archivo para subir.', 'error');
        return;
    }

    var formData = new FormData();
    formData.append('archivo', selectedFile);
    formData.append('descripcion_corta', $("#inputDescripcionCorta").val());
    formData.append('descripcion_larga', $("#inputDescripcionLarga").val());

    $.ajax({
        url: "/Tienda/public/archivos/guardar",
        type: "POST",
        data: formData,
        processData: false,
        contentType: false,
        dataType: "json",
        success: function (data) {
            if (data.status === "ok") {
                mostrarToast(data.message, 'success');
                setTimeout(function () { llamarArchivos(); }, 1000);
            } else {
                mostrarToast(data.message, 'error');
            }
        },
        error: function (xhr) {
            mostrarToast('Error de conexión: ' + xhr.statusText, 'error');
        }
    });
}

function editarArchivo(id, descripcionCorta, descripcionLarga) {
    $("#inputIdArchivo").val(id);
    $("#inputDescripcionCorta").val(descripcionCorta);
    $("#inputDescripcionLarga").val(descripcionLarga);
    $("#tituloFormArchivo").text("Editar Archivo #" + id);
    $("#btnGuardarArchivo").text("Actualizar").attr("onclick", "actualizarArchivo()");
    $("#formRegistroArchivo").show();
    $('html, body').animate({ scrollTop: $("#formRegistroArchivo").offset().top - 20 }, 300);
}

function actualizarArchivo() {
    var id = $("#inputIdArchivo").val();
    var descripcionCorta = $("#inputDescripcionCorta").val().trim();
    var descripcionLarga = $("#inputDescripcionLarga").val().trim();

    $.ajax({
        url: "/Tienda/public/archivos/actualizar",
        type: "POST",
        data: {
            id: id,
            descripcion_corta: descripcionCorta,
            descripcion_larga: descripcionLarga
        },
        dataType: "json",
        success: function (data) {
            if (data.status === "ok") {
                mostrarToast(data.message, 'success');
                setTimeout(function () { llamarArchivos(); }, 1000);
            } else {
                mostrarToast(data.message, 'error');
            }
        },
        error: function (xhr) {
            mostrarToast('Error de conexión: ' + xhr.statusText, 'error');
        }
    });
}

function eliminarArchivo(id) {
    if (!confirm("¿Estás seguro de que deseas eliminar este archivo?")) {
        return;
    }

    $.ajax({
        url: "/Tienda/public/archivos/eliminar",
        type: "POST",
        data: { id: id },
        dataType: "json",
        success: function (data) {
            if (data.status === "ok") {
                mostrarToast(data.message, 'success');
                llamarArchivos();
            } else {
                mostrarToast(data.message, 'error');
            }
        },
        error: function (xhr) {
            mostrarToast('Error de conexión: ' + xhr.statusText, 'error');
        }
    });
}

function descargarArchivo(id) {
    window.location.href = "/Tienda/public/archivos/descargar?id=" + id;
}
<?php
require_once 'auth.php';
require_once 'db.php';

$results = $db->query("SELECT * FROM productos");
?>

<div class="productos-section">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h4 class="mb-0">Productos</h4>
        <button class="btn btn-primary btn-sm" onclick="toggleFormProducto()">
            + Registrar nuevo producto
        </button>
    </div>

    <!-- Formulario de registro / edición (oculto por defecto) -->
    <div id="formRegistroProducto" style="display: none;" class="card p-3 mb-3">
        <h5 class="mb-3" id="tituloFormProducto">Nuevo Producto</h5>
        <input type="hidden" id="inputIdProducto" value="">
        <div class="row g-2">
            <div class="col-md-3">
                <label class="form-label">Nombre <span class="text-danger">*</span></label>
                <input type="text" class="form-control form-control-sm" id="inputNombreProducto">
            </div>
            <div class="col-md-2">
                <label class="form-label">Cantidad <span class="text-danger">*</span></label>
                <input type="number" class="form-control form-control-sm" id="inputCantidad" min="0">
            </div>
            <div class="col-md-2">
                <label class="form-label">Precio <span class="text-danger">*</span></label>
                <input type="number" class="form-control form-control-sm" id="inputPrecio" min="0" step="0.01">
            </div>
            <div class="col-md-3">
                <label class="form-label">Categoría <span class="text-danger">*</span></label>
                <input type="text" class="form-control form-control-sm" id="inputCategoria">
            </div>
        </div>
        <div class="mt-3 d-flex gap-2">
            <button class="btn btn-success btn-sm" id="btnGuardarProducto" onclick="guardarProducto()">Guardar</button>
            <button class="btn btn-secondary btn-sm" onclick="cancelarFormProducto()">Cancelar</button>
        </div>
        <div id="mensajeRegistroProducto" class="mt-2"></div>
    </div>

    <div class="table-responsive">
        <table class="table table-bordered table-striped" id="tablaProductos">
            <thead class="table-dark">
                <tr>
                    <th>ID</th>
                    <th>Nombre</th>
                    <th>Cantidad</th>
                    <th>Precio</th>
                    <th>Categoría</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($results as $r) { ?>
                    <tr>
                        <td><?php echo $r['id']; ?></td>
                        <td><?php echo htmlspecialchars($r['nombre']); ?></td>
                        <td><?php echo $r['cantidad']; ?></td>
                        <td>$<?php echo number_format($r['precio'], 2); ?></td>
                        <td><?php echo htmlspecialchars($r['categoria']); ?></td>
                        <td>
                            <button class="btn btn-warning btn-sm"
                                onclick="editarProducto(<?php echo $r['id']; ?>, '<?php echo addslashes($r['nombre']); ?>', <?php echo $r['cantidad']; ?>, <?php echo $r['precio']; ?>, '<?php echo addslashes($r['categoria']); ?>')">
                                <i class="bi bi-pencil"></i> Editar
                            </button>
                            <button class="btn btn-danger btn-sm" onclick="eliminarProducto(<?php echo $r['id']; ?>)">
                                <i class="bi bi-trash"></i> Eliminar
                            </button>
                        </td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>
</div>
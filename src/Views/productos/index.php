<div class="productos-section">
  <div class="d-flex justify-content-between align-items-center mb-4">
    <div>
      <h4 class="mb-1">Productos</h4>
      <p class="text-muted small mb-0">Administra tu inventario</p>
    </div>
    <button class="btn btn-primary" onclick="toggleFormProducto()">
      <i class="bi bi-plus-lg me-2"></i>Nuevo
    </button>
  </div>

  <div id="formRegistroProducto" style="display: none;" class="card mb-4">
    <div class="card-header">
      <h5 id="tituloFormProducto" class="mb-0">Nuevo Producto</h5>
    </div>
    <div class="card-body">
      <input type="hidden" id="inputIdProducto" value="">
      <div class="row g-3">
        <div class="col-md-4">
          <label class="form-label">Nombre</label>
          <input type="text" class="form-control" id="inputNombreProducto">
        </div>
        <div class="col-md-3">
          <label class="form-label">Cantidad</label>
          <input type="number" class="form-control" id="inputCantidad" min="0">
        </div>
        <div class="col-md-3">
          <label class="form-label">Precio</label>
          <input type="number" class="form-control" id="inputPrecio" min="0" step="0.01">
        </div>
        <div class="col-md-2">
          <label class="form-label">Categoría</label>
          <input type="text" class="form-control" id="inputCategoria">
        </div>
      </div>
      <div class="mt-4 d-flex gap-2">
        <button class="btn btn-success" id="btnGuardarProducto" onclick="guardarProducto()">
          <i class="bi bi-check-lg me-1"></i>Guardar
        </button>
        <button class="btn btn-secondary" onclick="cancelarFormProducto()">
          Cancelar
        </button>
      </div>
      <div id="mensajeRegistroProducto" class="mt-3"></div>
    </div>
  </div>

  <div class="table-responsive">
    <table class="table table-hover" id="tablaProductos">
      <thead>
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
        <?php if (isset($productos)): foreach ($productos as $r): ?>
            <tr>
              <td><span class="badge bg-light text-primary"><?php echo $r['id']; ?></span></td>
              <td><strong><?php echo htmlspecialchars($r['nombre']); ?></strong></td>
              <td>
                <span class="badge bg-info text-white">
                  <?php echo $r['cantidad']; ?>
                </span>
              </td>
              <td>
                <span class="fw-bold text-success">$<?php echo number_format($r['precio'], 2); ?></span>
              </td>
              <td>
                <span class="badge bg-secondary"><?php echo htmlspecialchars($r['categoria']); ?></span>
              </td>
              <td>
                <button class="btn btn-sm btn-warning" onclick="editarProducto(<?php echo $r['id']; ?>, '<?php echo addslashes($r['nombre']); ?>', <?php echo $r['cantidad']; ?>, <?php echo $r['precio']; ?>, '<?php echo addslashes($r['categoria']); ?>')">
                  <i class="bi bi-pencil"></i>
                </button>
                <button class="btn btn-sm btn-danger" onclick="eliminarProducto(<?php echo $r['id']; ?>)">
                  <i class="bi bi-trash"></i>
                </button>
              </td>
            </tr>
        <?php endforeach;
        endif; ?>
      </tbody>
    </table>
  </div>
</div>
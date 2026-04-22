<div class="page-header">
  <div class="header-content">
    <div>
      <h1 class="page-title">Productos</h1>
      <p class="page-subtitle">Administra tu inventario de productos</p>
    </div>
    <button class="btn-primary" onclick="toggleFormProducto()">
      <i class="bi bi-plus-lg"></i>
      <span>Nuevo Producto</span>
    </button>
  </div>
</div>

<div id="formRegistroProducto" class="form-panel" style="display: none;">
  <div class="form-panel-header">
    <h3 id="tituloFormProducto">Nuevo Producto</h3>
    <button class="btn-close-panel" onclick="cancelarFormProducto()">
      <i class="bi bi-x"></i>
    </button>
  </div>
  <div class="form-panel-body">
    <input type="hidden" id="inputIdProducto" value="">
    <div class="form-row">
      <div class="form-group">
        <label class="form-label" for="inputNombreProducto">Nombre</label>
        <input type="text" class="form-input" id="inputNombreProducto" placeholder="Nombre del producto" required>
        <span class="form-error">El nombre es obligatorio</span>
      </div>
      <div class="form-group">
        <label class="form-label" for="inputCantidad">Cantidad</label>
        <input type="number" class="form-input" id="inputCantidad" min="0" placeholder="0" required>
        <span class="form-error">La cantidad es obligatoria</span>
      </div>
      <div class="form-group">
        <label class="form-label" for="inputPrecio">Precio</label>
        <input type="number" class="form-input" id="inputPrecio" min="0" step="0.01" placeholder="0.00" required>
        <span class="form-error">El precio es obligatorio</span>
      </div>
      <div class="form-group">
        <label class="form-label" for="inputCategoria">Categoría</label>
        <input type="text" class="form-input" id="inputCategoria" placeholder="Categoría" required>
        <span class="form-error">La categoría es obligatoria</span>
      </div>
    </div>
    <div class="form-actions">
      <button class="btn-save" id="btnGuardarProducto" onclick="guardarProducto()">
        <i class="bi bi-check-lg"></i>
        <span>Guardar</span>
      </button>
      <button class="btn-cancel" onclick="cancelarFormProducto()">
        <span>Cancelar</span>
      </button>
    </div>
    <div id="mensajeRegistroProducto"></div>
  </div>
</div>

<div class="search-bar">
  <i class="bi bi-search"></i>
  <input type="text" id="buscarProducto" placeholder="Buscar por nombre, categoría..." onkeyup="filtrarTabla('tablaProductos', this.value)">
</div>

<div class="table-container">
  <div class="table-wrapper">
    <table class="data-table" id="tablaProductos">
      <thead>
        <tr>
          <th style="cursor: default;">ID</th>
          <th>Nombre</th>
          <th>Cantidad</th>
          <th>Precio</th>
          <th>Categoría</th>
          <th>Acciones</th>
        </tr>
      </thead>
      <tbody>
        <?php if (isset($productos) && count($productos) > 0): foreach ($productos as $r): ?>
          <tr>
            <td><span class="badge-id"><?php echo $r['id']; ?></span></td>
            <td><strong><?php echo htmlspecialchars($r['nombre']); ?></strong></td>
            <td>
              <span class="badge-stock <?php echo $r['cantidad'] < 5 ? 'low' : ''; ?>">
                <?php echo $r['cantidad']; ?>
              </span>
            </td>
            <td><span class="price">$<?php echo number_format($r['precio'], 2); ?></span></td>
            <td><span class="badge-category"><?php echo htmlspecialchars($r['categoria']); ?></span></td>
            <td>
              <div class="action-buttons">
                <button class="btn-action btn-edit" data-tooltip="Editar" onclick="editarProducto(<?php echo $r['id']; ?>, '<?php echo addslashes($r['nombre']); ?>', <?php echo $r['cantidad']; ?>, <?php echo $r['precio']; ?>, '<?php echo addslashes($r['categoria']); ?>')">
                  <i class="bi bi-pencil"></i>
                </button>
                <button class="btn-action btn-delete" data-tooltip="Eliminar" onclick="eliminarProducto(<?php echo $r['id']; ?>)">
                  <i class="bi bi-trash"></i>
                </button>
              </div>
            </td>
          </tr>
        <?php endforeach; else: ?>
          <tr>
            <td colspan="6">
              <div class="empty-state">
                <div class="empty-state-icon">
                  <i class="bi bi-box-seam"></i>
                </div>
                <h3 class="empty-state-title">No hay productos</h3>
                <p class="empty-state-text">Comienza agregando tu primer producto al inventario</p>
              </div>
            </td>
          </tr>
        <?php endif; ?>
      </tbody>
    </table>
  </div>
</div>
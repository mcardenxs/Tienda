<div class="page-header">
  <div class="header-content">
    <div>
      <h1 class="page-title">Clientes</h1>
      <p class="page-subtitle">Administra tu base de clientes</p>
    </div>
    <button class="btn-primary" onclick="toggleFormCliente()">
      <i class="bi bi-person-plus"></i>
      <span>Nuevo Cliente</span>
    </button>
  </div>
</div>

<div id="formRegistroCliente" class="form-panel" style="display: none;">
  <div class="form-panel-header">
    <h3 id="tituloFormCliente">Nuevo Cliente</h3>
    <button class="btn-close-panel" onclick="cancelarFormCliente()">
      <i class="bi bi-x"></i>
    </button>
  </div>
  <div class="form-panel-body">
    <input type="hidden" id="inputIdCliente" value="">
    <div class="form-row">
      <div class="form-group">
        <label class="form-label" for="inputNombre">Nombre</label>
        <input type="text" class="form-input" id="inputNombre" placeholder="Nombre" required>
        <span class="form-error">El nombre es obligatorio</span>
      </div>
      <div class="form-group">
        <label class="form-label" for="inputApPaterno">Apellido Paterno</label>
        <input type="text" class="form-input" id="inputApPaterno" placeholder="Apellido paterno" required>
        <span class="form-error">El apellido paterno es obligatorio</span>
      </div>
      <div class="form-group">
        <label class="form-label" for="inputApMaterno">Apellido Materno</label>
        <input type="text" class="form-input" id="inputApMaterno" placeholder="Apellido materno">
        <span class="form-error"></span>
      </div>
      <div class="form-group">
        <label class="form-label" for="inputRFC">RFC</label>
        <input type="text" class="form-input" id="inputRFC" placeholder="RFC" required>
        <span class="form-error">El RFC es obligatorio</span>
      </div>
    </div>
    <div class="form-actions">
      <button class="btn-save" id="btnGuardarCliente" onclick="guardarCliente()">
        <i class="bi bi-check-lg"></i>
        <span>Guardar</span>
      </button>
      <button class="btn-cancel" onclick="cancelarFormCliente()">
        <span>Cancelar</span>
      </button>
    </div>
    <div id="mensajeRegistroCliente"></div>
  </div>
</div>

<div class="search-bar">
  <i class="bi bi-search"></i>
  <input type="text" id="buscarCliente" placeholder="Buscar por nombre o RFC..." onkeyup="filtrarTabla('tablaClientes', this.value)">
</div>

<div class="table-container">
  <div class="table-wrapper">
    <table class="data-table" id="tablaClientes">
      <thead>
        <tr>
          <th style="cursor: default;">ID</th>
          <th>Nombre</th>
          <th>Apellido Paterno</th>
          <th>Apellido Materno</th>
          <th>RFC</th>
          <th>Acciones</th>
        </tr>
      </thead>
      <tbody>
        <?php if (isset($clientes) && count($clientes) > 0): foreach ($clientes as $c): ?>
          <tr>
            <td><span class="badge-id"><?php echo $c['id_cliente']; ?></span></td>
            <td><strong><?php echo htmlspecialchars($c['nombre']); ?></strong></td>
            <td><?php echo htmlspecialchars($c['apellido_paterno'] ?? '-'); ?></td>
            <td><?php echo htmlspecialchars($c['apellido_materno'] ?? '-'); ?></td>
            <td><span class="rfc-text"><?php echo htmlspecialchars($c['rfc'] ?? '-'); ?></span></td>
            <td>
              <div class="action-buttons">
                <button class="btn-action btn-edit" data-tooltip="Editar" onclick="editarCliente(<?php echo $c['id_cliente']; ?>, '<?php echo addslashes($c['nombre']); ?>', '<?php echo addslashes($c['apellido_paterno'] ?? ''); ?>', '<?php echo addslashes($c['apellido_materno'] ?? ''); ?>', '<?php echo addslashes($c['rfc'] ?? ''); ?>')">
                  <i class="bi bi-pencil"></i>
                </button>
                <button class="btn-action btn-delete" data-tooltip="Eliminar" onclick="eliminarCliente(<?php echo $c['id_cliente']; ?>)">
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
                  <i class="bi bi-people"></i>
                </div>
                <h3 class="empty-state-title">No hay clientes</h3>
                <p class="empty-state-text">Agrega tu primer cliente para comenzar a gestionar tu base de datos</p>
              </div>
            </td>
          </tr>
        <?php endif; ?>
      </tbody>
    </table>
  </div>
</div>
<div class="clientes-section">
  <div class="d-flex justify-content-between align-items-center mb-4">
    <div>
      <h4 class="mb-1">Clientes</h4>
      <p class="text-muted small mb-0">Administra tus clientes</p>
    </div>
    <button class="btn btn-primary" onclick="toggleFormCliente()">
      <i class="bi bi-person-plus me-2"></i>Nuevo
    </button>
  </div>

  <div id="formRegistroCliente" style="display: none;" class="card mb-4">
    <div class="card-header">
      <h5 id="tituloFormCliente" class="mb-0">Nuevo Cliente</h5>
    </div>
    <div class="card-body">
      <input type="hidden" id="inputIdCliente" value="">
      <div class="row g-3">
        <div class="col-md-6">
          <label class="form-label">Nombre</label>
          <input type="text" class="form-control" id="inputNombreCliente">
        </div>
        <div class="col-md-6">
          <label class="form-label">Teléfono</label>
          <input type="text" class="form-control" id="inputTelefonoCliente">
        </div>
        <div class="col-md-6">
          <label class="form-label">Email</label>
          <input type="email" class="form-control" id="inputEmailCliente">
        </div>
        <div class="col-md-6">
          <label class="form-label">Dirección</label>
          <input type="text" class="form-control" id="inputDireccionCliente">
        </div>
      </div>
      <div class="mt-4 d-flex gap-2">
        <button class="btn btn-success" id="btnGuardarCliente" onclick="guardarCliente()">
          <i class="bi bi-check-lg me-1"></i>Guardar
        </button>
        <button class="btn btn-secondary" onclick="cancelarFormCliente()">
          Cancelar
        </button>
      </div>
      <div id="mensajeRegistroCliente" class="mt-3"></div>
    </div>
  </div>

  <div class="table-responsive">
    <table class="table table-hover" id="tablaClientes">
      <thead>
        <tr>
          <th>ID</th>
          <th>Nombre</th>
          <th>Teléfono</th>
          <th>Email</th>
          <th>Dirección</th>
          <th>Acciones</th>
        </tr>
      </thead>
      <tbody>
        <?php if (isset($clientes)): foreach ($clientes as $c): ?>
            <tr>
              <td><span class="badge bg-light text-primary"><?php echo $c['id_cliente']; ?></span></td>
              <td><strong><?php echo htmlspecialchars($c['nombre']); ?></strong></td>
              <td><?php echo htmlspecialchars($c['telefono'] ?? '-'); ?></td>
              <td><?php echo htmlspecialchars($c['email'] ?? '-'); ?></td>
              <td><?php echo htmlspecialchars($c['direccion'] ?? '-'); ?></td>
              <td>
                <button class="btn btn-sm btn-warning" onclick="editarCliente(<?php echo $c['id_cliente']; ?>, '<?php echo addslashes($c['nombre']); ?>', '<?php echo addslashes($c['telefono'] ?? ''); ?>', '<?php echo addslashes($c['email'] ?? ''); ?>', '<?php echo addslashes($c['direccion'] ?? ''); ?>')">
                  <i class="bi bi-pencil"></i>
                </button>
                <button class="btn btn-sm btn-danger" onclick="eliminarCliente(<?php echo $c['id_cliente']; ?>)">
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
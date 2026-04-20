<?php
require_once 'auth.php';
require_once 'db.php';

$results = $db->query("SELECT * FROM clientes");
?>

<div class="clientes-section">
  <div class="d-flex justify-content-between align-items-center mb-4">
    <div>
      <h4 class="mb-1">Clientes</h4>
      <p class="text-muted small mb-0">Gestiona tus clientes</p>
    </div>
    <button class="btn btn-primary" onclick="toggleFormCliente()">
      <i class="bi bi-plus-lg me-2"></i>Nuevo
    </button>
  </div>

  <div id="formRegistro" style="display: none;" class="card mb-4">
    <div class="card-header">
      <h5 id="tituloFormCliente" class="mb-0">Nuevo Cliente</h5>
    </div>
    <div class="card-body">
      <input type="hidden" id="inputIdCliente" value="">
      <div class="row g-3">
        <div class="col-md-4">
          <label class="form-label">Nombre</label>
          <input type="text" class="form-control" id="inputNombre">
        </div>
        <div class="col-md-4">
          <label class="form-label">Apellido Paterno</label>
          <input type="text" class="form-control" id="inputApPaterno">
        </div>
        <div class="col-md-4">
          <label class="form-label">Apellido Materno</label>
          <input type="text" class="form-control" id="inputApMaterno">
        </div>
        <div class="col-md-4">
          <label class="form-label">RFC</label>
          <input type="text" class="form-control" id="inputRFC">
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
      <div id="mensajeRegistro" class="mt-3"></div>
    </div>
  </div>

  <div class="table-responsive">
    <table class="table table-hover" id="tablaClientes">
      <thead>
        <tr>
          <th>ID</th>
          <th>Nombre</th>
          <th>Apellido Paterno</th>
          <th>Apellido Materno</th>
          <th>RFC</th>
          <th>Acciones</th>
        </tr>
      </thead>
      <tbody>
        <?php foreach ($results as $r) { ?>
          <tr>
            <td><span class="badge bg-light text-primary"><?php echo $r['id_cliente']; ?></span></td>
            <td><?php echo htmlspecialchars($r['nombre']); ?></td>
            <td><?php echo htmlspecialchars($r['apellido_paterno']); ?></td>
            <td><?php echo htmlspecialchars($r['apellido_materno']); ?></td>
            <td><code><?php echo htmlspecialchars($r['rfc']); ?></code></td>
            <td>
              <button class="btn btn-sm btn-warning"
                onclick="editarCliente(<?php echo $r['id_cliente']; ?>, '<?php echo addslashes($r['nombre']); ?>', '<?php echo addslashes($r['apellido_paterno']); ?>', '<?php echo addslashes($r['apellido_materno']); ?>', '<?php echo addslashes($r['rfc']); ?>')">
                <i class="bi bi-pencil"></i>
              </button>
              <button class="btn btn-sm btn-danger" onclick="eliminarCliente(<?php echo $r['id_cliente']; ?>)">
                <i class="bi bi-trash"></i>
              </button>
            </td>
          </tr>
        <?php } ?>
      </tbody>
    </table>
  </div>
</div>
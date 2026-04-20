<?php
require_once 'auth.php';
require_once 'db.php';

$results = $db->query("SELECT * FROM clientes");
?>

<div class="clientes-section">
  <div class="d-flex justify-content-between align-items-center mb-3">
    <h4 class="mb-0">Clientes</h4>
    <button class="btn btn-primary btn-sm" onclick="toggleFormCliente()">
      + Registrar nuevo cliente
    </button>
  </div>

  <div id="formRegistro" style="display: none;" class="card p-3 mb-3">
    <h5 class="mb-3" id="tituloFormCliente">Nuevo Cliente</h5>
    <input type="hidden" id="inputIdCliente" value="">
    <div class="row g-2">
      <div class="col-md-3">
        <label class="form-label">Nombre <span class="text-danger">*</span></label>
        <input type="text" class="form-control form-control-sm" id="inputNombre">
      </div>
      <div class="col-md-3">
        <label class="form-label">Apellido Paterno <span class="text-danger">*</span></label>
        <input type="text" class="form-control form-control-sm" id="inputApPaterno">
      </div>
      <div class="col-md-3">
        <label class="form-label">Apellido Materno</label>
        <input type="text" class="form-control form-control-sm" id="inputApMaterno">
      </div>
      <div class="col-md-3">
        <label class="form-label">RFC <span class="text-danger">*</span></label>
        <input type="text" class="form-control form-control-sm" id="inputRFC">
      </div>
    </div>
    <div class="mt-3 d-flex gap-2">
      <button class="btn btn-success btn-sm" id="btnGuardarCliente" onclick="guardarCliente()">Guardar</button>
      <button class="btn btn-secondary btn-sm" onclick="cancelarFormCliente()">Cancelar</button>
    </div>
    <div id="mensajeRegistro" class="mt-2"></div>
  </div>

  <div class="table-responsive">
    <table class="table table-bordered table-striped" id="tablaClientes">
      <thead class="table-dark">
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
            <td><?php echo $r['id_cliente']; ?></td>
            <td><?php echo htmlspecialchars($r['nombre']); ?></td>
            <td><?php echo htmlspecialchars($r['apellido_paterno']); ?></td>
            <td><?php echo htmlspecialchars($r['apellido_materno']); ?></td>
            <td><?php echo htmlspecialchars($r['rfc']); ?></td>
            <td>
              <button class="btn btn-warning btn-sm"
                onclick="editarCliente(<?php echo $r['id_cliente']; ?>, '<?php echo addslashes($r['nombre']); ?>', '<?php echo addslashes($r['apellido_paterno']); ?>', '<?php echo addslashes($r['apellido_materno']); ?>', '<?php echo addslashes($r['rfc']); ?>')">
                <i class="bi bi-pencil"></i> Editar
              </button>
              <button class="btn btn-danger btn-sm" onclick="eliminarCliente(<?php echo $r['id_cliente']; ?>)">
                <i class="bi bi-trash"></i> Eliminar
              </button>
            </td>
          </tr>
        <?php } ?>
      </tbody>
    </table>
  </div>
</div>
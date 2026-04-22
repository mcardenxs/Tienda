<div class="page-header">
  <div class="header-content">
    <div>
      <h1 class="page-title">Archivos</h1>
      <p class="page-subtitle">Gestiona tus archivos subidos</p>
    </div>
    <button class="btn-primary" onclick="toggleFormArchivo()">
      <i class="bi bi-plus-lg"></i>
      <span>Subir Archivo</span>
    </button>
  </div>
</div>

<div id="formRegistroArchivo" class="form-panel" style="display: none;">
  <div class="form-panel-header">
    <h3 id="tituloFormArchivo">Subir Archivo</h3>
    <button class="btn-close-panel" onclick="cancelarFormArchivo()">
      <i class="bi bi-x"></i>
    </button>
  </div>
  <div class="form-panel-body">
    <input type="hidden" id="inputIdArchivo" value="">
    <div class="upload-zone" id="uploadZone">
      <label for="inputArchivo" style="cursor: pointer; width: 100%;">
        <div class="upload-content">
          <i class="bi bi-cloud-arrow-up"></i>
          <p class="upload-text">Arrastra archivos aquí o haz clic para seleccionar</p>
          <p class="upload-hint">Máximo 10 MB por archivo</p>
        </div>
      </label>
      <input type="file" id="inputArchivo" name="archivo" style="display: none;" onchange="handleFileSelect(this)">
      <div class="upload-preview" id="uploadPreview" style="display: none;">
        <i class="bi bi-file-earmark"></i>
        <span id="fileName"></span>
        <button type="button" class="btn-remove-file" onclick="removeFile()">
          <i class="bi bi-x"></i>
        </button>
      </div>
    </div>
    <div class="form-row" style="margin-top: 1.5rem;">
      <div class="form-group">
        <label class="form-label" for="inputDescripcionCorta">Descripción Corta</label>
        <input type="text" class="form-input" id="inputDescripcionCorta" placeholder="Breve descripción del archivo">
      </div>
      <div class="form-group">
        <label class="form-label" for="inputDescripcionLarga">Descripción Larga</label>
        <textarea class="form-input" id="inputDescripcionLarga" rows="3" placeholder="Descripción detallada del archivo"></textarea>
      </div>
    </div>
    <div class="form-actions">
      <button class="btn-save" id="btnGuardarArchivo" onclick="guardarArchivo()">
        <i class="bi bi-check-lg"></i>
        <span>Subir Archivo</span>
      </button>
      <button class="btn-cancel" onclick="cancelarFormArchivo()">
        <span>Cancelar</span>
      </button>
    </div>
    <div id="mensajeRegistroArchivo"></div>
  </div>
</div>

<div class="search-bar">
  <i class="bi bi-search"></i>
  <input type="text" id="buscarArchivo" placeholder="Buscar por nombre o descripción..." onkeyup="filtrarTabla('tablaArchivos', this.value)">
</div>

<div class="table-container">
  <div class="table-wrapper">
    <table class="data-table" id="tablaArchivos">
      <thead>
        <tr>
          <th style="cursor: default;">ID</th>
          <th>Nombre</th>
          <th>Tipo</th>
          <th>Tamaño</th>
          <th>Descargas</th>
          <th>Fecha</th>
          <th>Acciones</th>
        </tr>
      </thead>
      <tbody>
        <?php if (isset($archivos) && count($archivos) > 0): foreach ($archivos as $r): ?>
          <tr>
            <td><span class="badge-id"><?php echo $r['id']; ?></span></td>
            <td>
              <div class="file-name-cell">
                <i class="bi bi-file-earmark"></i>
                <strong><?php echo htmlspecialchars($r['nombre']); ?></strong>
              </div>
              <?php if (!empty($r['descripcion_corta'])): ?>
                <small class="file-desc"><?php echo htmlspecialchars($r['descripcion_corta']); ?></small>
              <?php endif; ?>
            </td>
            <td><span class="badge-category"><?php echo htmlspecialchars($r['tipo']); ?></span></td>
            <td><span class="price"><?php echo number_format($r['tamano'] / 1024, 2); ?> KB</span></td>
            <td>
              <span class="badge-stock">
                <i class="bi bi-download"></i> <?php echo $r['descargas']; ?>
              </span>
            </td>
            <td><?php echo date('d/m/Y', strtotime($r['created_at'])); ?></td>
            <td>
              <div class="action-buttons">
                <button class="btn-action btn-download" data-tooltip="Descargar" onclick="descargarArchivo(<?php echo $r['id']; ?>)">
                  <i class="bi bi-download"></i>
                </button>
                <button class="btn-action btn-edit" data-tooltip="Editar" onclick="editarArchivo(<?php echo $r['id']; ?>, '<?php echo addslashes($r['descripcion_corta'] ?? ''); ?>', '<?php echo addslashes($r['descripcion_larga'] ?? ''); ?>')">
                  <i class="bi bi-pencil"></i>
                </button>
                <button class="btn-action btn-delete" data-tooltip="Eliminar" onclick="eliminarArchivo(<?php echo $r['id']; ?>)">
                  <i class="bi bi-trash"></i>
                </button>
              </div>
            </td>
          </tr>
        <?php endforeach; else: ?>
          <tr>
            <td colspan="7">
              <div class="empty-state">
                <div class="empty-state-icon">
                  <i class="bi bi-folder2-open"></i>
                </div>
                <h3 class="empty-state-title">No hay archivos</h3>
                <p class="empty-state-text">Sube tu primer archivo para comenzar</p>
              </div>
            </td>
          </tr>
        <?php endif; ?>
      </tbody>
    </table>
  </div>
</div>

<style>
.upload-zone {
  border: 2px dashed var(--gray-200);
  border-radius: 16px;
  padding: 3rem 2rem;
  text-align: center;
  transition: all 0.3s ease;
  cursor: pointer;
  background: var(--gray-50);
}

.upload-zone:hover,
.upload-zone.dragover {
  border-color: var(--black);
  background: var(--gray-100);
}

.upload-zone .upload-content i {
  font-size: 3rem;
  color: var(--gray-400);
  margin-bottom: 1rem;
}

.upload-zone .upload-text {
  font-size: 1rem;
  color: var(--gray-700);
  margin-bottom: 0.5rem;
}

.upload-zone .upload-hint {
  font-size: 0.8125rem;
  color: var(--gray-500);
}

.upload-preview {
  display: flex;
  align-items: center;
  gap: 1rem;
  padding: 1rem;
  background: var(--white);
  border: 1px solid var(--gray-200);
  border-radius: 10px;
}

.upload-preview i {
  font-size: 1.5rem;
  color: var(--gray-600);
}

.upload-preview span {
  flex: 1;
  text-align: left;
  font-weight: 500;
  color: var(--gray-700);
}

.btn-remove-file {
  width: 32px;
  height: 32px;
  background: var(--gray-100);
  border: none;
  border-radius: 8px;
  cursor: pointer;
  display: flex;
  align-items: center;
  justify-content: center;
  color: var(--gray-500);
  transition: all 0.2s ease;
}

.btn-remove-file:hover {
  background: #FEE2E2;
  color: #DC2626;
}

.file-name-cell {
  display: flex;
  align-items: center;
  gap: 0.5rem;
}

.file-name-cell i {
  color: var(--gray-500);
}

.file-desc {
  display: block;
  color: var(--gray-500);
  font-size: 0.8125rem;
  margin-top: 0.25rem;
}

.btn-download {
  color: var(--gray-600);
}

.btn-download:hover {
  background: var(--gray-50);
  border-color: var(--gray-300);
  color: var(--black);
  transform: translateY(-2px);
}
</style>
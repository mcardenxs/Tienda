<div class="page-header">
  <h1 class="page-title">Dashboard</h1>
  <p class="page-subtitle">Resumen de tu inventario</p>
</div>

<div class="row g-4">
  <div class="col-md-6">
    <div class="stat-card">
      <div class="stat-header">
        <span class="stat-label">Total Productos</span>
        <div class="stat-icon">
          <i class="bi bi-cart3"></i>
        </div>
      </div>
      <div class="stat-value"><?php echo $total_productos ?? 0; ?></div>
      <div class="stat-change">
        <i class="bi bi-check-circle"></i>
        <span>Inventario activo</span>
      </div>
    </div>
  </div>
  <div class="col-md-6">
    <div class="stat-card">
      <div class="stat-header">
        <span class="stat-label">Total Clientes</span>
        <div class="stat-icon">
          <i class="bi bi-people"></i>
        </div>
      </div>
      <div class="stat-value"><?php echo $total_clientes ?? 0; ?></div>
      <div class="stat-change">
        <i class="bi bi-check-circle"></i>
        <span>Clientes registrados</span>
      </div>
    </div>
  </div>
</div>
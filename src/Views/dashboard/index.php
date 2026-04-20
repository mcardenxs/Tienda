<div class="text-center">
  <h4 class="mb-4">Dashboard</h4>
  <div class="row g-4">
    <div class="col-md-6">
      <div class="card stat-card">
        <div class="card-body">
          <div class="d-flex justify-content-between align-items-center">
            <div>
              <p class="text-muted mb-1 small">Total Productos</p>
              <span class="stat-number"><?php echo $total_productos ?? 0; ?></span>
            </div>
            <i class="bi bi-cart" style="font-size: 2rem; color: #7C3AED;"></i>
          </div>
        </div>
      </div>
    </div>
    <div class="col-md-6">
      <div class="card stat-card">
        <div class="card-body">
          <div class="d-flex justify-content-between align-items-center">
            <div>
              <p class="text-muted mb-1 small">Total Clientes</p>
              <span class="stat-number"><?php echo $total_clientes ?? 0; ?></span>
            </div>
            <i class="bi bi-people" style="font-size: 2rem; color: #7C3AED;"></i>
          </div>
        </div>
      </div>
    </div>
  </div>
  <p class="mt-4 text-muted">Selecciona una opción del menú lateral para más funciones</p>
</div>
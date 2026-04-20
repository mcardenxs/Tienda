<?php
$usuario = $_SESSION['usuario'] ?? '';
$total_productos = $total_productos ?? 0;
$total_clientes = $total_clientes ?? 0;
?>
<!doctype html>
<html lang="es" data-bs-theme="auto">

<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Dashboard - Inventarios</title>
  <link href="/Tienda/public/css/bootstrap.min.css" rel="stylesheet" />
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
  <link href="/Tienda/public/css/modern.css" rel="stylesheet" />
  <link href="/Tienda/public/css/dashboard.css" rel="stylesheet" />
  <script src="/Tienda/public/js/jquery-4.0.0.js"></script>
  <script src="/Tienda/public/js/funciones.js?v=10"></script>
  <style>
    .bi {
      vertical-align: -0.125em;
      fill: currentColor;
    }

    .stat-card {
      border: none;
      border-radius: 8px;
      box-shadow: 0 1px 3px rgba(0, 0, 0, 0.1);
    }

    .stat-card .card-body {
      padding: 1.5rem;
    }

    .stat-number {
      font-size: 2rem;
      font-weight: 700;
      color: #7C3AED;
    }
  </style>
</head>

<body>
  <!-- NAVBAR -->
  <header class="navbar sticky-top bg-white flex-md-nowrap p-0 shadow-sm" style="border-bottom: 1px solid #E5E7EB;">
    <a class="navbar-brand col-md-3 col-lg-2 me-0 px-3 fs-6" href="#" style="color: #7C3AED; font-weight: 700;">
      <i class="bi bi-box-seam-fill me-2"></i>Inventarios
    </a>
    <span class="text-secondary me-3 d-none d-md-flex align-items-center gap-2 small">
      <i class="bi bi-person-circle" style="color: #7C3AED;"></i>
      <?php echo htmlspecialchars($usuario); ?>
    </span>
  </header>

  <div class="container-fluid">
    <div class="row">
      <!-- SIDEBAR -->
      <div class="sidebar col-md-3 col-lg-2 p-0 bg-white" style="min-height: 100vh; border-right: 1px solid #E5E7EB;">
        <nav class="py-3 px-2">
          <ul class="nav flex-column">
            <li class="nav-item mb-1">
              <a class="nav-link d-flex align-items-center gap-2 py-2 px-3 rounded" href="#" onclick="cargarVista('dashboard'); return false;" style="color: #374151;">
                <i class="bi bi-house"></i> Dashboard
              </a>
            </li>
            <li class="nav-item mb-1">
              <a class="nav-link d-flex align-items-center gap-2 py-2 px-3 rounded" href="#" onclick="cargarVista('productos'); return false;" style="color: #374151;">
                <i class="bi bi-cart"></i> Productos
              </a>
            </li>
            <li class="nav-item mb-1">
              <a class="nav-link d-flex align-items-center gap-2 py-2 px-3 rounded" href="#" onclick="cargarVista('clientes'); return false;" style="color: #374151;">
                <i class="bi bi-people"></i> Clientes
              </a>
            </li>
          </ul>
          <hr class="my-3" style="border-color: #E5E7EB;">
          <ul class="nav flex-column">
            <li class="nav-item">
              <a class="nav-link d-flex align-items-center gap-2 py-2 px-3 rounded text-danger" href="/Tienda/public/logout">
                <i class="bi bi-door-closed"></i> Cerrar sesión
              </a>
            </li>
          </ul>
        </nav>
      </div>

      <!-- MAIN CONTENT -->
      <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4 py-4" style="background: #F9FAFB; min-height: 100vh;">
        <div id="cuerpo">
          <?php if (isset($total_productos)): ?>
            <h4 class="mb-4">Dashboard</h4>
            <div class="row g-4">
              <div class="col-md-6">
                <div class="card stat-card">
                  <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center">
                      <div>
                        <p class="text-muted mb-1 small">Total Productos</p>
                        <span class="stat-number"><?php echo $total_productos; ?></span>
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
                        <span class="stat-number"><?php echo $total_clientes; ?></span>
                      </div>
                      <i class="bi bi-people" style="font-size: 2rem; color: #7C3AED;"></i>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <p class="mt-4 text-muted text-center">Selecciona una opción del menú lateral para más funciones</p>
          <?php else: ?>
            <div class="text-center py-5 text-muted">
              <i class="bi bi-box-seam" style="font-size: 48px; opacity: 0.25;"></i>
              <p class="mb-0 mt-3">Selecciona una opción del menú lateral</p>
            </div>
          <?php endif; ?>
        </div>
      </main>
    </div>
  </div>

  <script src="/Tienda/public/js/bootstrap.bundle.min.js"></script>
  <script>
    function cargarVista(vista) {
      $('#cuerpo').html('<div class="text-center py-5"><i class="bi bi-arrow-repeat spin" style="font-size: 32px;"></i></div>');
      $.ajax({
        url: '/Tienda/public/' + vista,
        success: function(data) {
          $('#cuerpo').html(data);
        },
        error: function() {
          $('#cuerpo').html('<div class="alert alert-danger">Error al cargar la página</div>');
        }
      });
    }
  </script>
  <style>
    .spin {
      animation: spin 1s linear infinite;
    }

    @keyframes spin {
      from {
        transform: rotate(0deg);
      }

      to {
        transform: rotate(360deg);
      }
    }
  </style>
</body>

</html>
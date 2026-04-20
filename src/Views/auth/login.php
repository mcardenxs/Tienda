<!DOCTYPE html>
<html lang="es" data-bs-theme="light">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Acceso - Sistema de Inventarios</title>
  <link href="/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
  <link href="/css/modern.css" rel="stylesheet">
  <style>
    body {
      font-family: 'Inter', sans-serif;
      background: #F9FAFB;
      min-height: 100vh;
      display: flex;
      align-items: center;
      justify-content: center;
      margin: 0;
    }

    .login-wrapper {
      width: 100%;
      max-width: 400px;
      padding: 1.5rem;
    }

    .login-card {
      background: white;
      border: none;
      border-radius: 8px;
      box-shadow: 0 4px 12px rgba(0, 0, 0, 0.08);
    }

    .login-header {
      padding: 2rem 2rem 1.5rem;
      text-align: center;
      border-bottom: 2px solid #EDE9FE;
    }

    .login-header h4 {
      font-weight: 700;
      margin: 0;
      color: #7C3AED;
      font-size: 1.5rem;
    }

    .login-body {
      padding: 2rem;
    }

    .form-label {
      font-weight: 500;
      color: #4B5563;
      font-size: 0.9rem;
      margin-bottom: 0.5rem;
    }

    .form-control {
      border: 1px solid #E5E7EB;
      border-radius: 6px;
      padding: 0.75rem 0.875rem;
      font-size: 0.9rem;
    }

    .form-control:focus {
      border-color: #7C3AED;
      box-shadow: 0 0 0 3px rgba(124, 58, 237, 0.1);
    }

    .btn-login {
      background: #7C3AED;
      color: white;
      border: none;
      padding: 0.85rem;
      border-radius: 6px;
      font-weight: 600;
      width: 100%;
      margin-top: 1.5rem;
      transition: all 0.2s ease;
    }

    .btn-login:hover {
      background: #6D28D9;
    }

    .alert {
      border-radius: 6px;
      border: none;
      margin-bottom: 1.5rem;
      font-size: 0.9rem;
    }
  </style>
</head>

<body>
  <div class="login-wrapper">
    <div class="login-card">
      <div class="login-header">
        <h4>Inventarios</h4>
      </div>

      <div class="login-body">
        <?php if (!empty($error)): ?>
          <div class="alert alert-danger">
            <span><?= htmlspecialchars($error) ?></span>
          </div>
        <?php endif; ?>

        <form method="POST" action="/Tienda/public/login">
          <div class="mb-3">
            <label class="form-label">Usuario</label>
            <input type="text" name="username" class="form-control" placeholder="Tu usuario" required autofocus>
          </div>
          <div class="mb-4">
            <label class="form-label">Contraseña</label>
            <input type="password" name="password" class="form-control" placeholder="Tu contraseña" required>
          </div>
          <button type="submit" class="btn btn-login">
            Ingresar
          </button>
        </form>
      </div>
    </div>
  </div>

  <script src="/js/bootstrap.bundle.min.js"></script>
</body>

</html>
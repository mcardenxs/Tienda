<!DOCTYPE html>
<html lang="es" data-bs-theme="light">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Acceso - Sistema de Inventarios</title>
  <link href="/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
  <style>
    * {
      margin: 0;
      padding: 0;
      box-sizing: border-box;
    }

    body {
      font-family: 'Inter', -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif;
      background: #f3f4f6;
      min-height: 100vh;
      display: flex;
      align-items: center;
      justify-content: center;
      padding: 1rem;
    }

    .login-wrapper {
      width: 100%;
      max-width: 380px;
    }

    .login-card {
      background: white;
      border-radius: 8px;
      box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
      padding: 2rem;
    }

    .login-header {
      text-align: center;
      margin-bottom: 1.5rem;
    }

    .login-header h4 {
      font-weight: 700;
      color: #7C3AED;
      font-size: 1.5rem;
    }

    .form-group {
      margin-bottom: 1rem;
    }

    .form-control {
      width: 100%;
      padding: 0.75rem 1rem;
      border: 1px solid #d1d5db;
      border-radius: 6px;
      font-size: 0.95rem;
      transition: border-color 0.2s;
    }

    .form-control:focus {
      border-color: #7C3AED;
      outline: none;
      box-shadow: 0 0 0 3px rgba(124, 58, 237, 0.1);
    }

    .btn-login {
      width: 100%;
      padding: 0.75rem 1rem;
      background: #7C3AED;
      color: white;
      border: none;
      border-radius: 6px;
      font-weight: 600;
      font-size: 1rem;
      cursor: pointer;
      transition: background 0.2s;
    }

    .btn-login:hover {
      background: #6D28D9;
    }

    .alert-danger {
      background: #fee2e2;
      color: #991b1b;
      padding: 0.75rem 1rem;
      border-radius: 6px;
      margin-bottom: 1rem;
      font-size: 0.9rem;
    }
  </style>
</head>

<body>
  <div class="login-wrapper">
    <div class="login-card">
      <div class="login-header">
        <h4>Iniciar Sesión</h4>
      </div>

      <?php if (!empty($error)): ?>
        <div class="alert-danger">
          <?= htmlspecialchars($error) ?>
        </div>
      <?php endif; ?>

      <form method="POST" action="/Tienda/public/login">
        <div class="form-group">
          <input type="text" name="username" class="form-control" placeholder="Usuario" required autofocus>
        </div>
        <div class="form-group">
          <input type="password" name="password" class="form-control" placeholder="Contraseña" required>
        </div>
        <button type="submit" class="btn-login">Ingresar</button>
      </form>
    </div>
  </div>
</body>

</html>
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
      font-family: 'Inter', -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif;
      background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
      min-height: 100vh;
      display: flex;
      align-items: center;
      justify-content: center;
      margin: 0;
      padding: 1rem;
    }

    .login-wrapper {
      width: 100%;
      max-width: 420px;
      animation: fadeIn 0.5s ease-out;
    }

    @keyframes fadeIn {
      from {
        opacity: 0;
        transform: translateY(-20px);
      }

      to {
        opacity: 1;
        transform: translateY(0);
      }
    }

    .login-card {
      background: white;
      border: none;
      border-radius: 16px;
      box-shadow: 0 20px 60px rgba(0, 0, 0, 0.15);
      overflow: hidden;
    }

    .login-header {
      padding: 2.5rem 2rem 2rem;
      text-align: center;
      background: linear-gradient(135deg, #7C3AED 0%, #6D28D9 100%);
      color: white;
    }

    .login-header .icon-wrapper {
      width: 70px;
      height: 70px;
      background: rgba(255, 255, 255, 0.2);
      border-radius: 50%;
      display: flex;
      align-items: center;
      justify-content: center;
      margin: 0 auto 1rem;
    }

    .login-header .icon-wrapper i {
      font-size: 2rem;
      color: white;
    }

    .login-header h4 {
      font-weight: 700;
      margin: 0;
      color: white;
      font-size: 1.5rem;
      letter-spacing: -0.02em;
    }

    .login-header p {
      margin: 0.5rem 0 0;
      opacity: 0.9;
      font-size: 0.9rem;
    }

    .login-body {
      padding: 2rem;
    }

    .form-label {
      font-weight: 600;
      color: #374151;
      font-size: 0.875rem;
      margin-bottom: 0.5rem;
      display: block;
    }

    .input-group {
      position: relative;
      margin-bottom: 1.25rem;
    }

    .input-group .icon-left {
      position: absolute;
      left: 14px;
      top: 50%;
      transform: translateY(-50%);
      color: #9CA3AF;
      font-size: 1.1rem;
      z-index: 3;
    }

    .form-control {
      border: 2px solid #E5E7EB;
      border-radius: 10px;
      padding: 0.875rem 1rem 0.875rem 2.75rem;
      font-size: 0.95rem;
      transition: all 0.3s ease;
      background: #F9FAFB;
    }

    .form-control:focus {
      border-color: #7C3AED;
      box-shadow: 0 0 0 4px rgba(124, 58, 237, 0.1);
      background: white;
      outline: none;
    }

    .form-control::placeholder {
      color: #9CA3AF;
    }

    .btn-login {
      background: linear-gradient(135deg, #7C3AED 0%, #6D28D9 100%);
      color: white;
      border: none;
      padding: 1rem;
      border-radius: 10px;
      font-weight: 600;
      width: 100%;
      margin-top: 0.5rem;
      transition: all 0.3s ease;
      font-size: 1rem;
      letter-spacing: 0.01em;
      cursor: pointer;
    }

    .btn-login:hover {
      transform: translateY(-2px);
      box-shadow: 0 8px 25px rgba(124, 58, 237, 0.35);
    }

    .btn-login:active {
      transform: translateY(0);
    }

    .alert {
      border-radius: 10px;
      border: none;
      margin-bottom: 1.5rem;
      font-size: 0.9rem;
      padding: 1rem;
      display: flex;
      align-items: center;
      gap: 0.5rem;
    }

    .alert-danger {
      background: #FEE2E2;
      color: #991B1B;
    }

    .alert-danger i {
      font-size: 1.1rem;
    }

    .login-footer {
      text-align: center;
      padding: 1.5rem 2rem;
      background: #F9FAFB;
      border-top: 1px solid #E5E7EB;
    }

    .login-footer p {
      margin: 0;
      color: #6B7280;
      font-size: 0.85rem;
    }
  </style>
</head>

<body>
  <div class="login-wrapper">
    <div class="login-card">
      <div class="login-header">
        <div class="icon-wrapper">
          <i class="bi bi-box-seam"></i>
        </div>
        <h4>Sistema de Inventarios</h4>
        <p>Ingresa tus credenciales para continuar</p>
      </div>

      <div class="login-body">
        <?php if (!empty($error)): ?>
          <div class="alert alert-danger">
            <i class="bi bi-exclamation-circle-fill me-2"></i>
            <span><?= htmlspecialchars($error) ?></span>
          </div>
        <?php endif; ?>

        <form method="POST" action="/Tienda/public/login">
          <div class="input-group">
            <i class="bi bi-person icon-left"></i>
            <input type="text" name="username" class="form-control" placeholder="Usuario" required autofocus>
          </div>
          <div class="input-group">
            <i class="bi bi-lock icon-left"></i>
            <input type="password" name="password" class="form-control" placeholder="Contraseña" required>
          </div>
          <button type="submit" class="btn btn-login">
            <i class="bi bi-box-arrow-in-right me-2"></i>
            Ingresar
          </button>
        </form>
      </div>
    </div>
  </div>

  <script src="/js/bootstrap.bundle.min.js"></script>
</body>

</html>
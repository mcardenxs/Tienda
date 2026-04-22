<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Iniciar Sesión - Inventarios</title>
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@400;500;600;700&family=DM+Sans:wght@300;400;500;600&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
  <style>
    :root {
      --black: #0A0A0A;
      --white: #FFFFFF;
      --gray-50: #FAFAFA;
      --gray-100: #F4F4F4;
      --gray-200: #E5E5E5;
      --gray-300: #D4D4D4;
      --gray-400: #A3A3A3;
      --gray-500: #737373;
      --gray-600: #525252;
      --gray-700: #404040;
      --gray-800: #262626;
      --gray-900: #1A1A1A;
    }

    * {
      margin: 0;
      padding: 0;
      box-sizing: border-box;
    }

    body {
      font-family: 'DM Sans', -apple-system, BlinkMacSystemFont, sans-serif;
      background: var(--gray-50);
      min-height: 100vh;
      display: flex;
      align-items: center;
      justify-content: center;
      padding: 2rem;
      position: relative;
      overflow: hidden;
    }

    body::before {
      content: '';
      position: absolute;
      top: -50%;
      right: -20%;
      width: 800px;
      height: 800px;
      background: radial-gradient(circle, rgba(0,0,0,0.03) 0%, transparent 70%);
      pointer-events: none;
    }

    body::after {
      content: '';
      position: absolute;
      bottom: -30%;
      left: -10%;
      width: 600px;
      height: 600px;
      background: radial-gradient(circle, rgba(0,0,0,0.02) 0%, transparent 70%);
      pointer-events: none;
    }

    .login-container {
      width: 100%;
      max-width: 420px;
      position: relative;
      z-index: 1;
    }

    .login-card {
      background: var(--white);
      border: 1px solid var(--gray-200);
      border-radius: 24px;
      overflow: hidden;
      box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.02), 0 20px 50px -12px rgba(0, 0, 0, 0.08);
    }

    .login-header {
      padding: 3rem 2.5rem 2.5rem;
      text-align: center;
      position: relative;
    }

    .login-header::after {
      content: '';
      position: absolute;
      bottom: 0;
      left: 50%;
      transform: translateX(-50%);
      width: 60px;
      height: 2px;
      background: var(--black);
    }

    .logo-mark {
      width: 56px;
      height: 56px;
      background: var(--black);
      border-radius: 16px;
      display: flex;
      align-items: center;
      justify-content: center;
      margin: 0 auto 1.5rem;
      transition: transform 0.3s ease;
    }

    .logo-mark:hover {
      transform: scale(1.05);
    }

    .logo-mark i {
      font-size: 1.5rem;
      color: var(--white);
    }

    .login-header h1 {
      font-family: 'Playfair Display', Georgia, serif;
      font-size: 1.75rem;
      font-weight: 600;
      color: var(--black);
      letter-spacing: -0.02em;
      margin-bottom: 0.5rem;
    }

    .login-header p {
      color: var(--gray-500);
      font-size: 0.9rem;
      font-weight: 400;
    }

    .login-body {
      padding: 2.5rem;
    }

    .form-group {
      margin-bottom: 1.5rem;
    }

    .form-label {
      display: block;
      font-size: 0.8125rem;
      font-weight: 500;
      color: var(--gray-700);
      margin-bottom: 0.5rem;
      letter-spacing: 0.02em;
      text-transform: uppercase;
    }

    .input-wrapper {
      position: relative;
    }

    .input-wrapper i {
      position: absolute;
      left: 1rem;
      top: 50%;
      transform: translateY(-50%);
      color: var(--gray-400);
      font-size: 1rem;
      transition: color 0.2s ease;
      pointer-events: none;
    }

    .form-control {
      width: 100%;
      padding: 0.9375rem 1rem 0.9375rem 2.75rem;
      border: 1px solid var(--gray-200);
      border-radius: 12px;
      font-size: 0.9375rem;
      font-family: inherit;
      color: var(--black);
      background: var(--gray-50);
      transition: all 0.2s ease;
    }

    .form-control:focus {
      outline: none;
      border-color: var(--black);
      background: var(--white);
      box-shadow: 0 0 0 4px rgba(10, 10, 10, 0.05);
    }

    .form-control:focus + i,
    .input-wrapper:focus-within i {
      color: var(--black);
    }

    .form-control::placeholder {
      color: var(--gray-400);
    }

    .btn-login {
      width: 100%;
      padding: 1rem 1.5rem;
      background: var(--black);
      color: var(--white);
      border: none;
      border-radius: 12px;
      font-family: inherit;
      font-size: 0.9375rem;
      font-weight: 500;
      cursor: pointer;
      transition: all 0.2s ease;
      letter-spacing: 0.01em;
      position: relative;
      overflow: hidden;
    }

    .btn-login::before {
      content: '';
      position: absolute;
      top: 0;
      left: -100%;
      width: 100%;
      height: 100%;
      background: linear-gradient(90deg, transparent, rgba(255,255,255,0.1), transparent);
      transition: left 0.5s ease;
    }

    .btn-login:hover {
      background: var(--gray-800);
      transform: translateY(-1px);
      box-shadow: 0 8px 24px rgba(0, 0, 0, 0.15);
    }

    .btn-login:hover::before {
      left: 100%;
    }

    .btn-login:active {
      transform: translateY(0);
    }

    .alert-error {
      background: var(--gray-50);
      color: var(--gray-800);
      padding: 1rem 1.25rem;
      border-radius: 12px;
      margin-bottom: 1.5rem;
      font-size: 0.875rem;
      border-left: 3px solid var(--black);
      display: flex;
      align-items: center;
      gap: 0.75rem;
      animation: slideDown 0.3s ease;
    }

    .alert-error i {
      font-size: 1.125rem;
      color: var(--black);
    }

    @keyframes slideDown {
      from {
        opacity: 0;
        transform: translateY(-10px);
      }
      to {
        opacity: 1;
        transform: translateY(0);
      }
    }

    .login-footer {
      text-align: center;
      padding: 1.5rem 2.5rem 2rem;
    }

    .login-footer p {
      font-size: 0.8rem;
      color: var(--gray-400);
    }

    @keyframes fadeIn {
      from { opacity: 0; transform: translateY(20px); }
      to { opacity: 1; transform: translateY(0); }
    }

    .login-card {
      animation: fadeIn 0.5s ease;
    }
  </style>
</head>

<body>
  <div class="login-container">
    <div class="login-card">
      <div class="login-header">
        <div class="logo-mark">
          <i class="bi bi-box-seam"></i>
        </div>
        <h1>Inventarios</h1>
        <p>Ingresa tus credenciales para continuar</p>
      </div>

      <div class="login-body">
        <?php if (!empty($error)): ?>
          <div class="alert-error">
            <i class="bi bi-exclamation-circle-fill"></i>
            <?= htmlspecialchars($error) ?>
          </div>
        <?php endif; ?>

        <form method="POST" action="/Tienda/public/login">
          <div class="form-group">
            <label class="form-label">Usuario</label>
            <div class="input-wrapper">
              <input type="text" name="username" class="form-control" placeholder="Tu usuario" required autofocus>
              <i class="bi bi-person"></i>
            </div>
          </div>
          <div class="form-group">
            <label class="form-label">Contraseña</label>
            <div class="input-wrapper">
              <input type="password" name="password" class="form-control" placeholder="Tu contraseña" required>
              <i class="bi bi-lock"></i>
            </div>
          </div>
          <button type="submit" class="btn-login">Iniciar Sesión</button>
        </form>
      </div>
    </div>
  </div>
</body>

</html>
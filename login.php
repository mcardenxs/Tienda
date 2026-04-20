<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Si ya está logueado, redirigir al dashboard
if (isset($_SESSION['usuario'])) {
    header("Location: index.php");
    exit();
}

$error = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    require_once 'db.php';

    $username = trim($_POST['username'] ?? '');
    $passwordInput = $_POST['password'] ?? '';

    if ($username === '' || $passwordInput === '') {
        $error = "Debes capturar usuario y contraseña.";
    } else {
        try {
            $usuario = $db->queryFirstRow(
                "SELECT * FROM usuarios WHERE username = %s",
                $username
            );

            if ($usuario && password_verify($passwordInput, $usuario['password'])) {
                $_SESSION['usuario'] = $usuario['username'];
                $_SESSION['rol'] = $usuario['rol'];
                header("Location: index.php");
                exit();
            } else {
                $error = "Usuario o contraseña incorrectos.";
            }
        } catch (Throwable $e) {
            error_log("Error de autenticación: " . $e->getMessage());
            $error = "Error al conectar con el sistema. Verifica que la base de datos esté activa.";
        }
    }
}
?>
<!DOCTYPE html>
<html lang="es" data-bs-theme="auto">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Acceso - Sistema de Inventarios</title>
    <link href="./css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Inter', sans-serif;
            background-color: #f3f4f6;
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
            border-radius: 16px;
            box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.1), 0 10px 10px -5px rgba(0, 0, 0, 0.04);
            overflow: hidden;
        }

        .login-header {
            background: #212529;
            color: white;
            padding: 2.5rem 2rem;
            text-align: center;
        }

        .icon-wrap {
            width: 60px;
            height: 60px;
            background: rgba(255, 255, 255, 0.1);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 1.2rem;
            font-size: 1.8rem;
            border: 1px solid rgba(255, 255, 255, 0.2);
        }

        .login-header h4 {
            font-weight: 700;
            margin: 0;
            letter-spacing: -0.01em;
        }

        .login-header p {
            font-size: 0.85rem;
            margin-top: 0.5rem;
            opacity: 0.7;
        }

        .login-body {
            padding: 2.5rem 2rem;
        }

        .form-label {
            font-weight: 600;
            color: #4b5563;
            font-size: 0.75rem;
            text-transform: uppercase;
            letter-spacing: 0.05em;
            margin-bottom: 0.5rem;
        }

        .input-group {
            border: 1px solid #d1d5db;
            border-radius: 8px;
            overflow: hidden;
            transition: all 0.2s;
        }

        .input-group:focus-within {
            border-color: #212529;
            box-shadow: 0 0 0 3px rgba(33, 37, 41, 0.1);
        }

        .input-group-text {
            background: #f9fafb;
            border: none;
            color: #9ca3af;
        }

        .form-control {
            border: none;
            padding: 0.75rem;
            font-size: 0.95rem;
        }

        .form-control:focus {
            box-shadow: none;
        }

        .btn-login {
            background: #212529;
            color: white;
            border: none;
            padding: 0.8rem;
            border-radius: 8px;
            font-weight: 600;
            width: 100%;
            margin-top: 1rem;
            transition: all 0.2s;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 0.5rem;
        }

        .btn-login:hover {
            background: #000000;
            transform: translateY(-1px);
        }

        .alert {
            font-size: 0.85rem;
            border-radius: 8px;
            margin-bottom: 1.5rem;
            border: none;
        }
    </style>
</head>

<body>
    <div class="login-wrapper">
        <div class="login-card">
            <div class="login-header">
                <div class="icon-wrap">
                    <i class="bi bi-box-seam"></i>
                </div>
                <h4>Inventarios</h4>
                <p>Inicia sesión para gestionar el sistema</p>
            </div>

            <div class="login-body">
                <?php if ($error): ?>
                    <div class="alert alert-danger d-flex align-items-center gap-2">
                        <i class="bi bi-exclamation-circle-fill"></i>
                        <span><?= htmlspecialchars($error) ?></span>
                    </div>
                <?php endif; ?>

                <form method="POST" action="login.php">
                    <div class="mb-3">
                        <label class="form-label">Usuario</label>
                        <div class="input-group">
                            <span class="input-group-text"><i class="bi bi-person"></i></span>
                            <input type="text" name="username" class="form-control" placeholder="Ingresa tu usuario" required autofocus>
                        </div>
                    </div>
                    <div class="mb-4">
                        <label class="form-label">Contraseña</label>
                        <div class="input-group">
                            <span class="input-group-text"><i class="bi bi-lock"></i></span>
                            <input type="password" name="password" class="form-control" placeholder="Ingresa tu contraseña" required>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-login">
                        Ingresar <i class="bi bi-door-open ms-1"></i>
                    </button>
                </form>
            </div>
        </div>
    </div>

    <script src="./js/bootstrap.bundle.min.js"></script>
</body>

</html>

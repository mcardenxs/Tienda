# AGENTS.md - Tienda Inventory Management

## Stack
- PHP >=7.4 con arquitectura MVC
- PDO MySQL (no MeekroDB despite composer.json)
- Apache con `.htaccess` rewrite

## Punto de entrada y URLs
- Entry point: `public/index.php`
- URL base: `http://localhost/Tienda/public/`
- Rewrite rule en `public/.htaccess` redirige todo a `index.php`

## Rutas
- Definidas en `src/routes.php`
- Formato: `$router->metodo('/path', [Controlador::class, 'metodo'])`
- Rutas de autenticación: `/login`, `/logout`
- Rutas protegidas requieren `Session::requireAuth()`

## Autenticación
- Sessions nativas PHP (`src/Core/Session.php`)
- `Session::requireAuth()` redirige a `/Tienda/public/login` si no hay sesión
- Datos de usuario en `$_SESSION['usuario']` y `$_SESSION['rol']`

## Base de datos
- Config en `src/Config/Database.php`
- Host: `localhost:3306`, DB: `tienda`
- Credenciales hardcodeadas (desarrollo)

## Estructura MVC
- Controladores: `src/Controllers/`
- Modelos: `src/Models/`
- Vistas: `src/Views/`
- Core: `src/Core/` (Router, Controller, Session, Model)

## Modelos
- Usan PDO directamente via `Database::getConnection()`
- Métodos: `getAll()`, `findById(id)`, `create(data)`, `update(id, data)`, `delete(id)`
- Retornan arrays con `['status' => 'ok|error', 'message' => '...']`

## Vistas
- `view('layouts/main', $data)` = layout + contenido
- `view('productos/index', $data)` = solo partial (usado en AJAX)
- Helper `Controller::isAjax()` para distinguir requests

## SQL
- Schema en `tienda.sql`
- Tablas: `productos`, `clientes`, `usuarios`

## testing
- No hay framework de testing configurado
- Verificar manualmente con navegador

## No hay
- Linters ni formatters configurados
- Build scripts
- Task runners

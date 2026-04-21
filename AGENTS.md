# Tienda — Inventory Management System

## Stack
- PHP >=7.4, custom MVC, MeekroDB ORM
- Entry point: `public/index.php`
- Namespace `App\` maps to `src/` via PSR-4 autoload

## Architecture
- `src/Config/Database.php` — MySQL connection (localhost, db `tienda`, user `root`)
- `src/routes.php` — Route definitions; `setupRoutes($router)` must be called to register routes
- `src/Core/Controller.php` — Base controller; provides `view()`, `json()`, `redirect()`, `getInput()`
- `src/Core/Model.php` — Base model using MeekroDB; provides `all()`, `find()`, `create()`, `update()`, `delete()`
- `src/Core/Router.php` — Custom router; `normalizePath()` strips and re-adds leading slashes
- Controllers extend `App\Core\Controller`; Models extend `App\Core\Model`

## URL Handling
- `public/index.php` strips `/Tienda/public` prefix from URIs before routing
- Route paths in `routes.php` use leading slashes (e.g., `/login`)

## Database
- Uses MeekroDB's query builder via `$this->db` (PDO wrapper)
- Queries use `%i` for integer interpolation (e.g., `WHERE id = %i`)
- Credentials are hardcoded in `Database.php` — do not commit changes

## No Test/Lint Infrastructure
- No PHPUnit or testing framework configured
- No composer scripts for testing, linting, or type checking
- Run manually via `php -l` for syntax check if needed

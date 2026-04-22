<?php
$usuario = $_SESSION['usuario'] ?? '';
$total_productos = $total_productos ?? 0;
$total_clientes = $total_clientes ?? 0;
?>
<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Dashboard - Inventarios</title>
  <link rel="icon" href="data:image/svg+xml,<svg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 100 100'><rect fill='%230A0A0A' rx='15' width='100' height='100'/><text x='50' y='65' font-size='50' text-anchor='middle' fill='white'>I</text></svg>">
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@400;500;600;700&family=DM+Sans:wght@300;400;500;600&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
  <script src="/Tienda/public/js/jquery-4.0.0.js"></script>
  <script src="/Tienda/public/js/funciones.js?v=12"></script>
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

    ::selection {
      background: var(--black);
      color: var(--white);
    }

    ::-webkit-scrollbar {
      width: 8px;
      height: 8px;
    }

    ::-webkit-scrollbar-track {
      background: var(--gray-100);
    }

    ::-webkit-scrollbar-thumb {
      background: var(--gray-300);
      border-radius: 4px;
    }

    ::-webkit-scrollbar-thumb:hover {
      background: var(--gray-400);
    }

    body {
      font-family: 'DM Sans', -apple-system, BlinkMacSystemFont, sans-serif;
      background: var(--gray-50);
      color: var(--black);
      -webkit-font-smoothing: antialiased;
    }

    @keyframes fadeIn {
      from { opacity: 0; transform: translateY(12px); }
      to { opacity: 1; transform: translateY(0); }
    }

    @keyframes fadeInScale {
      from { opacity: 0; transform: scale(0.95); }
      to { opacity: 1; transform: scale(1); }
    }

    @keyframes slideInLeft {
      from { opacity: 0; transform: translateX(-20px); }
      to { opacity: 1; transform: translateX(0); }
    }

    @keyframes slideInRight {
      from { opacity: 0; transform: translateX(20px); }
      to { opacity: 1; transform: translateX(0); }
    }

    @keyframes slideDown {
      from { opacity: 0; transform: translateY(-16px); }
      to { opacity: 1; transform: translateY(0); }
    }

    @keyframes spin {
      from { transform: rotate(0deg); }
      to { transform: rotate(360deg); }
    }

    @keyframes pulse {
      0%, 100% { opacity: 1; }
      50% { opacity: 0.5; }
    }

    @keyframes shimmer {
      0% { background-position: -200% 0; }
      100% { background-position: 200% 0; }
    }

    @keyframes bounceIn {
      0% { transform: scale(0.8); opacity: 0; }
      50% { transform: scale(1.05); }
      100% { transform: scale(1); opacity: 1; }
    }

    .header {
      position: fixed;
      top: 0;
      left: 0;
      right: 0;
      height: 72px;
      background: var(--white);
      border-bottom: 1px solid var(--gray-200);
      display: flex;
      align-items: center;
      justify-content: space-between;
      padding: 0 2rem;
      z-index: 100;
      animation: slideDown 0.4s ease;
    }

    .header-left {
      display: flex;
      align-items: center;
      gap: 1rem;
    }

    .menu-toggle {
      display: none;
      width: 40px;
      height: 40px;
      background: var(--gray-50);
      border: 1px solid var(--gray-200);
      border-radius: 10px;
      cursor: pointer;
      align-items: center;
      justify-content: center;
      transition: all 0.2s ease;
    }

    .menu-toggle:hover {
      background: var(--gray-100);
    }

    .menu-toggle i {
      font-size: 1.125rem;
      color: var(--gray-600);
    }

    .logo {
      display: flex;
      align-items: center;
      gap: 0.75rem;
      text-decoration: none;
    }

    .logo-mark {
      width: 40px;
      height: 40px;
      background: var(--black);
      border-radius: 10px;
      display: flex;
      align-items: center;
      justify-content: center;
      transition: transform 0.3s cubic-bezier(0.34, 1.56, 0.64, 1);
    }

    .logo:hover .logo-mark {
      transform: scale(1.1) rotate(3deg);
    }

    .logo-mark i {
      color: var(--white);
      font-size: 1rem;
    }

    .logo-text {
      font-family: 'Playfair Display', Georgia, serif;
      font-size: 1.25rem;
      font-weight: 600;
      color: var(--black);
      letter-spacing: -0.01em;
    }

    .header-right {
      display: flex;
      align-items: center;
      gap: 0.5rem;
      animation: fadeIn 0.5s ease 0.2s both;
    }

    .user-menu {
      position: relative;
    }

    .user-trigger {
      display: flex;
      align-items: center;
      gap: 0.75rem;
      padding: 0.5rem 1rem 0.5rem 0.5rem;
      background: transparent;
      border: none;
      border-radius: 50px;
      cursor: pointer;
      transition: all 0.2s ease;
    }

    .user-trigger:hover {
      background: var(--gray-50);
    }

    .user-trigger.open {
      background: var(--gray-50);
    }

    .user-avatar {
      width: 36px;
      height: 36px;
      background: var(--black);
      border-radius: 50%;
      display: flex;
      align-items: center;
      justify-content: center;
      transition: transform 0.2s ease;
    }

    .user-trigger:hover .user-avatar {
      transform: scale(1.05);
    }

    .user-avatar i {
      color: var(--white);
      font-size: 0.875rem;
    }

    .user-name {
      font-size: 0.875rem;
      font-weight: 500;
      color: var(--gray-700);
    }

    .user-chevron {
      font-size: 0.75rem;
      color: var(--gray-400);
      transition: transform 0.2s ease;
    }

    .user-trigger.open .user-chevron {
      transform: rotate(180deg);
    }

    .user-dropdown {
      position: absolute;
      top: calc(100% + 8px);
      right: 0;
      min-width: 200px;
      background: var(--white);
      border: 1px solid var(--gray-200);
      border-radius: 12px;
      box-shadow: 0 10px 40px rgba(0, 0, 0, 0.1);
      opacity: 0;
      visibility: hidden;
      transform: translateY(-10px);
      transition: all 0.25s cubic-bezier(0.4, 0, 0.2, 1);
      overflow: hidden;
      z-index: 200;
    }

    .user-dropdown.show {
      opacity: 1;
      visibility: visible;
      transform: translateY(0);
    }

    .user-dropdown-header {
      padding: 1rem 1.25rem;
      border-bottom: 1px solid var(--gray-100);
    }

    .user-dropdown-name {
      font-size: 0.9375rem;
      font-weight: 600;
      color: var(--black);
      margin-bottom: 0.125rem;
    }

    .user-dropdown-role {
      font-size: 0.8125rem;
      color: var(--gray-500);
    }

    .user-dropdown-item {
      display: flex;
      align-items: center;
      gap: 0.75rem;
      width: 100%;
      padding: 0.875rem 1.25rem;
      background: none;
      border: none;
      font-family: inherit;
      font-size: 0.875rem;
      color: var(--gray-700);
      cursor: pointer;
      transition: all 0.15s ease;
      text-align: left;
      text-decoration: none;
    }

    .user-dropdown-item:hover {
      background: var(--gray-50);
      color: var(--black);
    }

    .user-dropdown-item i {
      font-size: 1rem;
      color: var(--gray-500);
      transition: color 0.15s ease;
    }

    .user-dropdown-item:hover i {
      color: var(--black);
    }

    .user-dropdown-item.danger {
      color: #DC2626;
    }

    .user-dropdown-item.danger i {
      color: #DC2626;
    }

    .user-dropdown-item.danger:hover {
      background: #FEF2F2;
    }

    .layout {
      display: flex;
      margin-top: 72px;
      min-height: calc(100vh - 72px);
    }

    .sidebar {
      width: 260px;
      background: var(--white);
      border-right: 1px solid var(--gray-200);
      position: fixed;
      top: 72px;
      bottom: 0;
      left: 0;
      overflow-y: auto;
      padding: 2rem 0;
      z-index: 90;
      transition: transform 0.3s cubic-bezier(0.4, 0, 0.2, 1);
    }

    .sidebar-overlay {
      display: none;
      position: fixed;
      inset: 0;
      background: rgba(0, 0, 0, 0.3);
      z-index: 89;
      opacity: 0;
      transition: opacity 0.3s ease;
    }

    .sidebar-overlay.show {
      opacity: 1;
    }

    .sidebar-nav {
      display: flex;
      flex-direction: column;
      gap: 0.25rem;
      padding: 0 1rem;
    }

    .nav-item {
      animation: slideInLeft 0.4s ease;
      animation-fill-mode: both;
    }

    .nav-item:nth-child(1) { animation-delay: 0.1s; }
    .nav-item:nth-child(2) { animation-delay: 0.15s; }
    .nav-item:nth-child(3) { animation-delay: 0.2s; }
    .nav-item:nth-child(4) { animation-delay: 0.25s; }

    .nav-link {
      display: flex;
      align-items: center;
      gap: 0.875rem;
      padding: 0.875rem 1.25rem;
      border-radius: 12px;
      text-decoration: none;
      color: var(--gray-500);
      font-size: 0.9375rem;
      font-weight: 500;
      transition: all 0.2s ease;
      cursor: pointer;
      border: none;
      background: none;
      width: 100%;
      text-align: left;
      position: relative;
      overflow: hidden;
    }

    .nav-link::before {
      content: '';
      position: absolute;
      left: 0;
      top: 50%;
      transform: translateY(-50%);
      width: 3px;
      height: 0;
      background: var(--black);
      border-radius: 0 3px 3px 0;
      transition: height 0.2s ease;
    }

    .nav-link i {
      font-size: 1.125rem;
      width: 20px;
      text-align: center;
      transition: transform 0.2s ease;
    }

    .nav-link:hover {
      background: var(--gray-50);
      color: var(--black);
    }

    .nav-link:hover i {
      transform: scale(1.1);
    }

    .nav-link.active {
      background: var(--black);
      color: var(--white);
      box-shadow: 0 4px 12px rgba(0, 0, 0, 0.2);
    }

    .nav-link.active::before {
      height: 24px;
    }

    .nav-link.active i {
      color: var(--white);
    }

    .sidebar-divider {
      height: 1px;
      background: var(--gray-200);
      margin: 1.5rem 1.25rem;
    }

    .main-content {
      flex: 1;
      margin-left: 260px;
      padding: 2rem;
      background: var(--gray-50);
      min-height: calc(100vh - 72px);
    }

    .page-header {
      margin-bottom: 2rem;
      animation: fadeIn 0.5s ease;
    }

    .page-title {
      font-family: 'Playfair Display', Georgia, serif;
      font-size: 1.75rem;
      font-weight: 600;
      color: var(--black);
      letter-spacing: -0.02em;
      margin-bottom: 0.5rem;
    }

    .page-subtitle {
      font-size: 0.9375rem;
      color: var(--gray-500);
    }

    .stat-card {
      background: var(--white);
      border: 1px solid var(--gray-200);
      border-radius: 20px;
      padding: 1.75rem;
      position: relative;
      overflow: hidden;
      animation: fadeInScale 0.5s ease;
      transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
    }

    .stat-card::before {
      content: '';
      position: absolute;
      top: 0;
      left: 0;
      width: 4px;
      height: 100%;
      background: var(--black);
    }

    .stat-card:hover {
      transform: translateY(-4px);
      box-shadow: 0 12px 40px rgba(0, 0, 0, 0.08);
      border-color: var(--gray-300);
    }

    .stat-card:nth-child(1) { animation-delay: 0.1s; }
    .stat-card:nth-child(2) { animation-delay: 0.2s; }

    .stat-header {
      display: flex;
      justify-content: space-between;
      align-items: flex-start;
      margin-bottom: 1rem;
    }

    .stat-label {
      font-size: 0.75rem;
      font-weight: 600;
      color: var(--gray-500);
      text-transform: uppercase;
      letter-spacing: 0.08em;
    }

    .stat-icon {
      width: 44px;
      height: 44px;
      background: var(--gray-50);
      border-radius: 12px;
      display: flex;
      align-items: center;
      justify-content: center;
      transition: all 0.3s ease;
    }

    .stat-card:hover .stat-icon {
      transform: scale(1.1) rotate(5deg);
      background: var(--black);
    }

    .stat-card:hover .stat-icon i {
      color: var(--white);
    }

    .stat-icon i {
      font-size: 1.125rem;
      color: var(--black);
      transition: color 0.3s ease;
    }

    .stat-value {
      font-family: 'Playfair Display', Georgia, serif;
      font-size: 2.25rem;
      font-weight: 600;
      color: var(--black);
      letter-spacing: -0.03em;
      line-height: 1;
    }

    .stat-change {
      display: inline-flex;
      align-items: center;
      gap: 0.25rem;
      margin-top: 0.75rem;
      font-size: 0.8125rem;
      color: var(--gray-500);
    }

    .loading-spinner {
      position: relative;
      width: 60px;
      height: 60px;
      margin: 4rem auto;
    }

    .loading-spinner::before,
    .loading-spinner::after {
      content: '';
      position: absolute;
      inset: 0;
      border-radius: 50%;
      border: 3px solid transparent;
    }

    .loading-spinner::before {
      border-top-color: var(--gray-200);
    }

    .loading-spinner::after {
      border-top-color: var(--black);
      animation: spin 0.8s linear infinite;
    }

    .loading-spinner .logo-loading {
      position: absolute;
      inset: 0;
      display: flex;
      align-items: center;
      justify-content: center;
      animation: pulse 1.5s ease-in-out infinite;
    }

    .loading-spinner .logo-loading i {
      font-size: 1.25rem;
      color: var(--gray-400);
    }

    .empty-state {
      text-align: center;
      padding: 5rem 2rem;
      animation: fadeIn 0.5s ease;
    }

    .empty-state-icon {
      width: 100px;
      height: 100px;
      background: linear-gradient(135deg, var(--gray-100) 0%, var(--gray-50) 100%);
      border-radius: 50%;
      display: flex;
      align-items: center;
      justify-content: center;
      margin: 0 auto 2rem;
      position: relative;
      animation: bounceIn 0.6s ease;
    }

    .empty-state-icon::before {
      content: '';
      position: absolute;
      inset: -8px;
      border: 2px dashed var(--gray-200);
      border-radius: 50%;
      animation: spin 20s linear infinite;
    }

    .empty-state-icon i {
      font-size: 2.5rem;
      color: var(--gray-400);
    }

    .empty-state-title {
      font-family: 'Playfair Display', Georgia, serif;
      font-size: 1.25rem;
      font-weight: 600;
      color: var(--black);
      margin-bottom: 0.5rem;
    }

    .empty-state-text {
      font-size: 0.9375rem;
      color: var(--gray-500);
      max-width: 320px;
      margin: 0 auto;
    }

    .header-content {
      display: flex;
      justify-content: space-between;
      align-items: flex-start;
    }

    .btn-primary {
      display: inline-flex;
      align-items: center;
      gap: 0.5rem;
      padding: 0.75rem 1.5rem;
      background: var(--black);
      color: var(--white);
      border: none;
      border-radius: 12px;
      font-family: inherit;
      font-size: 0.875rem;
      font-weight: 500;
      cursor: pointer;
      transition: all 0.25s cubic-bezier(0.4, 0, 0.2, 1);
      position: relative;
      overflow: hidden;
    }

    .btn-primary::before {
      content: '';
      position: absolute;
      inset: 0;
      background: linear-gradient(90deg, transparent, rgba(255,255,255,0.2), transparent);
      transform: translateX(-100%);
      transition: transform 0.5s ease;
    }

    .btn-primary:hover {
      background: var(--gray-800);
      transform: translateY(-2px);
      box-shadow: 0 8px 24px rgba(0, 0, 0, 0.2);
    }

    .btn-primary:hover::before {
      transform: translateX(100%);
    }

    .btn-primary:active {
      transform: translateY(0);
    }

    .form-panel {
      background: var(--white);
      border: 1px solid var(--gray-200);
      border-radius: 20px;
      margin-bottom: 1.5rem;
      overflow: hidden;
      animation: slideDown 0.4s cubic-bezier(0.34, 1.56, 0.64, 1);
      box-shadow: 0 4px 20px rgba(0, 0, 0, 0.04);
    }

    .form-panel-header {
      display: flex;
      justify-content: space-between;
      align-items: center;
      padding: 1.25rem 1.5rem;
      border-bottom: 1px solid var(--gray-200);
      background: linear-gradient(180deg, var(--gray-50) 0%, transparent 100%);
    }

    .form-panel-header h3 {
      font-family: 'Playfair Display', Georgia, serif;
      font-size: 1.125rem;
      font-weight: 600;
      color: var(--black);
      margin: 0;
    }

    .btn-close-panel {
      width: 32px;
      height: 32px;
      background: var(--gray-100);
      border: none;
      border-radius: 8px;
      cursor: pointer;
      display: flex;
      align-items: center;
      justify-content: center;
      color: var(--gray-500);
      transition: all 0.2s ease;
    }

    .btn-close-panel:hover {
      background: var(--gray-200);
      color: var(--black);
      transform: rotate(90deg);
    }

    .form-panel-body {
      padding: 1.5rem;
    }

    .form-row {
      display: grid;
      grid-template-columns: repeat(4, 1fr);
      gap: 1rem;
    }

    .form-group {
      display: flex;
      flex-direction: column;
      gap: 0.5rem;
    }

    .form-label {
      font-size: 0.75rem;
      font-weight: 600;
      color: var(--gray-500);
      text-transform: uppercase;
      letter-spacing: 0.05em;
      transition: color 0.2s ease;
    }

    .form-input {
      padding: 0.875rem 1rem;
      border: 1px solid var(--gray-200);
      border-radius: 10px;
      font-family: inherit;
      font-size: 0.9375rem;
      color: var(--black);
      background: var(--gray-50);
      transition: all 0.2s ease;
    }

    .form-input:focus {
      outline: none;
      border-color: var(--black);
      background: var(--white);
      box-shadow: 0 0 0 4px rgba(10, 10, 10, 0.05);
    }

    .form-input:focus + .form-label {
      color: var(--black);
    }

    .form-input::placeholder {
      color: var(--gray-400);
    }

    .form-input.error {
      border-color: #DC2626;
      background: #FEF2F2;
    }

    .form-input.success {
      border-color: #059669;
      background: #ECFDF5;
    }

    .form-error {
      font-size: 0.75rem;
      color: #DC2626;
      margin-top: 0.25rem;
      display: none;
    }

    .form-input.error + .form-error {
      display: block;
    }

    .form-actions {
      display: flex;
      gap: 0.75rem;
      margin-top: 1.5rem;
    }

    .btn-save {
      display: inline-flex;
      align-items: center;
      gap: 0.5rem;
      padding: 0.875rem 1.75rem;
      background: var(--black);
      color: var(--white);
      border: none;
      border-radius: 10px;
      font-family: inherit;
      font-size: 0.875rem;
      font-weight: 500;
      cursor: pointer;
      transition: all 0.25s cubic-bezier(0.4, 0, 0.2, 1);
    }

    .btn-save:hover {
      background: var(--gray-800);
      transform: translateY(-1px);
      box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
    }

    .btn-cancel {
      display: inline-flex;
      align-items: center;
      padding: 0.875rem 1.75rem;
      background: transparent;
      color: var(--gray-500);
      border: 1px solid var(--gray-300);
      border-radius: 10px;
      font-family: inherit;
      font-size: 0.875rem;
      font-weight: 500;
      cursor: pointer;
      transition: all 0.2s ease;
    }

    .btn-cancel:hover {
      border-color: var(--gray-400);
      color: var(--gray-700);
      background: var(--gray-50);
    }

    .search-bar {
      display: flex;
      align-items: center;
      gap: 0.75rem;
      padding: 0.875rem 1rem;
      background: var(--white);
      border: 1px solid var(--gray-200);
      border-radius: 12px;
      margin-bottom: 1.5rem;
      max-width: 400px;
      transition: all 0.2s ease;
    }

    .search-bar:focus-within {
      border-color: var(--black);
      box-shadow: 0 0 0 4px rgba(10, 10, 10, 0.05);
    }

    .search-bar i {
      color: var(--gray-400);
      font-size: 1rem;
      transition: color 0.2s ease;
    }

    .search-bar:focus-within i {
      color: var(--black);
    }

    .search-bar input {
      flex: 1;
      border: none;
      background: transparent;
      font-family: inherit;
      font-size: 0.9375rem;
      color: var(--black);
      outline: none;
    }

    .search-bar input::placeholder {
      color: var(--gray-400);
    }

    .table-container {
      background: var(--white);
      border: 1px solid var(--gray-200);
      border-radius: 16px;
      overflow: hidden;
      animation: fadeInScale 0.4s ease;
    }

    .table-wrapper {
      overflow-x: auto;
    }

    .data-table {
      width: 100%;
      border-collapse: collapse;
      min-width: 600px;
    }

    .data-table th {
      padding: 1rem 1.25rem;
      text-align: left;
      font-size: 0.75rem;
      font-weight: 600;
      color: var(--gray-500);
      text-transform: uppercase;
      letter-spacing: 0.05em;
      background: var(--gray-50);
      border-bottom: 1px solid var(--gray-200);
      cursor: pointer;
      user-select: none;
      transition: all 0.2s ease;
      white-space: nowrap;
    }

    .data-table th:hover {
      background: var(--gray-100);
      color: var(--black);
    }

    .data-table th.sorted {
      color: var(--black);
    }

    .data-table th.sorted::after {
      content: '';
      display: inline-block;
      width: 0;
      height: 0;
      margin-left: 0.5rem;
      border-left: 4px solid transparent;
      border-right: 4px solid transparent;
    }

    .data-table th.sorted.asc::after {
      border-bottom: 5px solid var(--black);
    }

    .data-table th.sorted.desc::after {
      border-top: 5px solid var(--black);
    }

    .data-table td {
      padding: 1rem 1.25rem;
      font-size: 0.9375rem;
      color: var(--gray-700);
      border-bottom: 1px solid var(--gray-100);
      vertical-align: middle;
      transition: all 0.15s ease;
    }

    .data-table tbody tr {
      transition: all 0.15s ease;
      animation: fadeIn 0.3s ease;
      animation-fill-mode: both;
    }

    .data-table tbody tr:nth-child(1) { animation-delay: 0.05s; }
    .data-table tbody tr:nth-child(2) { animation-delay: 0.1s; }
    .data-table tbody tr:nth-child(3) { animation-delay: 0.15s; }
    .data-table tbody tr:nth-child(4) { animation-delay: 0.2s; }
    .data-table tbody tr:nth-child(5) { animation-delay: 0.25s; }

    .data-table tbody tr:hover {
      background: var(--gray-50);
      transform: scale(1.005);
      box-shadow: 0 2px 8px rgba(0, 0, 0, 0.04);
    }

    .data-table tbody tr:hover td {
      color: var(--black);
    }

    .data-table tbody tr:last-child td {
      border-bottom: none;
    }

    .badge-id {
      display: inline-flex;
      align-items: center;
      justify-content: center;
      min-width: 32px;
      height: 24px;
      padding: 0 0.5rem;
      background: var(--gray-100);
      border-radius: 6px;
      font-size: 0.75rem;
      font-weight: 600;
      color: var(--gray-600);
      transition: all 0.2s ease;
    }

    .data-table tbody tr:hover .badge-id {
      background: var(--black);
      color: var(--white);
    }

    .badge-stock {
      display: inline-flex;
      align-items: center;
      justify-content: center;
      min-width: 40px;
      height: 28px;
      padding: 0 0.75rem;
      background: var(--gray-100);
      border-radius: 8px;
      font-size: 0.8125rem;
      font-weight: 500;
      color: var(--gray-700);
      transition: all 0.2s ease;
    }

    .badge-stock.low {
      background: #FEE2E2;
      color: #DC2626;
    }

    .badge-stock.low::before {
      content: '';
      display: inline-block;
      width: 6px;
      height: 6px;
      background: #DC2626;
      border-radius: 50%;
      margin-right: 0.375rem;
      animation: pulse 1.5s ease-in-out infinite;
    }

    .price {
      font-weight: 600;
      color: var(--black);
    }

    .badge-category {
      display: inline-flex;
      align-items: center;
      padding: 0.375rem 0.75rem;
      background: var(--gray-100);
      border-radius: 6px;
      font-size: 0.8125rem;
      color: var(--gray-600);
      transition: all 0.2s ease;
    }

    .data-table tbody tr:hover .badge-category {
      background: var(--gray-200);
    }

    .rfc-text {
      font-family: 'DM Mono', 'Courier New', monospace;
      font-size: 0.875rem;
      color: var(--gray-600);
    }

    .action-buttons {
      display: flex;
      gap: 0.5rem;
    }

    .btn-action {
      width: 36px;
      height: 36px;
      border: 1px solid var(--gray-200);
      border-radius: 10px;
      background: var(--white);
      cursor: pointer;
      display: flex;
      align-items: center;
      justify-content: center;
      transition: all 0.2s cubic-bezier(0.4, 0, 0.2, 1);
      position: relative;
    }

    .btn-action::before {
      content: attr(data-tooltip);
      position: absolute;
      bottom: calc(100% + 8px);
      left: 50%;
      transform: translateX(-50%) scale(0.8);
      padding: 0.5rem 0.75rem;
      background: var(--black);
      color: var(--white);
      font-size: 0.75rem;
      font-weight: 500;
      white-space: nowrap;
      border-radius: 6px;
      opacity: 0;
      pointer-events: none;
      transition: all 0.2s ease;
    }

    .btn-action:hover::before {
      opacity: 1;
      transform: translateX(-50%) scale(1);
    }

    .btn-action i {
      font-size: 0.875rem;
    }

    .btn-edit {
      color: var(--gray-600);
    }

    .btn-edit:hover {
      background: var(--gray-50);
      border-color: var(--gray-300);
      color: var(--black);
      transform: translateY(-2px);
    }

    .btn-delete {
      color: var(--gray-500);
    }

    .btn-delete:hover {
      background: #FEE2E2;
      border-color: #FECACA;
      color: #DC2626;
      transform: translateY(-2px);
    }

    .view-fade {
      animation: fadeIn 0.4s ease;
    }

    @media (max-width: 992px) {
      .form-row {
        grid-template-columns: repeat(2, 1fr);
      }
    }

    @media (max-width: 768px) {
      .menu-toggle {
        display: flex;
      }

      .sidebar {
        transform: translateX(-100%);
      }

      .sidebar.open {
        transform: translateX(0);
      }

      .sidebar-overlay {
        display: block;
      }

      .main-content {
        margin-left: 0;
        padding: 1.5rem;
      }

      .header {
        padding: 0 1rem;
      }

      .user-name {
        display: none;
      }

      .header-content {
        flex-direction: column;
        gap: 1rem;
      }

      .form-row {
        grid-template-columns: 1fr;
      }

      .empty-state {
        padding: 3rem 1rem;
      }

      .empty-state-icon {
        width: 80px;
        height: 80px;
      }

      .empty-state-icon i {
        font-size: 2rem;
      }
    }
  </style>
</head>

<body>
  <header class="header">
    <div class="header-left">
      <button class="menu-toggle" onclick="toggleSidebar()">
        <i class="bi bi-list"></i>
      </button>
      <a href="#" class="logo">
        <div class="logo-mark">
          <i class="bi bi-box-seam"></i>
        </div>
        <span class="logo-text">Inventarios</span>
      </a>
    </div>
    <div class="header-right">
      <div class="user-menu">
        <button class="user-trigger" id="userTrigger" onclick="toggleUserMenu()">
          <div class="user-avatar">
            <i class="bi bi-person"></i>
          </div>
          <span class="user-name"><?php echo htmlspecialchars($usuario); ?></span>
          <i class="bi bi-chevron-down user-chevron"></i>
        </button>
        <div class="user-dropdown" id="userDropdown">
          <div class="user-dropdown-header">
            <div class="user-dropdown-name"><?php echo htmlspecialchars($usuario); ?></div>
            <div class="user-dropdown-role">Administrador</div>
          </div>
          <form method="POST" action="/Tienda/public/logout">
            <button type="submit" class="user-dropdown-item danger">
              <i class="bi bi-box-arrow-right"></i>
              <span>Cerrar sesión</span>
            </button>
          </form>
        </div>
      </div>
    </div>
  </header>

  <div class="sidebar-overlay" onclick="toggleSidebar()"></div>

  <div class="layout">
    <aside class="sidebar" id="sidebar">
      <nav class="sidebar-nav">
        <div class="nav-item">
          <a class="nav-link" href="/Tienda/public/dashboard" data-nav="dashboard" onclick="navegar(event, 'dashboard'); return false;">
            <i class="bi bi-grid"></i>
            <span>Dashboard</span>
          </a>
        </div>
        <div class="nav-item">
          <a class="nav-link" href="/Tienda/public/productos" data-nav="productos" onclick="navegar(event, 'productos'); return false;">
            <i class="bi bi-cart3"></i>
            <span>Productos</span>
          </a>
        </div>
        <div class="nav-item">
          <a class="nav-link" href="/Tienda/public/clientes" data-nav="clientes" onclick="navegar(event, 'clientes'); return false;">
            <i class="bi bi-people"></i>
            <span>Clientes</span>
          </a>
        </div>
        <div class="sidebar-divider"></div>
        <div class="nav-item">
          <a class="nav-link" href="/Tienda/public/archivos" data-nav="archivos" onclick="navegar(event, 'archivos'); return false;">
            <i class="bi bi-folder2-open"></i>
            <span>Archivos</span>
          </a>
        </div>
      </nav>
    </aside>

    <main class="main-content">
      <div id="cuerpo">
        <?php if (isset($total_productos)): ?>
          <div class="page-header">
            <h1 class="page-title">Dashboard</h1>
            <p class="page-subtitle">Resumen de tu inventario</p>
          </div>
          <div class="row g-5">
            <div class="col-md-6">
              <div class="stat-card">
                <div class="stat-header">
                  <span class="stat-label">Total Productos</span>
                  <div class="stat-icon">
                    <i class="bi bi-cart3"></i>
                  </div>
                </div>
                <div class="stat-value"><?php echo $total_productos; ?></div>
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
                <div class="stat-value"><?php echo $total_clientes; ?></div>
                <div class="stat-change">
                  <i class="bi bi-check-circle"></i>
                  <span>Clientes registrados</span>
                </div>
              </div>
            </div>
          </div>
          <div class="empty-state" style="margin-top: 3rem;">
            <div class="empty-state-icon">
              <i class="bi bi-arrow-left-circle"></i>
            </div>
            <h3 class="empty-state-title">Bienvenido al Dashboard</h3>
            <p class="empty-state-text">Selecciona una opción del menú lateral para comenzar a gestionar tu inventario</p>
          </div>
        <?php else: ?>
          <div class="empty-state">
            <div class="empty-state-icon">
              <i class="bi bi-box-seam"></i>
            </div>
            <h3 class="empty-state-title">Cargando...</h3>
            <p class="empty-state-text">Un momento mientras cargamos tu espacio de trabajo</p>
          </div>
        <?php endif; ?>
      </div>
    </main>
  </div>

  <script src="/Tienda/public/js/bootstrap.bundle.min.js"></script>
  <script>
    function toggleSidebar() {
      const sidebar = document.getElementById('sidebar');
      const overlay = document.querySelector('.sidebar-overlay');
      sidebar.classList.toggle('open');
      overlay.classList.toggle('show');
    }

    function toggleUserMenu() {
      const trigger = document.getElementById('userTrigger');
      const dropdown = document.getElementById('userDropdown');
      trigger.classList.toggle('open');
      dropdown.classList.toggle('show');
    }

    document.addEventListener('click', function(event) {
      const userMenu = document.querySelector('.user-menu');
      if (userMenu && !userMenu.contains(event.target)) {
        document.getElementById('userTrigger')?.classList.remove('open');
        document.getElementById('userDropdown')?.classList.remove('show');
      }
    });

    function navegar(event, vista) {
      event.preventDefault();
      const url = '/Tienda/public/' + vista;
      history.pushState({ vista: vista }, '', url);
      cargarVista(vista);
    }

    function cargarVista(vista) {
      const cuerpo = document.getElementById('cuerpo');
      cuerpo.classList.remove('view-fade');
      cuerpo.innerHTML = '<div class="loading-spinner"><div class="logo-loading"><i class="bi bi-box-seam"></i></div></div>';

      if (window.innerWidth < 768) {
        toggleSidebar();
      }

      const url = '/Tienda/public/' + vista;

      fetch(url, {
        headers: {
          'X-Requested-With': 'XMLHttpRequest'
        }
      })
        .then(response => {
          if (!response.ok) throw new Error('Page not found');
          return response.text();
        })
        .then(data => {
          cuerpo.classList.add('view-fade');
          cuerpo.innerHTML = data;
          actualizarNavActivo(vista);
          initTableSort();
        })
        .catch(error => {
          cuerpo.innerHTML = '<div class="empty-state"><div class="empty-state-icon"><i class="bi bi-exclamation-triangle"></i></div><h3 class="empty-state-title">Error al cargar</h3><p class="empty-state-text">No pudimos cargar la página solicitada</p></div>';
        });
    }

    function actualizarNavActivo(vista) {
      document.querySelectorAll('.nav-link').forEach(el => el.classList.remove('active'));
      const link = document.querySelector('.nav-link[data-nav="' + vista + '"]');
      if (link) link.classList.add('active');
    }

    function initTableSort() {
      document.querySelectorAll('.data-table th').forEach((th, index) => {
        if (index === 0) return;
        th.style.cursor = 'pointer';
        th.addEventListener('click', () => sortTable(th, index));
      });
    }

    function sortTable(th, columnIndex) {
      const table = th.closest('table');
      const tbody = table.querySelector('tbody');
      const rows = Array.from(tbody.querySelectorAll('tr'));
      const isAsc = th.classList.contains('asc');

      document.querySelectorAll('.data-table th').forEach(h => {
        h.classList.remove('asc', 'desc', 'sorted');
      });

      th.classList.add('sorted', isAsc ? 'desc' : 'asc');

      rows.sort((a, b) => {
        const aText = a.cells[columnIndex].textContent.trim();
        const bText = b.cells[columnIndex].textContent.trim();
        return isAsc ? bText.localeCompare(aText) : aText.localeCompare(bText);
      });

      rows.forEach(row => tbody.appendChild(row));
    }

    document.addEventListener('DOMContentLoaded', () => {
      initTableSort();

      const currentPath = window.location.pathname;
      const match = currentPath.match(/\/Tienda\/public\/(\w+)/);
      if (match) {
        const vista = match[1];
        const navLink = document.querySelector('.nav-link[data-nav="' + vista + '"]');
        if (navLink) navLink.classList.add('active');
      }

      window.addEventListener('popstate', (e) => {
        if (e.state && e.state.vista) {
          cargarVista(e.state.vista);
        } else {
          const path = window.location.pathname;
          const match = path.match(/\/Tienda\/public\/(\w+)/);
          if (match) {
            cargarVista(match[1]);
          }
        }
      });
    });
  </script>
</body>

</html>
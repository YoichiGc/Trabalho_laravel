<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sistema Biblioteca - @yield('title')</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <style>
        /* ESTILIZAÇÃO MUITO FEIA E SIMPLES */
        body {
            background: #ffffffff !important;
            font-family: Arial, sans-serif !important;
            color: #fffdfdff !important;
        }

        .navbar {
            background: #666 !important;
            border-bottom: 2px solid #333 !important;
        }

        .navbar-brand {
            font-size: 1.5rem !important;
            color: #fff !important;
            font-weight: bold !important;
        }

        .navbar-toggler {
            border: 2px solid #fff !important;
        }

        .navbar-toggler-icon {
            background-image: url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 30 30'%3e%3cpath stroke='rgba%28255, 255, 255, 1%29' stroke-linecap='round' stroke-miterlimit='10' stroke-width='2' d='M4 7h22M4 15h22M4 23h22'/%3e%3c/svg%3e") !important;
        }

        .offcanvas {
            background: #888 !important;
        }

        .offcanvas-header {
            background: #666 !important;
            border-bottom: 2px solid #333 !important;
        }

        .offcanvas-title {
            color: #fff !important;
            font-weight: bold !important;
        }

        .list-group-item {
            background: #aaa !important;
            color: #333 !important;
            border: 1px solid #666 !important;
            margin: 2px 0 !important;
            font-weight: bold !important;
        }

        .list-group-item:hover {
            background: #999 !important;
            color: #000 !important;
        }

        .list-group-item.active {
            background: #333 !important;
            color: #fff !important;
        }

        .main-content {
            padding: 20px !important;
            background: #eee !important;
        }

   .card {
    background: #fff !important;
    border: none !important;
    border-radius: 5px !important;
}

        .card-header {
            background: #666 !important;
            color: #fff !important;
            font-weight: bold !important;
        }

        .btn {
            border-radius: 3px !important;
            border: 1px solid #2cdff7ff !important;
            font-weight: bold !important;
        }

        .btn-primary {
            background: #555 !important;
            color: #ffffffff !important;
            border-color: #333 !important;
        }

        .btn-primary:hover {
            background: #555 !important;
        }

        .btn-success {
            background: #555 !important;
            color: #fff !important;
            border-color: #333 !important;
        }

        .btn-warning {
            background: #72f57db0 !important;
            color: #fff !important;
            border-color: #333 !important;
        }

        .btn-danger {
            background: #ff1d1dff !important;
            color: #fff !important;
            border-color: #333 !important;
        }

        .btn-info {
            background: #666 !important;
            color: #fff !important;
            border-color: #333 !important;
        }

        .btn-secondary {
            background: #ff0000ff !important;
            color: #fff !important;
            border-color: #333 !important;
        }

        .table {
            border: 2px solid #666 !important;
            background: #fff !important;
        }

        .table thead th {
            background: #666 !important;
            color: #fff !important;
            border: 1px solid #333 !important;
            font-weight: bold !important;
        }

        .table tbody tr {
            background: #fff !important;
            color: #333 !important;
        }

        .table tbody tr:hover {
            background: #f0f0f0 !important;
        }

        .table tbody tr:nth-child(even) {
            background: #f5f5f5 !important;
        }

        .form-control, .form-select {
            border: 1px solid #666 !important;
            background: #fff !important;
            color: #333 !important;
            border-radius: 3px !important;
        }

        .form-control:focus, .form-select:focus {
            border-color: #333 !important;
            background: #fff !important;
            color: #333 !important;
        }

        .input-group-text {
            background: #666 !important;
            color: #fff !important;
            border: 1px solid #333 !important;
        }

        .badge {
            background: #666 !important;
            color: #fff !important;
            border: 1px solid #333 !important;
        }

        .alert {
            border: 2px solid #666 !important;
            font-weight: bold !important;
        }

        .alert-info {
            background: #e6f3ff !important;
            color: #333 !important;
            border-color: #666 !important;
        }

        .alert-success {
            background: #e6ffe6 !important;
            color: #333 !important;
            border-color: #666 !important;
        }

        .page-link {
            background: #fff !important;
            color: #333 !important;
            border: 1px solid #666 !important;
        }

        .page-link:hover {
            background: #666 !important;
            color: #fff !important;
        }

        .page-item.active .page-link {
            background: #666 !important;
            color: #fff !important;
        }

        h1, h2, h3, h4, h5, h6 {
            color: #333 !important;
            font-weight: bold !important;
        }

        .card-body {
            background: #fff !important;
        }

        .text-muted {
            color: #666 !important;
        }

        /* RESPONSIVIDADE */
        @media (max-width: 768px) {
            .main-content {
                padding: 15px !important;
            }
        }
    </style>
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-primary">
        <div class="container-fluid">
            <a class="navbar-brand" href="{{ route('home') }}">
                📚 Sistema Biblioteca
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="offcanvas" data-bs-target="#sidebarMenu" aria-controls="sidebarMenu">
                <span class="navbar-toggler-icon"></span>
            </button>
        </div>
    </nav>

    <div class="offcanvas offcanvas-start" tabindex="-1" id="sidebarMenu" aria-labelledby="sidebarMenuLabel">
        <div class="offcanvas-header">
            <h5 class="offcanvas-title" id="sidebarMenuLabel">Menu</h5>
            <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
        </div>
        <div class="offcanvas-body">
            <div class="list-group">
                <a href="{{ route('home') }}" class="list-group-item list-group-item-action {{ Request::is('/') ? 'active' : '' }}">
                    🏠 Início
                </a>
                <a href="{{ route('books.index') }}" class="list-group-item list-group-item-action {{ Request::is('books*') ? 'active' : '' }}">
                    📖 Livros
                </a>
                <a href="{{ route('authors.index') }}" class="list-group-item list-group-item-action {{ Request::is('authors*') ? 'active' : '' }}">
                    👤 Autores
                </a>
                <a href="{{ route('categories.index') }}" class="list-group-item list-group-item-action {{ Request::is('categories*') ? 'active' : '' }}">
                    🏷️ Categorias
                </a>
            </div>
        </div>
    </div>

    <div class="container-fluid">
        <div class="main-content">
            @yield('content')
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
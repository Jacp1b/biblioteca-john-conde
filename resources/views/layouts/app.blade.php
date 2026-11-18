<!doctype html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title', 'Biblioteca de John Conde')</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        :root {
            color-scheme: light;
            --ink: #111;
            --muted: #666;
            --line: #dedede;
            --paper: #fff;
            --wash: #f5f5f5;
        }

        body { background: var(--wash) !important; color: var(--ink); }
        .navbar { background: var(--ink) !important; }
        .navbar-brand, .navbar .nav-link { color: #fff !important; }
        .navbar .nav-link { opacity: .78; }
        .navbar .nav-link:hover, .navbar .nav-link:focus { opacity: 1; }
        .card, .table { --bs-card-bg: var(--paper); --bs-table-bg: var(--paper); }
        .card { border-color: var(--line); }
        .table-light { --bs-table-bg: #eee; --bs-table-color: var(--ink); }
        .text-secondary { color: var(--muted) !important; }
        a:not(.btn):not(.page-link) { color: var(--ink); }
        .btn-primary, .btn-outline-primary {
            --bs-btn-color: #fff;
            --bs-btn-bg: var(--ink);
            --bs-btn-border-color: var(--ink);
            --bs-btn-hover-color: var(--ink);
            --bs-btn-hover-bg: #fff;
            --bs-btn-hover-border-color: var(--ink);
            --bs-btn-active-color: var(--ink);
            --bs-btn-active-bg: #eee;
            --bs-btn-active-border-color: var(--ink);
            --bs-btn-disabled-color: #fff;
            --bs-btn-disabled-bg: #555;
            --bs-btn-disabled-border-color: #555;
        }
        .btn-outline-primary { --bs-btn-color: var(--ink); --bs-btn-bg: #fff; }
        .btn-outline-secondary, .btn-outline-danger {
            --bs-btn-color: var(--ink);
            --bs-btn-border-color: #888;
            --bs-btn-hover-color: #fff;
            --bs-btn-hover-bg: var(--ink);
            --bs-btn-hover-border-color: var(--ink);
        }
        .form-control:focus, .form-select:focus, .form-check-input:focus {
            border-color: var(--ink);
            box-shadow: 0 0 0 .2rem rgb(17 17 17 / 15%);
        }
        .form-check-input:checked { background-color: var(--ink); border-color: var(--ink); }
        .form-control, .form-select { border-color: #c9c9c9; }
        .alert-success, .alert-danger { color: var(--ink); background: #fff; border-color: #999; }
        .badge.text-bg-success { color: #fff !important; background: var(--ink) !important; }
        .badge.text-bg-secondary { color: var(--ink) !important; background: #e5e5e5 !important; }
        .page-link { color: var(--ink); border-color: var(--line); }
        .page-link:hover { color: var(--ink); background: #eee; border-color: var(--line); }
        .active > .page-link, .page-link.active { color: #fff; background: var(--ink); border-color: var(--ink); }
        footer { background: #fff !important; border-color: var(--line) !important; }
    </style>
</head>
<body class="d-flex flex-column min-vh-100">
    <nav class="navbar navbar-expand-lg navbar-dark">
        <div class="container">
            <a class="navbar-brand fw-semibold" href="{{ route('libros.index') }}">Biblioteca de John Conde</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navegacion" aria-controls="navegacion" aria-expanded="false" aria-label="Mostrar navegación">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navegacion">
                <div class="navbar-nav ms-auto">
                    <a class="nav-link" href="{{ route('libros.index') }}">Libros</a>
                    <a class="nav-link" href="{{ route('categorias.index') }}">Categorías</a>
                </div>
            </div>
        </div>
    </nav>

    <main class="container py-4 flex-grow-1">
        @if (session('ok'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('ok') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Cerrar"></button>
            </div>
        @endif
        @if (session('error'))
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                {{ session('error') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Cerrar"></button>
            </div>
        @endif
        @yield('content')
    </main>

    <footer class="bg-white border-top py-3">
        <div class="container text-center text-secondary small">
            John Alejandro Conde Parra · Ficha 3478025 · 2026
        </div>
    </footer>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        document.querySelectorAll('form[data-custom-validation]').forEach((form) => {
            form.addEventListener('invalid', (event) => {
                const field = event.target;
                if (field.validity.valueMissing) {
                    field.setCustomValidity(field.dataset.requiredMessage || 'Completa este campo para continuar.');
                } else if (field.validity.tooShort) {
                    field.setCustomValidity(field.dataset.minlengthMessage || 'El texto ingresado es demasiado corto.');
                } else if (field.validity.rangeUnderflow) {
                    field.setCustomValidity(field.dataset.minMessage || 'El valor está por debajo del mínimo permitido.');
                } else if (field.validity.rangeOverflow) {
                    field.setCustomValidity(field.dataset.maxMessage || 'El valor supera el máximo permitido.');
                }
            }, true);

            form.addEventListener('input', (event) => event.target.setCustomValidity(''));
            form.addEventListener('change', (event) => event.target.setCustomValidity(''));
        });
    </script>
</body>
</html>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gudang Clipper</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
    <link rel="stylesheet" href="{{asset('css/theme-variable.css')  }}">
    <link rel="stylesheet" href="{{asset('css/main.css')  }}">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.min.css">
    <link rel="shortcut icon" href="{{ asset('images/icons/icon-gudang-clipper.png') }}" type="image/x-icon">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <style>
    /* 1. Default: Sembunyikan pesan peringatan di layar lebar */
    .mobile-warning {
        display: none;
        flex-direction: column;
        justify-content: center;
        align-items: center;
        height: 100vh;
        text-align: center;
        padding: 20px;
        background-color: var(--main);
        color: white;
    }

    /* 2. Logika ketika lebar layar di bawah 1000px */
    /* @media (max-width: 900px) {
        .mobile-warning {
            display: flex;
        }

        main, nav, footer {
            display: none !important;
        }
    } */
</style>

    @stack('styles')
</head>
<body>

    <!-- <div class="mobile-warning">
        <h1>Oops! 🚫</h1>
        <p>Gudang Clipper saat ini hanya optimal dibuka melalui Laptop atau Desktop (layar lebar).</p>
    </div> -->

    @include('layouts.navbar')

    <main>
        <aside>
            @include('components.sidebar')
        </aside>
        <section>
            @include('components.sessionMessage')
            @yield('content')
        </section>
    </main>

    @include('layouts.footer')

    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js" integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/ui/1.13.2/jquery-ui.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    @stack('scripts')

    <script>

    </script>
</body>
</html>
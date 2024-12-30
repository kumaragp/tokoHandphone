<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title')</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
</head>

<body class="d-flex flex-column min-vh-100"> <!-- Menambahkan kelas flex-column dan min-vh-100 pada body -->

    <!-- Header yang sticky di bagian atas dengan penyesuaian ukuran -->
    <header class="bg-primary text-white text-center py-3 sticky-top"> <!-- Mengurangi padding header -->
        <a href="{{ route('home') }}" class="text-white text-decoration-none">
            <h1 class="fw-bold fs-4">Toko Handphone</h1> <!-- Mengurangi ukuran font h1 -->
        </a>
    </header>

    <!-- Main Content -->
    <div class="container mt-5">
        @yield('content')
    </div>

    <!-- Footer yang tetap di bawah -->
    <footer class="bg-dark text-light text-center py-3 mt-5">
        <p class="mb-1">&copy; 2024 Toko Handphone. Semua hak cipta dilindungi.</p>
        <p class="mb-0">
            <a href="#" class="text-light">Kebijakan Privasi</a> |
            <a href="#" class="text-light">Syarat & Ketentuan</a>
        </p>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL"
        crossorigin="anonymous"></script>
    @yield('scripts')
</body>

</html>
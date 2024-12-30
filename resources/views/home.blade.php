@extends('layouts.app')

@section('title', 'Home')

@section('content')

<div class="container">
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="container">
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarContent"
                aria-controls="navbarContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link fw-semibold" href="#home">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link fw-semibold" href="#about">About Us</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link fw-semibold" href="#products">Product</a>
                    </li>
                </ul>
                @auth
                    <div class="dropdown">
                        <button class="btn btn-outline-primary dropdown-toggle" type="button" id="userDropdown"
                            data-bs-toggle="dropdown" aria-expanded="false">
                            {{ auth()->user()->name }}
                        </button>
                        <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="userDropdown">
                            <li><a class="dropdown-item" href="{{ route('transactions') }}">Transaksi</a></li>
                            <li>
                                <form action="{{ route('logout') }}" method="POST">
                                    @csrf
                                    <button type="submit" class="dropdown-item">Logout</button>
                                </form>
                            </li>
                        </ul>
                    </div>
                @else
                    <div class="d-flex gap-3">
                        <a href="{{ route('login') }}" class="btn btn-outline-primary">Login</a>
                        <a href="{{ route('register') }}" class="btn btn-primary">Register</a>
                    </div>
                @endauth
            </div>
        </div>
    </nav>

    <!-- Home Section -->
    <section id="home" class="d-flex justify-content-center align-items-center text-center mt-5"
        style="height: 500px; background-image: url('{{ asset('images/background.jpg') }}'); background-size: cover; background-position: center;">
        <div>
            <h1 class="text-white display-4 fw-bold">Selamat Datang di Website Kami</h1>
            <p class="lead text-light">Temukan Produk Handphone Pilihan</p>
        </div>
    </section>

    <!-- About Us Section -->
    <section class="py-5" id="about">
        <h2 class="text-center display-5 fw-semibold mb-4">Tentang Kami</h2>
        <div class="row justify-content-center">
            <div class="col-md-8">
                <p class="fs-5 text-center">
                    Toko Handphone lebih dari sekadar toko handphone. Kami adalah mitra terpercaya Anda dalam dunia
                    gadget.
                    Dengan koleksi handphone terlengkap dan staf yang berpengalaman, kami siap memberikan pengalaman
                    belanja
                    yang menyenangkan. Dapatkan penawaran menarik, promo terbaru, dan konsultasi gratis di sini.
                </p>
            </div>
        </div>
    </section>

    <!-- Products Section -->
    <section id="products" class="py-5">
        <h2 class="text-center display-5 fw-semibold mb-4">Produk Kami</h2>
        <div class="row">
            @foreach ($products as $product)
                <div class="col-md-4 col-lg-3 mb-4">
                    <div class="card h-100 shadow-sm border-0 rounded">
                        <img src="{{ $product['image'] }}" class="card-img-top rounded-top" alt="{{ $product['name'] }}">
                        <div class="card-body d-flex flex-column">
                            <h5 class="card-title text-dark fw-semibold">{{ $product['name'] }}</h5>
                            <p class="card-title text-dark fw-semibold">Rp{{ number_format($product['price'], 0, ',', '.')}}</p>
                            <p class="card-text text-muted">{{ Str::limit($product['description'], 100) }}</p>
                            <a href="{{ route('product', $product['id']) }}" class="btn btn-primary mt-auto">Detail</a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </section>
</div>

<script>
    function scrollToSection(sectionId) {
        document.getElementById(sectionId).scrollIntoView({ behavior: 'smooth' });
    }
</script>
@endsection
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Katalog Menu | Crazy Bite's</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@700&family=Poppins:wght@400;600&display=swap" rel="stylesheet">
    <style>
        body { background-color: #F8F1E7; color: #5D4037; font-family: 'Poppins', sans-serif; }
        .navbar-custom { background-color: white; padding: 1rem 0; box-shadow: 0 2px 10px rgba(0,0,0,0.05); }
        .product-card {
            border: none;
            border-radius: 20px;
            background: white;
            padding: 20px;
            transition: 0.3s;
            height: 100%;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
            box-shadow: 0 4px 15px rgba(0,0,0,0.05);
        }
        .product-card:hover { transform: translateY(-10px); box-shadow: 0 10px 25px rgba(93, 64, 55, 0.1); }
        .product-card img { width: 100%; height: 250px; object-fit: cover; border-radius: 15px; margin-bottom: 15px; }
        .btn-order { background-color: #5D4037; color: white; border-radius: 10px; text-decoration: none; padding: 12px; display: block; text-align: center; font-weight: 600; transition: 0.3s; border: none; }
        .btn-order:hover { background-color: #3e2b25; color: #f8f1e7; }
        .section-title { font-family: 'Playfair Display', serif; font-weight: 700; font-size: 2.5rem; }
    </style>
</head>
<body>

   <nav class="navbar-custom mb-4">
    <div class="container d-flex justify-content-between align-items-center">
        <a class="navbar-brand fw-bold text-decoration-none" href="{{ route('home') }}" style="color: #5D4037;">Crazy Bite's</a>

        <div class="d-flex align-items-center gap-3">
            @auth
                <a href="{{ route('keranjang.index') }}" class="text-decoration-none" style="color: #5D4037; font-weight: 600;">
                    🛒 Keranjang
                </a>
                <a href="{{ route('pesanan.riwayat') }}" class="text-decoration-none" style="color: #5D4037; font-weight: 600;">
                    📋 Riwayat
                </a>

                <div class="ms-3 border-start ps-3">
                    <span class="me-2">Halo, <strong>{{ Auth::user()->nama_user }}</strong>!</span>
                    <form action="{{ route('logout') }}" method="POST" class="d-inline">
                        @csrf
                        <button type="submit" class="btn btn-outline-danger btn-sm">Keluar</button>
                    </form>
                </div>
            @else
                <a href="{{ route('login') }}" class="btn btn-outline-primary btn-sm">Login</a>
            @endauth
        </div>
    </div>
</nav>
    <div class="container py-5">
        <h2 class="text-center mb-5 section-title">Pilih Menu Favoritmu</h2>

        <div class="row g-4">
            @if($produk->count() > 0)
                @foreach($produk as $p)
                <div class="col-md-4 col-sm-6">
                    <div class="product-card shadow-sm">
                        {{-- PERBAIKAN: Mengarah ke folder public/img/ --}}
                        <img src="{{ asset('img/' . $p->foto_produk) }}"
                             alt="{{ $p->nama_produk }}"
                             onerror="this.onerror=null; this.src='img/brownies1.jpg';">

                        <div class="text-center mb-3">
                            <h4 class="fw-bold">{{ $p->nama_produk }}</h4>
                            <p class="text-muted mb-0">Rp {{ number_format($p->harga ?? 0, 0, ',', '.') }}</p>
                        </div>

                        @if(isset($p->id_produk))
                            <a href="{{ route('orders.show', $p->id_produk) }}" class="btn-order">Lihat Detail & Pesan</a>
                        @else
                            <button class="btn-order opacity-50" disabled>ID Bermasalah</button>
                        @endif
                    </div>
                </div>
                @endforeach
            @else
                <div class="col-12 text-center">
                    <p class="text-muted">Belum ada menu yang tersedia.</p>
                </div>
            @endif
        </div>

        <div class="text-center mt-5">
            <a href="{{ route('home') }}" class="text-decoration-none" style="color: #5D4037; font-weight: 600;">← Kembali ke Home</a>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

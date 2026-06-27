<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $produk->nama_produk }} | Crazy Bite's Detail</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@700&family=Poppins:wght@400;600&display=swap" rel="stylesheet">
    <style>
        body { background-color: #F8F1E7; color: #5D4037; font-family: 'Poppins', sans-serif; }
        .detail-container { background: white; border-radius: 30px; overflow: hidden; box-shadow: 0 15px 40px rgba(0,0,0,0.05); margin-top: 50px; }
        .product-img { width: 100%; height: 500px; object-fit: cover; }
        .content-section { padding: 40px; }
        .product-title { font-family: 'Playfair Display', serif; font-size: 2.5rem; font-weight: 700; margin-bottom: 10px; }
        .price-tag { font-size: 1.8rem; color: #D32F2F; font-weight: 700; margin-bottom: 25px; }
        .description-box { background-color: #fdfbf8; padding: 20px; border-radius: 15px; border-left: 5px solid #5D4037; margin-bottom: 30px; }
        .btn-main { background-color: #5D4037; color: white; padding: 15px; border-radius: 12px; font-weight: 600; text-decoration: none; display: block; text-align: center; border: none; }
    </style>
</head>
<body>

<div class="container mb-5">
    <div class="detail-container">
        <div class="row g-0">
            <div class="col-md-6">
                {{-- KODE YANG SUDAH DIPERBAIKI --}}
               <img src="{{ asset('img/' . $produk->foto_produk) }}"
     class="product-img"
     alt="{{ $produk->nama_produk }}"
     onerror="this.onerror=null; this.src='{{ asset('img/brownies1.jpg') }}';">
            </div>

            <div class="col-md-6">
                <div class="content-section">
                    <h1 class="product-title">{{ $produk->nama_produk }}</h1>
                    <div class="price-tag">Rp {{ number_format($produk->harga, 0, ',', '.') }}</div>

                    <div class="description-box">
                        <h6 class="fw-bold text-uppercase small mb-2">Deskripsi Produk:</h6>
                        <p class="mb-0 text-muted">{{ $produk->deskripsi ?? 'Nikmati kelezatan premium dari varian menu ini.' }}</p>
                    </div>

                    <form action="{{ route('keranjang.tambah', $produk->id_produk) }}" method="POST">
                        @csrf
                        <div class="mb-3">
                            <label class="form-label fw-bold">Jumlah Pesanan</label>
                            <input type="number" name="jumlah" class="form-control" value="1" min="1" style="width: 100px;">
                        </div>
                        <button type="submit" class="btn-main w-100">+ Tambah ke Pesanan</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

</body>
</html>

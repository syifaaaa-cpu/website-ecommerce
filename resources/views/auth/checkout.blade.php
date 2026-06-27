<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Checkout | Crazy Bite's</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;700&display=swap" rel="stylesheet">
    <style>
        body { background-color: #F8F1E7; color: #5D4037; font-family: 'Poppins', sans-serif; }
        .card-custom { background: white; border-radius: 20px; border: none; box-shadow: 0 10px 30px rgba(0,0,0,0.03); }
        .btn-pesan { background-color: #5D4037; color: white; border-radius: 12px; font-weight: 600; transition: 0.3s; }
        .btn-pesan:hover { background-color: #3e2b25; color: #EFE3D2; }
        .form-control, .form-select { border: 1px solid #bcaaa4; border-radius: 10px; padding: 12px; }
    </style>
</head>
<body>

<div class="container py-5">
    <div class="mb-4">
        <h2 class="fw-bold">Form Checkout Pesanan</h2>
        <p class="text-muted">Sedikit langkah lagi sebelum Brownies lezatmu diproses!</p>
    </div>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul class="mb-0">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('pesanan.proses') }}" method="POST">
        @csrf

        <input type="hidden" name="items_terpilih" value="{{ $itemsTerpilih }}">
        <input type="hidden" name="total_bayar" value="{{ $totalBayar }}">

        <div class="row g-4">
            <div class="col-md-7">
                <div class="card-custom p-4 mb-4">
                    <h5 class="fw-bold mb-3">📍 Informasi Pengiriman</h5>
                    <div class="mb-3">
                        <label class="form-label fw-bold">Alamat Lengkap Rumah</label>
                        <textarea name="alamat" class="form-control" rows="4" placeholder="Masukkan alamat..." required></textarea>
                    </div>
                    <div class="mb-3">
                        <label class="form-label fw-bold">Catatan Pesanan (Opsional)</label>
                        <input type="text" name="catatan" class="form-control" placeholder="Catatan tambahan...">
                    </div>
                </div>

                <div class="card-custom p-4">
                    <h5 class="fw-bold mb-3">💳 Metode Pembayaran</h5>
                    <select name="metode_pembayaran" class="form-select" required>
                        <option value="" disabled selected>-- Pilih Pembayaran --</option>
                        <option value="COD">Bayar di Tempat (COD)</option>
                        <option value="Transfer Bank">Transfer Bank</option>
                    </select>
                </div>
            </div>

            <div class="col-md-5">
                <div class="card-custom p-4 sticky-top" style="top: 30px;">
                    <h5 class="fw-bold mb-4">📦 Ringkasan Kue</h5>

                    @foreach($produkCheckout as $item)
                        <div class="d-flex align-items-center mb-3">
                            <div class="ms-3 flex-grow-1">
                                <h6 class="fw-bold m-0">{{ $item->nama_produk }}</h6>
                                <small class="text-muted">{{ $item->jumlah }}x</small>
                            </div>
                            <span class="fw-bold">Rp {{ number_format($item->harga * $item->jumlah, 0, ',', '.') }}</span>
                        </div>
                    @endforeach

                    <hr>
                    <div class="d-flex justify-content-between mb-4">
                        <span class="text-muted">Total Pembayaran:</span>
                        <h4 class="fw-bold text-danger m-0">Rp {{ number_format($totalBayar, 0, ',', '.') }}</h4>
                    </div>

                    <button type="submit" class="btn btn-pesan w-100 py-3 text-uppercase">
                        Buat Pesanan Sekarang
                    </button>
                </div>
            </div>
        </div>
    </form>
</div>

</body>
</html>

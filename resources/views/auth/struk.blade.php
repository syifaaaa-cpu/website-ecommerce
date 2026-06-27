<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Struk Pesanan #{{ $pesanan->id_pesanan }} | Crazy Bite's</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;700&display=swap" rel="stylesheet">
    <style>
        body { background-color: #F8F1E7; color: #5D4037; font-family: 'Poppins', sans-serif; }
        .struk-box { background: white; max-width: 500px; margin: 40px auto; border-radius: 25px; box-shadow: 0 15px 35px rgba(0,0,0,0.05); border: 2px dashed #bcaaa4; }
        .badge-status { font-size: 14px; padding: 6px 16px; border-radius: 30px; font-weight: 600; }
        .status-pending { background-color: #ffeeba; color: #856404; }
        .status-diproses { background-color: #cce5ff; color: #004085; }
        .status-dikirim { background-color: #d1ecf1; color: #0c5460; }
        .status-selesai { background-color: #d4edda; color: #155724; }
    </style>
</head>
<body>

<div class="container">
    <div class="struk-box p-4 p-sm-5">

        <div class="text-center mb-4">
            <h3 class="fw-bold m-0" style="color: #5D4037;">🧁 Crazy Bite's</h3>
            <small class="text-muted">Freshly Baked Dessert House</small>
            <hr class="my-3" style="border-top: 2px dashed #bcaaa4; opacity: 0.5;">

            <div class="mb-2 text-muted small">Status Pesanan Saat Ini:</div>
            <span class="badge-status
                @if($pesanan->status == 'Pending') status-pending
                @elseif($pesanan->status == 'Diproses') status-diproses
                @elseif($pesanan->status == 'Dikirim') status-dikirim
                @else status-selesai @endif">
                {{ strtoupper($pesanan->status) }}
            </span>
        </div>

        <div class="row small mb-3 text-muted">
            <div class="col-6">ID Pesanan: #{{ $pesanan->id_pesanan }}</div>
            <div class="col-6 text-end">{{ date('d M Y H:i', strtotime($pesanan->tanggal_pesanan)) }}</div>
        </div>

        <div class="mb-4">
            <h6 class="fw-bold text-uppercase mb-2" style="font-size: 12px; tracking-wider">Rincian Menu:</h6>
            @foreach($detailProduk as $item)
                <div class="d-flex justify-content-between align-items-center mb-2">
                    <span>{{ $item->nama_produk }} <small class="text-muted">x{{ $item->jumlah }}</small></span>
                    <span class="fw-semibold">Rp {{ number_format($item->subtotal, 0, ',', '.') }}</span>
                </div>
            @endforeach
        </div>

        <hr class="my-3" style="border-top: 2px dashed #bcaaa4; opacity: 0.5;">

        <div class="mb-4 small">
            <span class="fw-bold d-block mb-1 text-uppercase text-muted" style="font-size: 11px;">Alamat Kirim:</span>
            <p class="m-0 text-secondary">{{ $pesanan->alamat }}</p>
            @if($pesanan->catatan)
                <small class="text-warning d-block mt-1">💡 Catatan: {{ $pesanan->catatan }}</small>
            @endif
        </div>

        <div class="d-flex justify-content-between align-items-center mb-4 p-3 rounded-3" style="background-color: #F8F1E7;">
            <span class="fw-bold m-0 text-muted">TOTAL BAYAR ({{ $pesanan->metode_pembayaran }}):</span>
            <h4 class="fw-bold text-danger m-0">Rp {{ number_format($pesanan->total_bayar, 0, ',', '.') }}</h4>
        </div>

        <div class="text-center mt-4 pt-2">
            <p class="small text-muted m-0">Terima kasih sudah order di Crazy Bite's! ❤️</p>
            <p class="small text-muted mb-3">Kue kamu akan segera dimasak oleh admin.</p>
            <a href="{{ route('keranjang.index') }}" class="btn btn-sm btn-outline-secondary px-4 py-2" style="border-radius: 10px;">
                Kembali ke Keranjang
            </a>
        </div>

    </div>
</div>

</body>
</html>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Nota Pesanan #{{ $pesanan->id_pesanan }} | Crazy Bite's</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;700&display=swap" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    <style>
        body { background-color: #F8F1E7; color: #5D4037; font-family: 'Poppins', sans-serif; }
        .card-nota { background: white; border-radius: 20px; border: none; box-shadow: 0 10px 30px rgba(0,0,0,0.03); }
        .status-badge { padding: 6px 16px; border-radius: 20px; font-weight: 600; font-size: 14px; }
        .bg-pending { background-color: #FFE082; color: #FF8F00; }
        .btn-kembali { background-color: #5D4037; color: white; border-radius: 12px; font-weight: 600; transition: 0.3s; text-decoration: none; }
        .btn-kembali:hover { background-color: #3e2b25; color: #EFE3D2; }
        .info-bank { background-color: #F5F5F5; border-radius: 12px; border-left: 5px solid #5D4037; }

        /* Style Tombol WA */
        .btn-whatsapp {
            background-color: #25D366;
            color: white;
            font-weight: 700;
            border-radius: 12px;
            transition: 0.3s;
            text-decoration: none;
            box-shadow: 0 4px 12px rgba(37, 211, 102, 0.2);
        }
        .btn-whatsapp:hover {
            background-color: #1ebd58;
            color: white;
            transform: translateY(-2px);
            box-shadow: 0 6px 16px rgba(37, 211, 102, 0.3);
        }
    </style>
</head>
<body>

<div class="container py-5" style="max-width: 700px;">
    <div class="card-nota p-5">
        <div class="text-center mb-5">
            <h1 class="fw-bold m-0" style="color: #5D4037;">Crazy Bite's 🍫</h1>
            <p class="text-muted mb-3">Terima kasih atas pesananmu!</p>
            <span class="status-badge bg-pending">Status: {{ $pesanan->status_pesanan }}</span>
        </div>

        <hr class="my-4" style="border-style: dashed; border-color: #bcaaa4;">

        <div class="row g-3 mb-4">
            <div class="col-6">
                <small class="text-muted d-block">NOMOR NOTA</small>
                <span class="fw-bold">#ORD-{{ $pesanan->id_pesanan }}</span>
            </div>
            <div class="col-6 text-end">
                <small class="text-muted d-block">TANGGAL PESAN</small>
                <span class="fw-bold">{{ date('d M Y', strtotime($pesanan->tanggal_pesanan)) }}</span>
            </div>
            <div class="col-6">
                <small class="text-muted d-block">METODE BAYAR</small>
                <span class="fw-bold text-uppercase">{{ $pesanan->metode_pembayaran }}</span>
            </div>
            <div class="col-6 text-end">
                <small class="text-muted d-block">ALAMAT PENGIRIMAN</small>
                <span class="fw-bold d-block text-truncate" title="{{ $pesanan->alamat }}">{{ $pesanan->alamat }}</span>
            </div>
        </div>

        <h6 class="fw-bold mb-3" style="color: #5D4037;">📦 Daftar Menu Yang Dibeli</h6>
        <div class="table-responsive mb-4">
            <table class="table align-middle">
                <thead>
                    <tr class="text-muted" style="font-size: 14px;">
                        <th>Menu</th>
                        <th class="text-center">Qty</th>
                        <th class="text-end">Harga</th>
                        <th class="text-end">Subtotal</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($detail as $item)
                        <tr>
                            <td class="fw-bold">{{ $item->nama_produk }}</td>
                            <td class="text-center">{{ $item->jumlah }}</td>
                            <td class="text-end">Rp {{ number_format($item->harga, 0, ',', '.') }}</td>
                            <td class="text-end text-nowrap fw-bold">Rp {{ number_format($item->subtotal, 0, ',', '.') }}</td>
                        </tr>
                    @endforeach
                    <tr class="table-light" style="font-size: 18px;">
                        <td colspan="3" class="fw-bold text-end text-danger">Total Bayar:</td>
                        <td class="fw-bold text-end text-nowrap text-danger">Rp {{ number_format($pesanan->total_harga, 0, ',', '.') }}</td>
                    </tr>
                </tbody>
            </table>
        </div>

        @if(strtoupper($pesanan->metode_pembayaran) == 'TRANSFER BANK')
            <div class="info-bank p-3 mb-4">
                <h6 class="fw-bold mb-2">🏧 Instruksi Pembayaran Transfer:</h6>
                <p class="m-0 small text-muted">Silakan transfer tepat sebesar <strong class="text-danger">Rp {{ number_format($pesanan->total_harga, 0, ',', '.') }}</strong> ke salah satu rekening toko kami:</p>
                <ul class="mt-2 mb-0 small fw-bold">
                    <li>Bank BCA: 123-4567-890 a/n Crazy Bites Admin</li>
                    <li>Bank Mandiri: 987-6543-210 a/n Crazy Bites Admin</li>
                </ul>
                <p class="mt-2 mb-0 text-muted" style="font-size: 12px;">*Pesanan baru akan dipanggang & dikirim setelah Admin memverifikasi pembayaranmu melalui WhatsApp.</p>
            </div>

            @php
                // Menyusun template isi chat WA otomatis dengan nomor asli Syifa
                $pesanWA = "Halo Admin Crazy Bite's! Saya ingin konfirmasi pembayaran untuk pesanan saya.\n\n"
                         . "*Nomor Nota:* #ORD-" . $pesanan->id_pesanan . "\n"
                         . "*Total Belanja:* Rp " . number_format($pesanan->total_harga, 0, ',', '.') . "\n"
                         . "*Alamat Kirim:* " . $pesanan->alamat . "\n\n"
                         . "_(Mohon info total ongkos kirimnya ya min, biar sekalian ditransfer)_\n\n"
                         . "Berikut saya lampirkan foto bukti transfer belanjaannya. Terima kasih!";

                $textEncoded = urlencode($pesanWA);

                // FIXED: Menggunakan nomor WA asli toko Crazy Bite's kamu
                $nomorHPAdmin = "628815373739";

                $urlWhatsApp = "https://wa.me/" . $nomorHPAdmin . "?text=" . $textEncoded;
            @endphp

            <div class="mb-4">
                <a href="{{ $urlWhatsApp }}" target="_blank" class="btn btn-whatsapp w-100 py-3 text-center">
                    <i class="fab fa-whatsapp me-2"></i> Konfirmasi & Cek Ongkir via WhatsApp
                </a>
            </div>
        @else
            <div class="alert alert-info border-0 mb-4" style="border-radius: 12px;">
                🛵 <strong>Info COD:</strong> Siapkan uang pas sebesar <strong>Rp {{ number_format($pesanan->total_harga, 0, ',', '.') }}</strong> ditambah dengan ongkos kirim kurir manual saat kue brownies diantarkan ke rumahmu ya!
            </div>
        @endif

        <div class="text-center">
            <a href="{{ route('orders.index') }}" class="btn btn-kembali w-100 py-3">
                Selesai & Kembali Belanja
            </a>
        </div>
    </div>
</div>

</body>
</html>

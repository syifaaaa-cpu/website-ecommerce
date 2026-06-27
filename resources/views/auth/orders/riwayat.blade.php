<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Riwayat Pesanan | Crazy Bite's</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
<div class="container py-5">
    <h2 class="mb-4">Riwayat Pesanan Saya</h2>
    <a href="{{ route('orders.index') }}" class="btn btn-secondary mb-3">← Kembali ke Katalog</a>

    @if($pesanan->isEmpty())
        <div class="alert alert-info">Belum ada pesanan yang dibuat.</div>
    @else
        <div class="table-responsive">
            <table class="table bg-white rounded shadow-sm table-hover align-middle">
                <thead class="table-light">
                    <tr>
                        <th>ID Pesanan</th>
                        <th>Tanggal</th>
                        <th>Total</th>
                        <th>Status</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($pesanan as $p)
                    <tr>
                        <td><strong>#{{ $p->id_pesanan }}</strong></td>
                        <td>{{ date('d-m-Y', strtotime($p->tanggal_pesanan)) }}</td>
                        <td>Rp {{ number_format($p->total_harga, 0, ',', '.') }}</td>
                        <td>
                            @php
                                // Menentukan warna badge berdasarkan status
                                $statusClass = match($p->status_pesanan) {
                                    'Pending' => 'bg-warning text-dark',
                                    'Diproses' => 'bg-primary',
                                    'Dikirim' => 'bg-info text-dark',
                                    'Selesai' => 'bg-success',
                                    default => 'bg-secondary'
                                };
                            @endphp
                            <span class="badge {{ $statusClass }}">{{ $p->status_pesanan }}</span>
                        </td>
                        <td>
                            <a href="{{ route('pesanan.nota', $p->id_pesanan) }}" class="btn btn-sm btn-outline-primary">Lihat Nota</a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    @endif
</div>
</body>
</html>

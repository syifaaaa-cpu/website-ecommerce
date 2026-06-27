<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Admin | Crazy Bite's</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;700&display=swap" rel="stylesheet">
    <style>
        body { background-color: #F8F1E7; color: #5D4037; font-family: 'Poppins', sans-serif; }
        .card-admin { background: white; border-radius: 20px; border: none; box-shadow: 0 10px 30px rgba(0,0,0,0.03); }
        .table th { background-color: #5D4037; color: white; }
    </style>
</head>
<body>

<div class="container py-5">
    <div class="card-admin p-5">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <div>
                <h2 class="fw-bold m-0" style="color: #5D4037;">Dashboard Admin 🍫</h2>
                <p class="text-muted m-0">Kelola Status Pesanan Masuk Crazy Bite's</p>
            </div>
            <a href="{{ route('orders.index') }}" class="btn btn-outline-secondary border-2 fw-bold" style="border-radius: 10px;">
                ← Ke Toko
            </a>
        </div>

        @if(session('success'))
            <div class="alert alert-success border-0 mb-4" style="border-radius: 12px;">
                {{ session('success') }}
            </div>
        @endif

        <div class="table-responsive">
            <table class="table table-bordered align-middle">
                <thead>
                    <tr class="text-center">
                        <th>Nota</th>
                        <th>User ID</th>
                        <th>Alamat</th>
                        <th>Metode</th>
                        <th>Total Harga</th>
                        <th>Ubah Status</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($allPesanan as $p)
                        <tr>
                            <td class="text-center fw-bold">#ORD-{{ $p->id_pesanan }}</td>
                            <td class="text-center">{{ $p->id_user }}</td>
                            <td>{{ $p->alamat }}</td>
                            <td class="text-center text-uppercase"><small class="badge bg-secondary">{{ $p->metode_pembayaran }}</small></td>
                            <td class="text-end fw-bold">Rp {{ number_format($p->total_harga, 0, ',', '.') }}</td>
                            <td>
                                <form action="{{ url('/admin/pesanan/update/' . $p->id_pesanan) }}" method="POST">
                                    @csrf
                                    <select name="status_pesanan" onchange="this.form.submit()" class="form-select fw-bold @if($p->status_pesanan == 'Pending') text-warning @elseif($p->status_pesanan == 'Diproses') text-primary @else text-success @endif">
                                        <option value="Pending" {{ $p->status_pesanan == 'Pending' ? 'selected' : '' }}>⏳ Pending</option>
                                        <option value="Diproses" {{ $p->status_pesanan == 'Diproses' ? 'selected' : '' }}>📦 Diproses</option>
                                        <option value="Selesai" {{ $p->status_pesanan == 'Selesai' ? 'selected' : '' }}>✅ Selesai</option>
                                    </select>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="text-center text-muted py-4">Belum ada pesanan masuk.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>

</body>
</html>

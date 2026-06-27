<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Area | Crazy Bite's</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600;700&display=swap" rel="stylesheet">
    <style>
        body { background-color: #F8F1E7; color: #5D4037; font-family: 'Poppins', sans-serif; }
        .card-admin { background: white; border-radius: 20px; border: none; box-shadow: 0 10px 30px rgba(0,0,0,0.03); }
        .table th { background-color: #5D4037; color: white; text-align: center; font-weight: 600; }
        .btn-logout { background-color: #DC3545; color: white; border-radius: 10px; padding: 8px 20px; border: none; font-weight: 600; text-decoration: none; transition: 0.3s; }
        .btn-logout:hover { background-color: #C82333; color: white; }
    </style>
</head>
<body>

<div class="container py-5">
    <div class="card-admin p-4 mb-4 d-flex flex-row justify-content-between align-items-center">
        <div>
            <h2 class="fw-bold m-0" style="color: #5D4037;">🍪 Dashboard Admin Crazy Bite's</h2>
            <p class="text-muted m-0">Halo <strong>{{ Auth::user()->nama_user }}</strong>, kelola pesanan masuk hari ini.</p>
        </div>
        <div>
            <form action="{{ route('logout') }}" method="POST" class="d-inline">
                @csrf
                <button type="submit" class="btn-logout">Log Out</button>
            </form>
        </div>
    </div>

    @if(session('success'))
        <div class="alert alert-success border-0 mb-4 shadow-sm" style="border-radius: 12px;">
            {{ session('success') }}
        </div>
    @endif

    <div class="card-admin p-4">
        <h4 class="fw-bold mb-4" style="color: #5D4037;">Daftar Pesanan Masuk</h4>

        <div class="table-responsive">
            <table class="table table-bordered table-hover align-middle m-0">
                <thead>
                    <tr>
                        <th style="width: 12%;">No. Nota</th>
                        <th style="width: 18%;">Nama Pelanggan</th>
                        <th style="width: 15%;">Tanggal</th>
                        <th>Alamat Pengiriman</th>
                        <th style="width: 15%;">Total Bayar</th>
                        <th style="width: 18%;">Aksi Status</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($pesananMasuk as $pesanan)
                        <tr>
                            <td class="text-center fw-bold text-secondary">#ORD-{{ $pesanan->id_pesanan }}</td>
                            <td class="fw-semibold">{{ $pesanan->nama_pelanggan }}</td>
                            <td class="text-center">{{ date('d M Y', strtotime($pesanan->tanggal_pesanan)) }}</td>
                            <td>{{ $pesanan->alamat }}</td>
                            <td class="text-end fw-bold text-success">Rp {{ number_format($pesanan->total_harga, 0, ',', '.') }}</td>
                            <td>
                                <form action="{{ route('admin.updateStatus', $pesanan->id_pesanan) }}" method="POST">
                                    @csrf
                                    <select name="status_pesanan" onchange="this.form.submit()" class="form-select fw-bold @if($pesanan->status_pesanan == 'Pending') text-warning @elseif($pesanan->status_pesanan == 'Diproses') text-primary @else text-success @endif" style="border-radius: 8px; cursor: pointer;">
                                        <option value="Pending" {{ $pesanan->status_pesanan == 'Pending' ? 'selected' : '' }}>⏳ Pending</option>
                                        <option value="Diproses" {{ $pesanan->status_pesanan == 'Diproses' ? 'selected' : '' }}>📦 Diproses</option>
                                        <option value="Selesai" {{ $pesanan->status_pesanan == 'Selesai' ? 'selected' : '' }}>✅ Selesai</option>
                                    </select>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="text-center text-muted py-4">Belum ada transaksi atau pesanan masuk.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>

</body>
</html>

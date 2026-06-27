<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Keranjang Belanja | Crazy Bite's</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;700&display=swap" rel="stylesheet">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <style>
        body { background-color: #F8F1E7; color: #5D4037; font-family: 'Poppins', sans-serif; }
        .card-keranjang { background: white; border-radius: 20px; border: none; box-shadow: 0 10px 30px rgba(0,0,0,0.03); }
        .btn-checkout { background-color: #5D4037; color: white; border-radius: 12px; font-weight: 600; transition: 0.3s; }
        .btn-checkout:hover { background-color: #3e2b25; color: #EFE3D2; }
        .btn-checkout:disabled { background-color: #bcaaa4; color: white; }
        .form-check-input:checked { background-color: #5D4037; border-color: #5D4037; }
        .quantity-control { display: flex; align-items: center; border: 1px solid #bcaaa4; border-radius: 8px; overflow: hidden; max-width: 120px; }
        .quantity-btn { background: #EFE3D2; border: none; color: #5D4037; width: 35px; height: 35px; font-weight: bold; font-size: 16px; transition: 0.2s; }
        .quantity-btn:hover { background: #bcaaa4; color: white; }
        .quantity-input { border: none; text-align: center; width: 45px; font-weight: 600; color: #5D4037; background: transparent; }
    </style>
</head>
<body>

<div class="container py-5">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="fw-bold m-0">🛒 Keranjang Belanja</h2>
        <a href="{{ route('orders.index') }}" class="text-decoration-none" style="color: #5D4037; font-weight: 600;">← Kembali Belanja</a>
    </div>

    @if(session('success'))
        <div class="alert alert-success border-0 shadow-sm mb-4" style="border-radius: 12px;">
            {{ session('success') }}
        </div>
    @endif

    <div class="row g-4">
        <div class="col-md-8">
            @if($keranjang->isEmpty())
                <div class="card-keranjang p-5 text-center">
                    <h5 class="text-muted mb-3">Keranjangmu masih kosong nih.</h5>
                    <a href="{{ route('orders.index') }}" class="btn btn-checkout px-4 py-2">Yuk Isi dengan Brownies!</a>
                </div>
            @else
                @foreach($keranjang as $item)
                    <div class="card-keranjang p-4 mb-3 d-flex align-items-center justify-content-between" id="row-{{ $item->id_keranjang }}">
                        <div class="d-flex align-items-center">
                            <input type="checkbox" class="form-check-input me-4 item-checkbox"
                                   style="width: 22px; height: 22px;"
                                   data-id="{{ $item->id_keranjang }}"
                                   data-harga="{{ $item->harga }}"
                                   value="{{ $item->id_keranjang }}">

                            <img src="{{ $item->foto_produk ? asset('storage/' . $item->foto_produk) : 'https://images.unsplash.com/photo-1606313564200-e75d5e30476c?auto=format&fit=crop&w=200&q=80' }}"
                                 alt="{{ $item->nama_produk }}"
                                 style="width: 90px; height: 90px; object-fit: cover; border-radius: 15px;">

                            <div class="ms-4">
                                <h5 class="fw-bold mb-1">{{ $item->nama_produk }}</h5>
                                <p class="text-muted mb-2">Rp {{ number_format($item->harga, 0, ',', '.') }}</p>

                                <div class="quantity-control">
                                    <button class="quantity-btn min-btn" data-id="{{ $item->id_keranjang }}">-</button>
                                    <input type="text" class="quantity-input qty-field" id="qty-{{ $item->id_keranjang }}" data-harga="{{ $item->harga }}" value="{{ $item->jumlah }}" readonly>
                                    <button class="quantity-btn plus-btn" data-id="{{ $item->id_keranjang }}">+</button>
                                </div>
                            </div>
                        </div>

                        <div class="text-end d-flex flex-column align-items-end justify-content-between" style="height: 90px;">
                            <form action="{{ route('keranjang.hapus', $item->id_keranjang) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus produk ini dari keranjang?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-outline-danger border-0" style="border-radius: 8px;">
                                    🗑️ Hapus
                                </button>
                            </form>

                            <h5 class="fw-bold text-danger m-0 subtotal-text" id="subtotal-{{ $item->id_keranjang }}">
                                Rp {{ number_format($item->harga * $item->jumlah, 0, ',', '.') }}
                            </h5>
                        </div>
                    </div>
                @endforeach
            @endif
        </div>

        <div class="col-md-4">
            <div class="card-keranjang p-4 sticky-top" style="top: 30px;">
                <h5 class="fw-bold mb-4">Ringkasan Belanja</h5>

                <div class="d-flex justify-content-between align-items-center mb-3">
                    <span class="text-muted">Total Harga Terpilih:</span>
                    <h4 class="fw-bold text-danger m-0" id="total-pembayaran">Rp 0</h4>
                </div>

                <hr class="my-4" style="border-color: #5D4037; opacity: 0.2;">

               <form action="{{ route('pesanan.checkout') }}" method="GET" id="form-checkout">
    <input type="hidden" name="items_terpilih" id="items-terpilih-input" value="">

    <button type="submit" class="btn w-100 py-3 text-uppercase" id="btn-submit-co"
            style="background-color: #5D4037; color: white; border-radius: 12px; font-weight: 600;" disabled>
        Lanjut Checkout
    </button>
</form>
            </div>
        </div>
    </div>
</div>

<script>
    const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

    // 1. Fungsi Utama Hitung Total Centang
    function hitungTotal() {
        let total = 0;
        let terpilih = [];

        document.querySelectorAll('.item-checkbox:checked').forEach(checkedBox => {
            let id = checkedBox.getAttribute('data-id');
            let harga = parseInt(checkedBox.getAttribute('data-harga'));
            let jumlah = parseInt(document.getElementById('qty-' + id).value);

            total += (harga * jumlah);
            terpilih.push(id);
        });

        document.getElementById('total-pembayaran').innerText = 'Rp ' + total.toLocaleString('id-ID');
        document.getElementById('items-terpilih-input').value = terpilih.join(',');

        if(terpilih.length > 0) {
            document.getElementById('btn-submit-co').removeAttribute('disabled');
        } else {
            document.getElementById('btn-submit-co').setAttribute('disabled', 'disabled');
        }
    }

    // 2. Fungsi Kirim Perubahan Jumlah ke Database via Ajax
    function updateDatabaseQty(id, jumlahBaru) {
        fetch(`/keranjang/update/${id}`, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': csrfToken
            },
            body: JSON.stringify({ jumlah: jumlahBaru })
        })
        .then(res => res.json())
        .then(data => {
            if(!data.success) alert(data.message);
        });
    }

    // Listener Perubahan Checkbox
    document.querySelectorAll('.item-checkbox').forEach(checkbox => {
        checkbox.addEventListener('change', hitungTotal);
    });

    // Tombol Tambah Jumlah (+)
    document.querySelectorAll('.plus-btn').forEach(btn => {
        btn.addEventListener('click', function() {
            let id = this.getAttribute('data-id');
            let input = document.getElementById('qty-' + id);
            let harga = parseInt(input.getAttribute('data-harga'));

            let jumlahBaru = parseInt(input.value) + 1;
            input.value = jumlahBaru;

            // Hitung subtotal teks item tersebut
            document.getElementById('subtotal-' + id).innerText = 'Rp ' + (harga * jumlahBaru).toLocaleString('id-ID');

            hitungTotal();
            updateDatabaseQty(id, jumlahBaru);
        });
    });

    // Tombol Kurang Jumlah (-)
    document.querySelectorAll('.min-btn').forEach(btn => {
        btn.addEventListener('click', function() {
            let id = this.getAttribute('data-id');
            let input = document.getElementById('qty-' + id);
            let harga = parseInt(input.getAttribute('data-harga'));

            if(parseInt(input.value) > 1) {
                let jumlahBaru = parseInt(input.value) - 1;
                input.value = jumlahBaru;

                document.getElementById('subtotal-' + id).innerText = 'Rp ' + (harga * jumlahBaru).toLocaleString('id-ID');

                hitungTotal();
                updateDatabaseQty(id, jumlahBaru);
            }
        });
    });
</script>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

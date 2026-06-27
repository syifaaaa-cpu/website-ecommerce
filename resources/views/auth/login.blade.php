<!DOCTYPE html>
<html>
<head>
    <title>Login Crazy Bite's</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body { background-color: #fcf8f5; } /* Warna krem khas Crazy Bite's */
        .card { border-radius: 15px; border: none; }
        .btn-primary { background-color: #6d4c41; border: none; }
        .btn-primary:hover { background-color: #4e342e; }
        .form-label { font-weight: bold; color: #5d4037; }
    </style>
</head>
<body>
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-4">
                <div class="card shadow-lg mt-5">
                    <div class="card-body p-4">
                        <h3 class="text-center mb-4">Login Crazy Bite's</h3>
                        <hr>

                        {{-- Pesan Sukses setelah Register --}}
                        @if(session()->has('success'))
                            <div class="alert alert-success alert-dismissible fade show" role="alert">
                                {{ session('success') }}
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>
                        @endif

                        {{-- Pesan Error jika Login Gagal --}}
                        @if(session()->has('loginError'))
                            <div class="alert alert-danger">
                                {{ session('loginError') }}
                            </div>
                        @endif

                        <form action="{{ route('login.post') }}" method="POST">
                            @csrf
                            <div class="mb-3">
                                <label class="form-label">Username / Email</label>
                                {{-- name="email" harus sama dengan di AuthController --}}
                                <input type="text" name="email" class="form-control @error('email') is-invalid @enderror"
                                       placeholder="Masukkan username anda" value="{{ old('email') }}" required autoFocus>
                                @error('email')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Password</label>
                                <input type="password" name="password" class="form-control" placeholder="Masukkan password" required>
                            </div>
                            <button type="submit" class="btn btn-primary w-100 py-2">MASUK SEKARANG</button>
                        </form>
                    </div>
                </div>
                <div class="text-center mt-3">
                    <small>Belum punya akun? <a href="{{ route('register') }}" class="text-decoration-none">Daftar Sekarang</a></small>
                    <br>
                    <small><a href="/" class="text-decoration-none text-muted">← Kembali ke Toko</a></small>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

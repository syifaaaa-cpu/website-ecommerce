<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Member | Crazy Bite's</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@700&family=Poppins:wght@400;600&display=swap" rel="stylesheet">
    <style>
        body { background-color: #F8F1E7; font-family: 'Poppins', sans-serif; color: #5D4037; }
        .register-container { margin-top: 50px; margin-bottom: 50px; }
        .register-card { border: none; border-radius: 25px; overflow: hidden; box-shadow: 0 10px 30px rgba(0,0,0,0.1); background: white; }
        .btn-register { background-color: #5D4037; color: white; border-radius: 10px; padding: 12px; font-weight: 600; border: none; transition: 0.3s; }
        .btn-register:hover { background-color: #3e2b25; color: #F8F1E7; }
        .form-control { border-radius: 10px; border: 1px solid #EFE3D2; padding: 12px; }
        .form-control:focus { border-color: #5D4037; box-shadow: none; }
        .brand-text { font-family: 'Playfair Display', serif; font-weight: 700; color: #5D4037; }
    </style>
</head>
<body>

<div class="container register-container">
    <div class="row justify-content-center">
        <div class="col-md-5">
            <div class="register-card p-5">
                <div class="text-center mb-4">
                    <h2 class="brand-text">Crazy Bite's</h2>
                    <p class="text-muted">Daftar untuk mulai memesan brownies favoritmu!</p>
                </div>

                <form action="{{ route('register') }}" method="POST">
                    @csrf
                    <div class="mb-3">
                        <label class="form-label small fw-bold">Nama Lengkap</label>
                        <input type="text" name="name" class="form-control" placeholder="Masukkan nama Anda" required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label small fw-bold">Email</label>
                        <input type="email" name="email" class="form-control" placeholder="contoh@gmail.com" required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label small fw-bold">Password</label>
                        <input type="password" name="password" class="form-control" placeholder="Minimal 8 karakter" required>
                    </div>

                    <div class="mb-4">
                        <label class="form-label small fw-bold">Konfirmasi Password</label>
                        <input type="password" name="password_confirmation" class="form-control" placeholder="Ulangi password" required>
                    </div>

                    <button type="submit" class="btn-register w-100 mb-3">Daftar Sekarang</button>

                    <div class="text-center">
                        <small>Sudah punya akun? <a href="{{ route('login') }}" style="color: #5D4037; font-weight: 600; text-decoration: none;">Login di sini</a></small>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

</body>
</html>

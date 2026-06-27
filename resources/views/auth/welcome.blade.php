<!-- resources/views/welcome.blade.php -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Crazy Bite's - Made with Love</title>
    <!-- Tambahkan Link Bootstrap atau CSS kamu di sini -->
    <style>
        body { background-color: #F8F1E7; color: #5D4037; }
        .navbar { background-color: #F8F1E7; }
        .hero-section { background-color: #EFE3D2; border-radius: 20px; padding: 100px; margin-top: 50px; }
        .btn-login { background-color: #8D6E63; color: white; border-radius: 20px; }
    </style>
</head>
<body>
    <nav class="navbar navbar-expand-lg container py-3">
        <a class="navbar-brand fw-bold" href="#">CRAZY BITE'S</a>
        <div class="ms-auto">
            <a href="{{ route('login') }}" class="btn btn-login px-4">LOGIN</a>
        </div>
    </nav>

    <div class="container text-center">
        <div class="hero-section">
            <h1 class="display-4 fw-serif">Made with love, <br> baked for you</h1>
            <p class="lead">Pilihan terbaik untuk teman ngeteh atau kumpul keluarga.</p>
            <a href="#product" class="btn btn-outline-brown rounded-pill px-4 py-2">Jelajahi Menu</a>
        </div>
    </div>
</body>
</html>

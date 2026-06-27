<!DOCTYPE html>

<html lang="en">

<head>

    <meta charset="UTF-8">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Crazy Bite's | Premium Dessert</title>

    <!-- Fonts & Bootstrap -->



   <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">



<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" />



<link href="https://fonts.googleapis.com/css2?family=Playfair+Display:ital,wght@0,700;1,700&family=Poppins:wght@300;400;600&display=swap" rel="stylesheet">



<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">



<link rel="stylesheet" href="{{ asset('css/style.css') }}">

    <style>

        html { scroll-behavior: smooth; }

        body { background-color: #F8F1E7; color: #5D4037; font-family: 'Poppins', sans-serif; overflow-x: hidden; }



        /* 1. NAVBAR STYLING */

        .navbar { background-color: #F8F1E7; padding: 15px 0; border-bottom: 1px solid rgba(93, 64, 55, 0.1); }

        .navbar-brand { font-family: 'Playfair Display', serif; font-weight: 700; color: #5D4037 !important; letter-spacing: 2px; }

        .nav-link { color: #5D4037 !important; font-size: 11px; font-weight: 600; text-transform: uppercase; margin: 0 10px; transition: 0.3s; }

        .nav-link:hover { color: #A67C52 !important; }

        .btn-login-nav { background-color: #A67C52; color: white; border-radius: 25px; padding: 7px 25px; border: none; font-size: 13px; font-weight: 600; }



        /* SECTION UTAMA */

        .section-padding { padding: 80px 0; }

        .section-title { font-family: 'Playfair Display', serif; font-weight: 700; font-size: 2.8rem; margin-bottom: 40px; }



        /* 1. HOME (HERO) */

        .hero-section { background-color: #EFE3D2; border-radius: 40px; padding: 120px 20px; margin: 20px 0; }

        .hero-title { font-family: 'Playfair Display', serif; font-style: italic; font-size: 4.2rem; line-height: 1.1; color: #5D4037; }

        .btn-explore { border: 1.5px solid #5D4037; color: #5D4037; border-radius: 30px; padding: 10px 40px; text-decoration: none; display: inline-block; margin-top: 30px; font-weight: 500; transition: 0.3s; }

        .btn-explore:hover { background: #5D4037; color: white; }



        /* Pastikan gambar dalam slider tampil rapi */

/* Container utama galeri */

.swiper {

    width: 100%;

    padding-top: 20px;

    padding-bottom: 50px; /* Ruang untuk titik pagination */

}



/* Pengaturan khusus foto agar seragam */

.img-potret {

    width: 100%;

    height: 350px; /* Tinggi disesuaikan agar landscape terlihat elegan */

    object-fit: cover; /* Memotong gambar secara proporsional agar mengisi ruang */

    border-radius: 15px; /* Sudut melengkung yang lebih modern */

    box-shadow: 0 4px 15px rgba(0,0,0,0.1);

}



/* Navigasi panah */

.swiper-button-next, .swiper-button-prev {

    color: #5D4037 !important;

}







        /* 2. PRODUCT - Grid Ke Kiri */

        .product-card { border: none; border-radius: 20px; background: white; padding: 25px; box-shadow: 0 10px 30px rgba(0,0,0,0.03); height: 100%; }

        .price-tag { color: #2D6A4F; font-weight: 700; font-size: 1.3rem; }

        .btn-buy { background-color: #5D4037; color: white; border: none; border-radius: 8px; padding: 8px 20px; font-size: 14px; }



        /* 4. SERVICE & 5. EVENT IMAGES */

        .img-service { width: 100%; height: 450px; object-fit: cover; border-radius: 5px; margin-bottom: 20px; }

        .img-event { width: 100%; height: 300px; object-fit: cover; border-radius: 5px; margin-bottom: 15px; }

        .card-title-custom { font-family: 'Playfair Display', serif; font-weight: 700; font-size: 1.8rem; }



        /* B2B SECTION */

        .b2b-box { background-color: white; padding: 80px 0; text-align: center; margin: 50px 0; }

        .btn-pesan { background-color: #333; color: white; border: none; padding: 12px 45px; border-radius: 5px; font-weight: 600; }



        /* 6. CONTACT US (FOOTER) */

        footer { background-color: #5D6073; color: white; padding: 80px 0 40px; }

        .footer-logo { font-family: 'Playfair Display', serif; font-size: 3rem; margin-bottom: 20px; }

        .newsletter-input { border-radius: 0; border: none; padding: 15px; }

        .btn-sub { background-color: #333; color: white; border: none; border-radius: 0; padding: 0 30px; font-weight: 600; }

        .contact-info { font-size: 0.95rem; color: #D1D1D1; line-height: 1.8; }

    </style>

</head>

<body>



    <!-- NAVBAR LENGKAP 6 MENU -->

    <nav class="navbar navbar-expand-lg sticky-top">

        <div class="container">

            <a class="navbar-brand" href="#">CRAZY BITE'S</a>

            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">

                <span class="navbar-toggler-icon"></span>

            </button>

            <div class="collapse navbar-collapse" id="navbarNav">

                <ul class="navbar-nav mx-auto">

                    <li class="nav-item"><a class="nav-link" href="#home">HOME</a></li>

                    <li class="nav-item"><a class="nav-link" href="#product">PRODUCT</a></li>

                    <li class="nav-item"><a class="nav-link" href="#about">ABOUT US</a></li>

                    <li class="nav-item"><a class="nav-link" href="#service">SERVICE</a></li>

                    <li class="nav-item"><a class="nav-link" href="#event">EVENT</a></li>

                    <li class="nav-item"><a class="nav-link" href="#contact">CONTACT US</a></li>

                </ul>

               <a href="{{ route('login') }}" class="btn btn-outline-primary btn-sm">Login</a>

            </div>

        </div>

    </nav>



    <!-- 1. HOME SECTION -->

   <!-- HERO SECTION -->

<section id="home" style="min-height: 100vh; background-color: #f5ede0; position: relative; overflow: hidden;">



    <!-- Dekorasi lingkaran blur -->

    <div style="position: absolute; width: 400px; height: 400px; background: rgba(139,90,43,0.08); border-radius: 50%; top: -100px; left: -100px;"></div>

    <div style="position: absolute; width: 300px; height: 300px; background: rgba(139,90,43,0.06); border-radius: 50%; bottom: -80px; right: -80px;"></div>



    <div class="container" style="min-height: 100vh; display: flex; align-items: center; position: relative; z-index: 1;">

        <div class="row align-items-center w-100 g-5">



            <!-- Teks Kiri -->

            <div class="col-lg-6 text-center text-lg-start">



                <!-- Badge -->

                <span style="background: rgba(139,90,43,0.12); color: #6b4423; padding: 6px 18px; border-radius: 50px; font-size: 0.85rem; letter-spacing: 1px; text-transform: uppercase;">

                    🍫 Handmade with Love

                </span>



                <!-- Judul -->

                <h1 style="font-family: 'Georgia', serif; font-size: clamp(2.5rem, 6vw, 4.5rem); color: #4a2c0a; line-height: 1.15; margin-top: 20px; margin-bottom: 20px;">

                    <em>Made with love,</em><br>

                    <em>baked for you</em>

                </h1>



                <!-- Deskripsi -->

                <p style="color: #7a5c3a; font-size: 1.1rem; max-width: 420px; margin: 0 auto 35px; line-height: 1.8;">

                    Pilihan terbaik untuk teman ngeteh atau kumpul keluarga.

                    Made fresh every day with selected ingredients.

                </p>



                <!-- Tombol -->

                <div class="d-flex gap-3 justify-content-center justify-content-lg-start flex-wrap">

                   <a href="{{ route('orders.index') }}" style="background: #6b4423; color: #fff; padding: 14px 35px; border-radius: 50px; text-decoration: none; font-size: 1rem; transition: all 0.3s;"

                      onmouseover="this.style.background='#4a2c0a'; this.style.transform='translateY(-2px)'"

                      onmouseout="this.style.background='#6b4423'; this.style.transform='translateY(0)'">

                      Order Sekarang

                     </a>

                    <a href="#about" style="border: 2px solid #6b4423; color: #6b4423; padding: 14px 35px; border-radius: 50px; text-decoration: none; font-size: 1rem; transition: all 0.3s;"

                       onmouseover="this.style.background='#6b4423'; this.style.color='#fff'"

                       onmouseout="this.style.background='transparent'; this.style.color='#6b4423'">

                        Tentang Kami

                    </a>

                </div>



                <!-- Stats -->

                <div class="d-flex gap-4 mt-5 justify-content-center justify-content-lg-start">

                    <div>

                        <div style="font-size: 1.6rem; font-weight: bold; color: #4a2c0a;">200+</div>

                        <div style="font-size: 0.8rem; color: #9a7a5a;">Pelanggan Puas</div>

                    </div>

                    <div style="border-left: 1px solid #c9a87a; padding-left: 20px;">

                        <div style="font-size: 1.6rem; font-weight: bold; color: #4a2c0a;">10+</div>

                        <div style="font-size: 0.8rem; color: #9a7a5a;">Varian Produk</div>

                    </div>

                    <div style="border-left: 1px solid #c9a87a; padding-left: 20px;">

                        <div style="font-size: 1.6rem; font-weight: bold; color: #4a2c0a;">4.9⭐</div>

                        <div style="font-size: 0.8rem; color: #9a7a5a;">Rating</div>

                    </div>

                </div>

            </div>



            <!-- Gambar Kanan -->

            <div class="col-lg-6 text-center">

                <div style="position: relative; display: inline-block;">



                    <!-- Lingkaran background di belakang gambar -->

                    <div style="position: absolute; width: 380px; height: 380px; background: rgba(139,90,43,0.1); border-radius: 50%; top: 50%; left: 50%; transform: translate(-50%, -50%);"></div>

                    <div style="position: absolute; width: 440px; height: 440px; border: 2px dashed rgba(139,90,43,0.2); border-radius: 50%; top: 50%; left: 50%; transform: translate(-50%, -50%);"></div>



                    <!-- Gambar Utama -->

                    <img src="{{ asset('img/gambar3.jpg') }}"

                         alt="Crazy Bite's Product"

                         style="width: 340px; height: 340px; object-fit: cover; border-radius: 50%; border: 6px solid #fff; box-shadow: 0 20px 60px rgba(106,68,35,0.25); position: relative; z-index: 1;">



                    <!-- Badge mengambang -->

                    <div style="position: absolute; bottom: 20px; left: -20px; background: #fff; border-radius: 16px; padding: 10px 16px; box-shadow: 0 8px 25px rgba(0,0,0,0.12); z-index: 2;">

                        <div style="font-size: 0.9rem; font-weight: bold; color: #4a2c0a;">🍪 Fresh Baked</div>

                    </div>



                    <div style="position: absolute; top: 10px; right: -10px; background: #6b4423; color: #fff; border-radius: 16px; padding: 10px 16px; box-shadow: 0 8px 25px rgba(0,0,0,0.15); z-index: 2;">

                        <div style="font-size: 0.9rem; font-weight: bold;">Crazy Bite's</div>

                    </div>

                </div>

            </div>



        </div>

    </div>

</section>

<section id="galeri" class="container section-padding">

    <h2 class="section-title text-center">Menu Favorit Kami</h2>



    <div class="swiper mySwiper">

        <div class="swiper-wrapper">

            <div class="swiper-slide"><img src="{{ asset('img/brownies1.jpg') }}" class="img-potret" alt="Menu 1"></div>

            <div class="swiper-slide"><img src="{{ asset('img/menu2.jpg') }}" class="img-potret" alt="Menu 2"></div>

            <div class="swiper-slide"><img src="{{ asset('img/menu6.jpg') }}" class="img-potret" alt="Menu 3"></div>

            <div class="swiper-slide"><img src="{{ asset('img/menu4.jpg') }}" class="img-potret" alt="Menu 4"></div>

        </div>

        <div class="swiper-button-next"></div>

        <div class="swiper-button-prev"></div>

        <div class="swiper-pagination"></div>

    </div>

</section>

    <!-- 3. ABOUT US SECTION -->

   <section id="about" class="container section-padding">

        <div class="row align-items-center">

            <div class="col-md-6">

               <img src="{{ asset('img/gambar2.jpg') }}" class="img-fluid rounded shadow" alt="Tentang Crazy Bite's" style="max-height: 400px; width: 100%; object-fit: cover;">

            </div>

            <div class="col-md-6 ps-md-5 mt-4 mt-md-0">

                <h2 class="section-title">Tentang Kami</h2>

                <p class="contact-info text-dark">Crazy Bite's menghadirkan kebahagiaan di setiap gigitan. Kami memprioritaskan kualitas dan rasa untuk memastikan setiap pesanan memberikan kepuasan bagi pelanggan kami </p>

            </div>

        </div>

    </section>



    <!-- 4. SERVICE SECTION -->

    <section id="service" class="container section-padding">

        <div class="row g-4">

            <div class="col-md-4">

                <img src="img/layananpelanggan.png" class="img-service" alt="Layanan">

                <h4 class="card-title-custom">Layanan Pelanggan</h4>

                <p class="text-muted">Dukungan penuh untuk memastikan kepuasan Anda dalam setiap pesanan.</p>

            </div>

            <div class="col-md-4">

                <img src="img/pengantaran2.png" class="img-service" alt="Antar Kota">

                <h4 class="card-title-custom">Pengiriman Antar Kota</h4>

                <p class="text-muted">Layanan antar kota memastikan produk pilihan Anda sampai dengan aman.</p>

            </div>

            <div class="col-md-4">

                <img src="img/pengantaran.png" class="img-service" alt="Kue">

                <h4 class="card-title-custom">Pengiriman Kue</h4>

                <p class="text-muted">Kurir khusus kami menjamin kue tetap cantik sampai di tangan Anda.</p>

            </div>

        </div>

    </section>



    <!-- 5. EVENT SECTION -->

    <section id="event" class="b2b-box">

        <div class="container">

            <h2 class="section-title">B2B Dessert Partnership</h2>

            <p class="mb-4 mx-auto" style="max-width: 700px;">Bekerja sama menciptakan momen tak terlupakan dengan dessert premium untuk acara kantor atau pesta Anda.</p>

            <a href="https://wa.me/628815373739?text=Halo%20Admin%20Crazy%20Bite's,%20saya%20tertarik%20untuk%20mendapatkan%20informasi%20lebih%20lanjut%20mengenai%20layanan%20B2B%20Dessert%20Partnership.%20Apakah%20bisa%20dibantu%20terkait%20penawaran%20kerjasamanya?%20Terima%20kasih."

   class="btn btn-pesan mb-5"

   target="_blank">

   CONTACT ME

</a>



            <div class="row text-start g-4 mt-2">

                <div class="col-md-4">

                    <img src="img/hampers.jpg" class="img-event" alt="Corporate">

                    <h5 class="fw-bold">Corporate Partnership</h5>

                    <p class="text-muted small">Bingkisan eksklusif untuk relasi bisnis Anda.</p>

                </div>

                <div class="col-md-4">

                    <img src="img/birthday.jpg" class="img-event" alt="Event">

                    <h5 class="fw-bold">Event Catering</h5>

                    <p class="text-muted small">Catering dessert premium untuk berbagai perayaan.</p>

                </div>

                <div class="col-md-4">

                    <img src="img/whoolsale.png" class="img-event" alt="Wholesale">

                    <h5 class="fw-bold">Wholesale Partnership</h5>

                    <p class="text-muted small">Suplai rutin dengan harga spesial untuk usaha Anda.</p>

                </div>

            </div>

        </div>

    </section>



    <!-- 6. CONTACT US (FOOTER) -->

    <footer id="contact">

        <div class="container">

            <div class="row align-items-center mb-5">

                <div class="col-md-4">

                    <div class="footer-logo">crazy bite's</div>

                </div>

                <div class="col-md-8">

  </div>

            <div class="row pt-5 border-top border-secondary">

                <div class="col-md-3">

                    <h6 class="fw-bold mb-3">Our Stores</h6>

                    <p class="contact-info">📍 Depok, Jawa Barat<br>📍 Kesehatan, Bintaro Jaya</p>

                </div>

                <div class="col-md-3">

                    <h6 class="fw-bold mb-3">Contact Us</h6>

                    <p class="contact-info">Whatsapp: +62 811-XXXX<br>Email: info@crazybites.com</p>

                </div>

                <div class="col-md-3">

                    <h6 class="fw-bold mb-3">Information</h6>

                    <p class="contact-info">Shipping & Delivery<br>Terms & Conditions<br>FAQ & Help</p>

                </div>

                <div class="col-md-3">

                    <h6 class="fw-bold mb-3">Available On</h6>

                    <p class="contact-info">Tokopedia | GoFood | GrabFood</p>

                </div>

            </div>

        </div>

    </footer>



   <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>



<script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>



<script>

    var swiper = new Swiper(".mySwiper", {

        slidesPerView: 1, // Tampil 1 gambar di HP

        spaceBetween: 20,

        loop: true,

        autoplay: {

            delay: 3000,

            disableOnInteraction: false,

        },

        navigation: {

            nextEl: ".swiper-button-next",

            prevEl: ".swiper-button-prev",

        },

        pagination: {

            el: ".swiper-pagination",

            clickable: true,

        },

        // Responsif: Tampilkan lebih banyak gambar di layar lebar

        breakpoints: {

            768: { slidesPerView: 2 },

            1024: { slidesPerView: 3 }

        }

    });

</script>

</body>

</html>

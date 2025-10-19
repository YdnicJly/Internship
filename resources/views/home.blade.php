<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" type="image/png" href="{{ asset('images/logo.jpg') }}">
    <title>SIMMAGANG - Diskominfo Kepri</title>

    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Lottie Player -->
    <script src="https://unpkg.com/@lottiefiles/lottie-player@latest/dist/lottie-player.js"></script>

    <!-- Custom Styles -->
    <style>
        body {
            font-family: "Inter", "Segoe UI", sans-serif;
            background-color: #f9fafb;
            scroll-behavior: smooth;
        }

        /* Navbar */
        .navbar {
            transition: all 0.3s ease;
        }
        .navbar.scrolled {
            background-color: #ffffff !important;
            box-shadow: 0 2px 10px rgba(0,0,0,0.05);
        }

        .nav-link {
            font-weight: 500;
            color: #333 !important;
        }
        .nav-link:hover {
            color: #0d6efd !important;
        }

        /* Sections */
        section {
            padding: 100px 0;
        }

        /* Home Section */
        .home {
            min-height: 100vh;
            background: linear-gradient(135deg, #eef5ff 0%, #ffffff 100%);
            display: flex;
            align-items: center;
        }

        .home h1 {
            font-weight: 700;
            color: #1b1b1b;
        }

        .home p {
            color: #6c757d;
            font-size: 1.1rem;
        }

        .btn-primary {
            background-color: #4a90e2;
            border-color: #4a90e2;
        }
        .btn-primary:hover {
            background-color: #3b7cc0;
        }

        /* Tentang Section */
        .tentang {
            background-color: #ffffff;
        }

        .tentang h2 {
            font-weight: 700;
            color: #1b1b1b;
        }

        /* Contact Section */
        .contact {
            background-color: #eef5ff;
        }

        footer {
            background-color: #0d6efd;
            color: #fff;
            padding: 1.5rem 0;
        }
        footer a {
            color: #fff;
            text-decoration: underline;
        }

        @media (max-width: 768px) {
            .home {
                text-align: center;
            }
            .home .btn {
                width: 100%;
            }
        }
    </style>
</head>

<body>

    <!-- Navbar -->
<nav class="navbar navbar-expand-lg navbar-light bg-white fixed-top shadow-sm">
    <div class="container">
        <!-- Brand (Logo + Text) -->
        <a class="navbar-brand d-flex align-items-center fw-bold text-primary" href="#">
            <img src="{{ asset('images/logo.jpg') }}" alt="Logo SIMMAGANG" 
                 class="me-2" style="height: 40px; width: 40px; object-fit: cover; border-radius: 50%;">
            SIMMAGANG
        </a>

        <!-- Navbar Toggle -->
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" 
                data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" 
                aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <!-- Navbar Links -->
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ms-auto me-3">
                <li class="nav-item"><a class="nav-link" href="#home">Beranda</a></li>
                <li class="nav-item"><a class="nav-link" href="#tentang">Tentang</a></li>
                <li class="nav-item"><a class="nav-link" href="#contact">Kontak</a></li>
            </ul>
            <a href="{{ route('login') }}" class="btn btn-primary px-3">Login</a>
        </div>
    </div>
</nav>


    <!-- HOME Section -->
    <section id="home" class="home">
        <div class="container">
            <div class="row align-items-center gy-5">
                <div class="col-md-6">
                    <h1 class="display-5 mb-3">
                        Wujudkan Pengalaman Magang Terbaik <br>
                        di <span class="text-primary">Diskominfo Kepulauan Riau</span>
                    </h1>
                    <p class="lead mb-4">
                        Melalui sistem <strong>SIMMAGANG</strong>, proses magang menjadi lebih mudah, cepat, dan transparan.
                        Daftar, pantau progres, dan raih pengalaman kerja nyata di lingkungan profesional yang inovatif.
                    </p>
                    <div class="d-flex gap-3 flex-wrap">
                        <a href="{{ route('login') }}" class="btn btn-primary btn-lg">Mulai Sekarang</a>
                        <a href="{{ route('register') }}" class="btn btn-outline-dark btn-lg">Daftar</a>
                    </div>
                </div>
                <div class="col-md-6 text-center">
                    <!-- Lottie Animation -->
                    <lottie-player 
                        src="https://assets1.lottiefiles.com/packages/lf20_tfb3estd.json"  
                        background="transparent"  
                        speed="1"  
                        style="width: 400px; height: 400px;"  
                        loop  
                        autoplay>
                    </lottie-player>
                </div>
            </div>
        </div>
    </section>

    <!-- TENTANG Section -->
    <section id="tentang" class="tentang">
        <div class="container text-center">
            <h2 class="mb-4 text-primary">Tentang SIMMAGANG</h2>
            <p class="lead mx-auto" style="max-width: 800px;">
                <strong>SIMMAGANG</strong> (Sistem Informasi Magang) merupakan platform digital yang dikembangkan oleh 
                <strong>Dinas Komunikasi dan Informatika Provinsi Kepulauan Riau</strong> untuk mempermudah proses administrasi magang.
                Melalui sistem ini, peserta dapat melakukan pendaftaran, pemantauan status, hingga pengumpulan laporan magang secara daring.
                <br><br>
                Tujuan utama SIMMAGANG adalah menciptakan pengalaman magang yang efisien, transparan, dan mendukung pengembangan 
                kompetensi generasi muda di bidang teknologi dan komunikasi.
            </p>
        </div>
    </section>

    <!-- CONTACT Section -->
    <section id="contact" class="contact">
        <div class="container text-center">
            <h2 class="mb-4 text-primary">Kontak Kami</h2>
            <p class="lead mb-4">Hubungi kami untuk informasi lebih lanjut mengenai program magang di Diskominfo Kepulauan Riau.</p>

            <div class="d-flex flex-column align-items-center gap-2">
                <p><strong>Alamat:</strong> Jl. Basuki Rahmat No.1, Tanjungpinang, Kepulauan Riau</p>
                <p><strong>Email:</strong> diskominfo@kepriprov.go.id</p>
                <p><strong>Telepon:</strong> (0771) 456789</p>
                <a href="https://kepriprov.go.id" target="_blank" class="btn btn-primary mt-3">
                    Kunjungi Website Resmi
                </a>
            </div>
        </div>
    </section>

    <!-- FOOTER -->
    <footer class="text-center">
        <div class="container">
            <p class="mb-1">&copy; {{ date('Y') }} SIMMAGANG - Diskominfo Kepulauan Riau. All rights reserved.</p>
            <small>Dikembangkan oleh <a href="#">Tim IT SIMMAGANG</a></small>
        </div>
    </footer>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

    <script>
        // Navbar color on scroll
        window.addEventListener('scroll', function() {
            const navbar = document.querySelector('.navbar');
            navbar.classList.toggle('scrolled', window.scrollY > 50);
        });
    </script>
</body>
</html>

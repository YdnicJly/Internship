<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="icon" type="image/png" href="{{ asset('images/logo.jpg') }}">
    <title>SIMMAGANG</title>

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom Styles -->
    <style>
        body {
            font-family: "Inter", "Segoe UI", sans-serif;
            background-color: #f9fafb;
        }

        /* Navbar */
        .navbar {
            transition: all 0.3s ease;
        }
        .navbar.scrolled {
            background-color: #ffffff !important;
            box-shadow: 0 2px 10px rgba(0,0,0,0.05);
        }

        /* Hero Section */
        .hero {
            min-height: 100vh;
            display: flex;
            align-items: center;
            background: linear-gradient(135deg, #f8f9ff 0%, #ffffff 100%);
            padding-top: 100px;
            padding-bottom: 100px;
        }

        .hero h1 {
            font-weight: 700;
            color: #1b1b1b;
        }

        .hero p {
            color: #6c757d;
            font-size: 1.1rem;
        }

        .btn-primary {
            background-color: #0056b3;
            border-color: #0056b3;
        }
        .btn-primary:hover {
            background-color: #004999;
        }

        .btn-dark {
            background-color: #1b1b1b;
            border: none;
        }

        .hero img {
            max-height: 420px;
        }

        /* Footer */
        footer {
            background-color: #0d6efd;
            color: #fff;
            padding: 1.5rem 0;
        }
        footer a {
            color: #fff;
            text-decoration: underline;
        }

        /* Responsive */
        @media (max-width: 768px) {
            .hero {
                text-align: center;
            }
            .hero .btn {
                width: 100%;
            }
        }
    </style>
</head>

<body>

    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-light bg-white fixed-top shadow-sm">
        <div class="container">
            <a class="navbar-brand d-flex align-items-center" href="/">
                <span class="fw-bold text-primary">SIMMAGANG</span>
            </a>

            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" 
                    data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" 
                    aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto me-3">
                </ul>

                <a href="{{ route('login') }}" class="btn btn-primary px-3">
                    Login
                </a>
            </div>
        </div>
    </nav>

    <!-- Hero Section -->
    <section class="hero">
        <div class="container">
            <div class="row align-items-center gy-5">
                <div class="col-md-6">
                    <h1 class="display-5 mb-3">
                        Manage Your Internship <br>
                        with <span class="text-primary">SIMMAGANG</span>
                    </h1>
                    <p class="lead mb-4">
                        Streamline your internship journey — from application to completion, all in one integrated system.
                    </p>

                    <div class="d-flex gap-3 flex-wrap">
                        <a href="{{ route('login') }}" class="btn btn-primary btn-lg">
                            Get Started
                        </a>
                        <a href="{{ route('register') }}" class="btn btn-outline-dark btn-lg">
                            Register
                        </a>
                    </div>
                </div>

                <div class="col-md-6 text-center">
                    <img src="{{ asset('images/internship.png') }}" 
                         alt="Internship Illustration" 
                         class="img-fluid rounded shadow-sm">
                </div>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer class="text-center">
        <div class="container">
            <p class="mb-1">&copy; {{ date('Y') }} SIMMAGANG Internship System. All rights reserved.</p>
            <small>Developed by <a href="#">SIMMAGANG IT Team</a></small>
        </div>
    </footer>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

    <script>
        // Change navbar background when scrolling
        window.addEventListener('scroll', function() {
            const navbar = document.querySelector('.navbar');
            navbar.classList.toggle('scrolled', window.scrollY > 50);
        });

        // Smooth scroll for internal links
        document.querySelectorAll('.nav-link[href^="#"]').forEach(link => {
            link.addEventListener('click', function(e) {
                e.preventDefault();
                document.querySelector(this.getAttribute('href')).scrollIntoView({
                    behavior: 'smooth'
                });
            });
        });
    </script>
</body>
</html>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="icon" type="image/png" href="{{ asset('images/logo.jpg') }}">
  <title>SIMMAGANG</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <!-- SweetAlert2 -->
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>
<body class="bg-light">

  <div class="container d-flex align-items-center justify-content-center vh-100">
    <div class="card shadow-lg p-4" style="width: 400px;">
      <h4 class="text-center mb-4">SIMMAGANG</h4>

      <form method="POST" action="{{ route('login') }}">
        @csrf

        <div class="mb-3">
          <label for="email" class="form-label">Email <span class="text-danger">*</span></label>
          <input type="email" class="form-control" name="email" id="email" required autofocus>
        </div>

        <div class="mb-3">
          <label for="password" class="form-label">Password <span class="text-danger">*</span></label>
          <input type="password" class="form-control" name="password" id="password" required>
        </div>

        <div class="d-flex justify-content-between align-items-center mb-3">
          <div class="form-check">
            <input class="form-check-input" type="checkbox" name="remember" id="remember">
            <label class="form-check-label" for="remember">Ingat saya</label>
          </div>
          <a href="#" class="small text-decoration-none">Lupa Password?</a>
        </div>

        <button type="submit" class="btn btn-primary w-100 mb-2">Masuk</button>

        <a href="{{ url('/') }}" class="btn btn-outline-secondary w-100">
          ← Kembali ke Beranda
        </a>
      </form>

      <p class="text-center mt-3 mb-0 small">
        Belum punya akun? <a href="{{ route('register') }}" class="text-decoration-none">Daftar di sini</a>
      </p>
    </div>
  </div>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

  {{-- SweetAlert Pesan Login --}}
  <script>
    @if (session('success'))
      Swal.fire({
        icon: 'success',
        title: 'Berhasil!',
        text: "{{ session('success') }}",
        showConfirmButton: false,
        timer: 1800
      });
    @endif

    @if (session('error'))
      Swal.fire({
        icon: 'error',
        title: 'Gagal!',
        text: "{{ session('error') }}",
        showConfirmButton: true,
      });
    @endif
  </script>
</body>
</html>

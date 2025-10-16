<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Register - Sistem Magang Diskominfo</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

  <div class="container d-flex align-items-center justify-content-center vh-100">
    <div class="card shadow-lg p-4" style="width: 500px;">
      <h4 class="text-center mb-4">Pendaftaran Akun Magang</h4>

      <form method="POST" action="{{ route('register') }}">
        @csrf

        <div class="row g-2">
          <div class="col-md-6 mb-3">
            <label class="form-label">Nama Lengkap</label>
            <input type="text" class="form-control" name="name" required>
          </div>

          <div class="col-md-6 mb-3">
            <label class="form-label">Email</label>
            <input type="email" class="form-control" name="email" required>
          </div>
        </div>

        <div class="row g-2">
          <div class="col-md-6 mb-3">
            <label class="form-label">Asal Sekolah / Universitas</label>
            <input type="text" class="form-control" name="school_name" required>
          </div>

          <div class="col-md-6 mb-3">
            <label class="form-label">Jurusan</label>
            <input type="text" class="form-control" name="major" required>
          </div>
        </div>

        <div class="row g-2">
          <div class="col-md-6 mb-3">
            <label class="form-label">Jenjang Pendidikan</label>
            <select name="education_level" class="form-select" required>
              <option value="">-- Pilih --</option>
              <option value="SMK">SMK</option>
              <option value="Mahasiswa">Mahasiswa</option>
            </select>
          </div>

          <div class="col-md-6 mb-3">
            <label class="form-label">Nomor Telepon</label>
            <input type="text" class="form-control" name="phone" required>
          </div>
        </div>

        <div class="mb-3">
          <label class="form-label">Alamat</label>
          <textarea name="address" class="form-control" rows="2" required></textarea>
        </div>

        <div class="row g-2">
          <div class="col-md-6 mb-3">
            <label class="form-label">Password</label>
            <input type="password" class="form-control" name="password" required>
          </div>

          <div class="col-md-6 mb-3">
            <label class="form-label">Konfirmasi Password</label>
            <input type="password" class="form-control" name="password_confirmation" required>
          </div>
        </div>

        <button type="submit" class="btn btn-success w-100 mb-2">Daftar Sekarang</button>

        {{-- Back to landing --}}
        <a href="{{ url('/') }}" class="btn btn-outline-secondary w-100">
          ← Kembali ke Beranda
        </a>
      </form>

      <p class="text-center mt-3 mb-0 small">
        Sudah punya akun? <a href="{{ route('login') }}" class="text-decoration-none">Login di sini</a>
      </p>
    </div>
  </div>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

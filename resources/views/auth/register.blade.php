<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="icon" type="image/png" href="{{ asset('images/logo.jpg') }}">
  <title>SIMMAGANG</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

  <style>
    /* ✅ Responsiveness adjustments */
    body {
      background-color: #f8f9fa;
      min-height: 100vh;
      display: flex;
      align-items: center;
      justify-content: center;
      padding: 1rem;
    }

    .card {
      max-width: 500px;
      width: 100%;
      border-radius: 1rem;
    }

    @media (max-width: 576px) {
      .card {
        padding: 1.5rem !important;
      }
      h4 {
        font-size: 1.25rem;
      }
      .form-label {
        font-size: 0.9rem;
      }
    }
  </style>
</head>

<body>

  <div class="container">
    <div class="card shadow-lg p-4 mx-auto">
      <h4 class="text-center mb-4">Pendaftaran Akun Magang</h4>

      <form method="POST" action="{{ route('register') }}">
        @csrf

        <div class="row g-3">
          <div class="col-12 col-md-6">
            <label class="form-label">Nama Lengkap <span class="text-danger">*</span></label>
            <input type="text" name="name" class="form-control @error('name') is-invalid @enderror"
                   value="{{ old('name') }}" required>
            @error('name')
              <div class="invalid-feedback">{{ $message }}</div>
            @enderror
          </div>

          <div class="col-12 col-md-6">
            <label class="form-label">Email <span class="text-danger">*</span></label>
            <input type="email" name="email" class="form-control @error('email') is-invalid @enderror"
                   value="{{ old('email') }}" required>
            @error('email')
              <div class="invalid-feedback">{{ $message }}</div>
            @enderror
          </div>
        </div>

        <div class="row g-3 mt-1">
          <div class="col-12 col-md-6">
            <label class="form-label">Asal Sekolah / Universitas <span class="text-danger">*</span></label>
            <input type="text" name="school_name" class="form-control @error('school_name') is-invalid @enderror"
                   value="{{ old('school_name') }}" required>
            @error('school_name')
              <div class="invalid-feedback">{{ $message }}</div>
            @enderror
          </div>

          <div class="col-12 col-md-6">
            <label class="form-label">Jurusan <span class="text-danger">*</span></label>
            <input type="text" name="major" class="form-control @error('major') is-invalid @enderror"
                   value="{{ old('major') }}" required>
            @error('major')
              <div class="invalid-feedback">{{ $message }}</div>
            @enderror
          </div>
        </div>

        <div class="row g-3 mt-1">
          <div class="col-12 col-md-6">
            <label class="form-label">Jenjang Pendidikan <span class="text-danger">*</span></label>
            <select name="education_level" class="form-select @error('education_level') is-invalid @enderror" required>
              <option value="">-- Pilih --</option>
              <option value="SMK" {{ old('education_level') == 'SMK' ? 'selected' : '' }}>SMK</option>
              <option value="Universitas" {{ old('education_level') == 'Universitas' ? 'selected' : '' }}>Mahasiswa</option>
            </select>
            @error('education_level')
              <div class="invalid-feedback">{{ $message }}</div>
            @enderror
          </div>

          <div class="col-12 col-md-6">
            <label class="form-label">Nomor Telepon <span class="text-danger">*</span></label>
            <input type="text" name="phone" class="form-control @error('phone') is-invalid @enderror"
                   value="{{ old('phone') }}" required>
            @error('phone')
              <div class="invalid-feedback">{{ $message }}</div>
            @enderror
          </div>
        </div>

        <div class="mb-3 mt-1">
          <label class="form-label">Alamat <span class="text-danger">*</span></label>
          <textarea name="address" rows="2" class="form-control @error('address') is-invalid @enderror" required>{{ old('address') }}</textarea>
          @error('address')
            <div class="invalid-feedback">{{ $message }}</div>
          @enderror
        </div>

        <div class="row g-3 mt-1">
          <div class="col-12 col-md-6">
            <label class="form-label">Password <span class="text-danger">*</span></label>
            <input type="password" name="password" class="form-control @error('password') is-invalid @enderror" required>
            @error('password')
              <div class="invalid-feedback">{{ $message }}</div>
            @enderror
          </div>

          <div class="col-12 col-md-6">
            <label class="form-label">Konfirmasi Password <span class="text-danger">*</span></label>
            <input type="password" name="password_confirmation" class="form-control" required>
          </div>
        </div>

        <button type="submit" class="btn btn-success w-100 mt-3">Daftar Sekarang</button>

        <a href="{{ url('/') }}" class="btn btn-outline-secondary w-100 mt-2">
          ← Kembali ke Beranda
        </a>
      </form>

      <p class="text-center mt-3 mb-0 small">
        Sudah punya akun? <a href="{{ route('login') }}" class="text-decoration-none">Login di sini</a>
      </p>
    </div>
  </div>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

  <script>
    @if (session('success'))
      Swal.fire({
        icon: 'success',
        title: 'Berhasil!',
        text: "{{ session('success') }}",
        showConfirmButton: false,
        timer: 2000
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

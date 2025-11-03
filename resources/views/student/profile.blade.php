<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" type="image/png" href="{{ asset('images/logo.jpg') }}">
    <title>SIMMAGANG</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css">

    <style>
        body {
            font-family: "Inter", "Segoe UI", sans-serif;
            background-color: #f8f9fa;
        }

        .sidebar {
            width: 250px;
            height: 100vh;
            position: fixed;
            background-color: #0d6efd;
            color: #fff;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
            transition: transform 0.3s ease-in-out;
            z-index: 1050;
        }

        .sidebar .nav-link {
            color: #ffffffcc;
            font-weight: 500;
        }

        .sidebar .nav-link:hover,
        .sidebar .nav-link.active {
            color: #fff;
            background-color: rgba(255, 255, 255, 0.15);
            border-radius: 6px;
        }

        .content {
            margin-left: 250px;
            padding: 2rem;
            transition: margin-left 0.3s ease-in-out;
        }

        .card {
            border: none;
            border-radius: 12px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.05);
        }

        .navbar {
            background: white;
            border-bottom: 1px solid #dee2e6;
        }

        /* Hamburger Button */
        .menu-toggle {
            display: none;
            position: fixed;
            top: 1rem;
            right: 1rem; /* ⬅️ ubah dari left:1rem ke right:1rem */
            z-index: 1051;
            background-color: #0d6efd;
            color: white;
            border: none;
            border-radius: 8px;
            padding: 0.5rem 0.75rem;
            cursor: pointer;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.2);
        }

        .menu-toggle:hover {
            background-color: #0b5ed7;
        }

        /* Overlay untuk menutup sidebar di mobile */
        .sidebar-overlay {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.5);
            z-index: 1040;
        }

        /* Mobile Responsive */
        @media (max-width: 768px) {
            .sidebar {
                transform: translateX(-100%);
            }

            .sidebar.show {
                transform: translateX(0);
            }

            .sidebar-overlay.show {
                display: block;
            }

            .content {
                margin-left: 0;
                padding: 1rem;
                padding-top: 4rem;
            }

            .menu-toggle {
                display: block;
                right: 1rem;
                top: 1rem;
            }

            /* Navbar responsive */
            .navbar .navbar-brand {
                font-size: 0.9rem;
            }

            .navbar .d-flex {
                flex-direction: column;
                align-items: flex-start !important;
                gap: 0.5rem;
            }

            .navbar .d-flex span {
                font-size: 0.8rem;
            }

            .navbar .d-flex img {
                width: 35px;
                height: 35px;
            }

            /* Cards responsive */
            .card {
                margin-bottom: 1rem;
            }

            /* Form responsive */
            .col-md-4,
            .col-md-6 {
                margin-bottom: 1rem;
            }

            /* Modal responsive */
            .modal-lg {
                max-width: 95%;
            }
        }

        @media (max-width: 576px) {
            .content {
                padding: 0.5rem;
                padding-top: 4rem;
            }

            .navbar .navbar-brand {
                font-size: 0.8rem;
            }

            .card {
                padding: 1rem !important;
            }

            h5 {
                font-size: 1rem;
            }

            .btn {
                font-size: 0.85rem;
                padding: 0.4rem 0.8rem;
            }
        }
    </style>
</head>

<body>
    <!-- Hamburger Menu Button -->
    <button class="menu-toggle" id="menuToggle">
        <i class="bi bi-list fs-4"></i>
    </button>

    <!-- Overlay -->
    <div class="sidebar-overlay" id="sidebarOverlay"></div>

    <!-- Sidebar -->
    <div class="sidebar p-3" id="sidebar">
        <div>
            <h5 class="fw-bold mb-4 d-flex align-items-center">
                <i class="bi bi-person-workspace me-2"></i> SIMMAGANG
            </h5>
            <ul class="nav flex-column gap-1">
                <li>
                    <a href="{{ route('student.dashboard') }}"
                        class="nav-link {{ request()->routeIs('student.dashboard') ? 'active' : '' }}">
                        <i class="bi bi-briefcase me-2"></i> Beranda
                    </a>
                </li>

                <li>
                    <a href="{{ route('student.applications') }}"
                        class="nav-link {{ request()->routeIs('student.applications') ? 'active' : '' }}">
                        <i class="bi bi-clipboard-check me-2"></i> Lamaran Saya
                    </a>
                </li>

                @php
                    $hasActiveApplication = auth()
                        ->user()
                        ->applications()
                        ->whereIn('status', ['active', 'completed'])
                        ->exists();
                @endphp

                @if ($hasActiveApplication)
                    <li>
                        <a href="{{ route('student.journal') }}"
                            class="nav-link {{ request()->routeIs('student.journal') ? 'active' : '' }}">
                            <i class="bi bi-journal-text me-2"></i> Jurnal Magang
                        </a>
                    </li>

                    <li>
                        <a href="{{ route('student.evaluation') }}"
                            class="nav-link {{ request()->routeIs('student.evaluation') ? 'active' : '' }}">
                            <i class="bi bi-award me-2"></i> Evaluasi
                        </a>
                    </li>
                @endif

                <li>
                    <a href="{{ route('profile') }}"
                        class="nav-link {{ request()->routeIs('profile') ? 'active' : '' }}">
                        <i class="bi bi-person-lines-fill me-2"></i> Profil
                    </a>
                </li>
            </ul>
        </div>

        <div>
            <hr class="text-white-50">
            <button type="button" class="btn btn-outline-light w-100" data-bs-toggle="modal"
                data-bs-target="#logoutModal">
                <i class="bi bi-box-arrow-right me-1"></i> Keluar
            </button>
        </div>
    </div>

    <!-- Main Content -->
    <div class="content">
        <!-- Navbar -->
          <nav class="navbar navbar-expand-lg navbar-light bg-white mb-4 rounded shadow-sm p-3">
    <div class="container-fluid flex-wrap justify-content-between gap-2">
      <span class="navbar-brand mb-0 h5">Profil Saya</span>
      <div class="d-flex align-items-center gap-2">
        <span class="text-muted small d-none d-sm-inline">{{ Auth::user()->name ?? 'Student' }}</span>
        <img
          src="https://ui-avatars.com/api/?name={{ urlencode(Auth::user()->name ?? 'A') }}&background=0d6efd&color=fff"
          class="rounded-circle"
          width="40"
          height="40"
          alt="Foto Admin">
      </div>
    </div>
  </nav>
@if (session('success'))
    <div class="alert alert-success alert-dismissible fade show" role="alert" id="success-alert">
        {{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    </div>

    <script>
        // Tunggu 3 detik lalu sembunyikan alert
        setTimeout(() => {
            const alert = document.getElementById('success-alert');
            if (alert) {
                // Tambahkan animasi fade out
                alert.classList.remove('show');
                alert.classList.add('fade');
                // Hapus elemen dari DOM setelah 500ms (animasi Bootstrap)
                setTimeout(() => alert.remove(), 500);
            }
        }, 3000);
    </script>
@endif
    <!-- Profil -->
    <div class="card p-4 mb-4">
      <div class="d-flex align-items-center mb-4">
        <img
          src="{{ Auth::user()->photo ? asset('storage/' . Auth::user()->photo) : 'https://ui-avatars.com/api/?name=' . urlencode(Auth::user()->name) . '&background=0d6efd&color=fff' }}"
          class="profile-avatar me-3" alt="Foto Profil">
        <div>
          <h5 class="mb-0">{{ Auth::user()->name }}</h5>
          <small class="text-muted">{{ Auth::user()->email }}</small>
        </div>
      </div>

      <form action="{{ route('profile.update') }}" method="POST" enctype="multipart/form-data">
  @csrf
  @method('PUT')

  <div class="row g-3">
    <!-- Nama Lengkap -->
    <div class="col-md-6">
      <label class="form-label fw-semibold">Nama Lengkap</label>
      <input type="text" name="name" class="form-control"
        value="{{ old('name', Auth::user()->name) }}" required>
    </div>

    <!-- Email -->
    <div class="col-md-6">
      <label class="form-label fw-semibold">Email</label>
      <input type="email" name="email" class="form-control"
        value="{{ old('email', Auth::user()->email) }}" required>
    </div>

    <!-- Nama Sekolah / Universitas -->
    <div class="col-md-6">
      <label class="form-label fw-semibold">Asal Sekolah / Universitas</label>
      <input type="text" name="school_name" class="form-control"
        value="{{ old('school_name', Auth::user()->school_name) }}" required>
    </div>

    <!-- Jurusan -->
    <div class="col-md-6">
      <label class="form-label fw-semibold">Jurusan / Program Studi</label>
      <input type="text" name="major" class="form-control"
        value="{{ old('major', Auth::user()->major) }}" required>
    </div>

    <!-- Jenjang Pendidikan -->
    <div class="col-md-6">
      <label class="form-label fw-semibold">Jenjang Pendidikan</label>
      <select name="education_level" class="form-select" required>
        <option value="SMK" {{ Auth::user()->education_level == 'SMK' ? 'selected' : '' }}>SMA / SMK</option>
        <option value="Universitas" {{ Auth::user()->education_level == 'Universitas' ? 'selected' : '' }}>Mahasiswa</option>
      </select>
    </div>

    <!-- Nomor Telepon -->
    <div class="col-md-6">
      <label class="form-label fw-semibold">Nomor Telepon</label>
      <input type="text" name="phone" class="form-control"
        value="{{ old('phone', Auth::user()->phone) }}">
    </div>

    <!-- Alamat -->
    <div class="col-12">
      <label class="form-label fw-semibold">Alamat Lengkap</label>
      <textarea name="address" class="form-control" rows="2"
        placeholder="Masukkan alamat lengkap Anda">{{ old('address', Auth::user()->address) }}</textarea>
    </div>

    <!-- Foto Profil -->
    <div class="col-md-6">
      <label class="form-label fw-semibold">Foto Profil</label>
      <input type="file" name="profile_photo" accept="image/*" class="form-control">
      <small class="text-muted">Opsional - JPG/PNG maks. 2MB</small>
    </div>

    <!-- Tombol Simpan -->
    <div class="col-12 text-end mt-3">
      <button type="submit" class="btn btn-primary px-4">
        <i class="bi bi-save me-1"></i> Simpan Perubahan
      </button>
    </div>
  </div>
</form>

    </div>

    <!-- Ganti Kata Sandi -->
    <div class="card p-4">
      <h5 class="mb-3"><i class="bi bi-lock-fill me-2 text-primary"></i> Ganti Kata Sandi</h5>
      <form action="{{ route('profile.changePassword') }}" method="POST">
        @csrf
        @method('PUT')
        <div class="row g-3">
          <div class="col-md-4">
            <label class="form-label fw-semibold">Kata Sandi Lama</label>
            <input type="password" name="current_password" class="form-control" required>
          </div>
          <div class="col-md-4">
            <label class="form-label fw-semibold">Kata Sandi Baru</label>
            <input type="password" name="new_password" class="form-control" required>
          </div>
          <div class="col-md-4">
            <label class="form-label fw-semibold">Konfirmasi Kata Sandi Baru</label>
            <input type="password" name="new_password_confirmation" class="form-control" required>
          </div>
          <div class="col-12 text-end mt-3">
            <button type="submit" class="btn btn-success px-4">
              <i class="bi bi-key-fill me-1"></i> Ubah Kata Sandi
            </button>
          </div>
        </div>
      </form>
    </div>
  </div>

  <!-- Modal Logout -->
  <div class="modal fade" id="logoutModal" tabindex="-1" aria-labelledby="logoutModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content border-0 shadow">
        <div class="modal-header bg-danger text-white">
          <h5 class="modal-title" id="logoutModalLabel"><i class="bi bi-box-arrow-right me-2"></i>Konfirmasi Logout</h5>
          <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Tutup"></button>
        </div>
        <div class="modal-body">Apakah Anda yakin ingin keluar dari akun ini?</div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
            <i class="bi bi-x-circle me-1"></i> Batal
          </button>
          <form action="{{ route('logout') }}" method="POST" class="d-inline">
            @csrf
            <button type="submit" class="btn btn-danger">
              <i class="bi bi-box-arrow-right me-1"></i> Keluar
            </button>
          </form>
        </div>
      </div>
    </div>
  </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <!-- ✅ Tambahkan library PDF.js -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdf.js/2.16.105/pdf.min.js"></script>   
      <script>
        // File size validation
        document.querySelectorAll('.file-input').forEach(input => {
            input.addEventListener('change', function () {
                const file = this.files[0];
                if (file && file.size > 2 * 1024 * 1024) {
                    alert('Ukuran file tidak boleh lebih dari 2MB!');
                    this.value = '';
                }
            });
        });

        // Sidebar Toggle
        const menuToggle = document.getElementById('menuToggle');
        const sidebar = document.getElementById('sidebar');
        const sidebarOverlay = document.getElementById('sidebarOverlay');

        menuToggle.addEventListener('click', function() {
            sidebar.classList.toggle('show');
            sidebarOverlay.classList.toggle('show');
        });

        sidebarOverlay.addEventListener('click', function() {
            sidebar.classList.remove('show');
            sidebarOverlay.classList.remove('show');
        });

        // Close sidebar when clicking a link (mobile)
        document.querySelectorAll('.sidebar .nav-link').forEach(link => {
            link.addEventListener('click', function() {
                if (window.innerWidth <= 768) {
                    sidebar.classList.remove('show');
                    sidebarOverlay.classList.remove('show');
                }
            });
        });
    </script>
</body>

</html>

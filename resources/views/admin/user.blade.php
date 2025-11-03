<!DOCTYPE html>
<html lang="id">

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
      right: 1rem;
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

    /* Overlay */
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

    /* Responsive */
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

      .card {
        margin-bottom: 1rem;
      }

      .col-md-4,
      .col-md-6 {
        margin-bottom: 1rem;
      }

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
  <!-- Hamburger Button -->
  <button class="menu-toggle" id="menuToggle">
    <i class="bi bi-list fs-4"></i>
  </button>

  <!-- Overlay -->
  <div class="sidebar-overlay" id="sidebarOverlay"></div>

  <!-- Sidebar -->
  <div class="sidebar p-3" id="sidebar">
    <div>
      <h5 class="fw-bold mb-4 d-flex align-items-center">
        <i class="bi bi-building me-2"></i> SIMMAGANG
      </h5>
      <ul class="nav flex-column gap-1">
        <li><a href="{{ route('admin.dashboard') }}"
            class="nav-link {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
            <i class="bi bi-speedometer2 me-2"></i> Beranda
          </a></li>
        <li><a href="{{ route('admin.positions') }}"
            class="nav-link {{ request()->routeIs('admin.positions') ? 'active' : '' }}">
            <i class="bi bi-briefcase me-2"></i> Lowongan Magang
          </a></li>
        <li><a href="{{ route('admin.applicants') }}"
            class="nav-link {{ request()->routeIs('admin.applicants') ? 'active' : '' }}">
            <i class="bi bi-people me-2"></i> Data Pendaftar
          </a></li>
        <li><a href="{{ route('admin.interviews') }}"
            class="nav-link {{ request()->routeIs('admin.interviews') ? 'active' : '' }}">
            <i class="bi bi-calendar-event me-2"></i> Jadwal Wawancara
          </a></li>
        <li><a href="{{ route('admin.intern') }}"
            class="nav-link {{ request()->routeIs('admin.intern') ? 'active' : '' }}">
            <i class="bi bi-journal-check me-2"></i> Data Pemagang
          </a></li>
        <li><a href="{{ route('admin.user') }}"
            class="nav-link {{ request()->routeIs('admin.user') ? 'active' : '' }}">
            <i class="bi bi-person-gear me-2"></i> Manajemen Pengguna
          </a></li>
      </ul>
    </div>

    <div>
      <hr class="text-white-50">
      <button type="button" class="btn btn-outline-light w-100" data-bs-toggle="modal" data-bs-target="#logoutModal">
        <i class="bi bi-box-arrow-right me-1"></i> Keluar
      </button>
    </div>
  </div>

  <!-- Main Content -->
  <div class="content">

      <nav class="navbar navbar-expand-lg navbar-light bg-white mb-4 rounded shadow-sm p-3">
    <div class="container-fluid flex-wrap justify-content-between gap-2">
      <span class="navbar-brand mb-0 h5">Manajemen Data Pengguna</span>
      <div class="d-flex align-items-center gap-2">
        <span class="text-muted small d-none d-sm-inline">{{ Auth::user()->name ?? 'Admin' }}</span>
        <img
          src="https://ui-avatars.com/api/?name={{ urlencode(Auth::user()->name ?? 'A') }}&background=0d6efd&color=fff"
          class="rounded-circle" width="40" height="40" alt="Foto Admin">
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
    <div class="card p-4">
      <div class="table-responsive">
      <table id="usersTable" class="table table-striped align-middle">
        <thead class="table-light">
          <tr>
            <th>Nama</th>
            <th>Email</th>
            <th>Peran</th>
            <th class="text-end">Aksi</th>
          </tr>
        </thead>
        <tbody>
          @forelse($users as $user)
            <tr>
              <td>{{ $user->name }}</td>
              <td>{{ $user->email }}</td>
              <td>
                @if($user->role === 'admin')
                  <span class="badge bg-danger">Admin</span>
                @else
                  <span class="badge bg-primary">Mahasiswa</span>
                @endif
              </td>
              <td class="text-end">
                <button class="btn btn-sm btn-outline-warning" data-bs-toggle="modal"
                  data-bs-target="#editUserModal{{ $user->id }}">
                  <i class="bi bi-pencil"></i>
                </button>
                <form action="{{ route('admin.user.destroy', $user->id) }}" method="POST" class="d-inline">
                  @csrf
                  @method('DELETE')
                  <button type="submit" class="btn btn-sm btn-outline-danger"
                    onclick="return confirm('Apakah Anda yakin ingin menghapus pengguna ini?')">
                    <i class="bi bi-trash"></i>
                  </button>
                </form>
              </td>
            </tr>

            <!-- Modal Edit -->
            <div class="modal fade" id="editUserModal{{ $user->id }}" tabindex="-1" aria-hidden="true">
              <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content border-0 shadow">
                  <div class="modal-header bg-warning text-white">
                    <h5 class="modal-title"><i class="bi bi-pencil me-2"></i>Ubah Pengguna</h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                  </div>
                  <form action="{{ route('admin.user.update', $user->id) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="modal-body">
                      <div class="mb-3">
                        <label class="form-label">Nama Lengkap</label>
                        <input type="text" name="name" class="form-control" value="{{ $user->name }}" required>
                      </div>
                      <div class="mb-3">
                        <label class="form-label">Email</label>
                        <input type="email" name="email" class="form-control" value="{{ $user->email }}" required>
                      </div>
                      <div class="mb-3">
                        <label class="form-label">Peran</label>
                        <select name="role" class="form-select" required>
                          <option value="student" @selected($user->role == 'student')>Mahasiswa</option>
                          <option value="admin" @selected($user->role == 'admin')>Admin</option>
                        </select>
                      </div>
                      <div class="mb-3">
                        <label class="form-label">Kata Sandi Baru <small class="text-muted">(biarkan kosong jika tidak
                            diubah)</small></label>
                        <input type="password" name="password" class="form-control" placeholder="Masukkan kata sandi baru">
                      </div>
                    </div>
                    <div class="modal-footer">
                      <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                      <button type="submit" class="btn btn-warning">Simpan Perubahan</button>
                    </div>
                  </form>
                </div>
              </div>
            </div>
          @empty
            <tr>
              <td colspan="4" class="text-center text-muted py-3">Tidak ada pengguna yang ditemukan.</td>
            </tr>
          @endforelse
        </tbody>
      </table>
      </div>
    </div>
  </div>

  <!-- Modal Tambah -->
  <div class="modal fade" id="addUserModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content border-0 shadow">
        <div class="modal-header bg-primary text-white">
          <h5 class="modal-title"><i class="bi bi-plus-circle me-2"></i>Tambah Pengguna Baru</h5>
          <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
        </div>
        <form action="{{ route('admin.user.store') }}" method="POST">
          @csrf
          <div class="modal-body">
            <div class="mb-3">
              <label class="form-label">Nama Lengkap</label>
              <input type="text" name="name" class="form-control" placeholder="Masukkan nama lengkap" required>
            </div>
            <div class="mb-3">
              <label class="form-label">Email</label>
              <input type="email" name="email" class="form-control" placeholder="Masukkan email" required>
            </div>
            <div class="mb-3">
              <label class="form-label">Kata Sandi</label>
              <input type="password" name="password" class="form-control" placeholder="Masukkan kata sandi" required>
            </div>
            <div class="mb-3">
              <label class="form-label">Peran</label>
              <select name="role" class="form-select" required>
                <option value="student">Mahasiswa</option>
                <option value="admin">Admin</option>
              </select>
            </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
            <button type="submit" class="btn btn-primary">Tambah</button>
          </div>
        </form>
      </div>
    </div>
  </div>

  <!-- Modal Logout -->
  <div class="modal fade" id="logoutModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content border-0 shadow">
        <div class="modal-header bg-danger text-white">
          <h5 class="modal-title"><i class="bi bi-box-arrow-right me-2"></i>Konfirmasi Keluar</h5>
          <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
        </div>
        <div class="modal-body">Apakah Anda yakin ingin keluar dari akun ini?</div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
          <form action="{{ route('logout') }}" method="POST" class="d-inline">
            @csrf
            <button type="submit" class="btn btn-danger">Keluar</button>
          </form>
        </div>
      </div>
    </div>
  </div>

  <!-- JS -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
  <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
  <script src="https://cdn.datatables.net/1.13.7/js/jquery.dataTables.min.js"></script>
  <script src="https://cdn.datatables.net/1.13.7/js/dataTables.bootstrap5.min.js"></script>

  <script>
    $(document).ready(function () {
      $.fn.dataTable.ext.errMode = 'none';
      $('#usersTable').DataTable({
        paging: true,
        searching: true,
        ordering: true,
        info: true,
        pageLength: 10,
        language: {
          search: "Cari:",
          lengthMenu: "Tampilkan _MENU_ entri per halaman",
          zeroRecords: "Tidak ditemukan data pengguna",
          info: "Menampilkan _START_ sampai _END_ dari _TOTAL_ pengguna",
          infoEmpty: "Tidak ada pengguna tersedia",
          infoFiltered: "(difilter dari total _MAX_ entri)"
        }
      });
    });
  </script>
    <script>
    const menuToggle = document.getElementById('menuToggle');
    const sidebar = document.getElementById('sidebar');
    const overlay = document.getElementById('sidebarOverlay');

    menuToggle.addEventListener('click', () => {
      sidebar.classList.toggle('show');
      overlay.classList.toggle('show');
    });

    overlay.addEventListener('click', () => {
      sidebar.classList.remove('show');
      overlay.classList.remove('show');
    });
  </script>
</body>

</html>

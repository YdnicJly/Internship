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
  <!-- 🔹 Navbar -->
  <nav class="navbar navbar-expand-lg navbar-light bg-white mb-4 rounded shadow-sm p-3">
    <div class="container-fluid flex-wrap justify-content-between gap-2">
      <span class="navbar-brand mb-0 h5">Data Lowongan</span>
      <div class="d-flex align-items-center gap-2">
        <span class="text-muted small d-none d-sm-inline">{{ Auth::user()->name ?? 'Admin' }}</span>
        <img
          src="https://ui-avatars.com/api/?name={{ urlencode(Auth::user()->name ?? 'A') }}&background=0d6efd&color=fff"
          class="rounded-circle" width="40" height="40" alt="Foto Admin">
      </div>
    </div>
  </nav>

  <!-- 🔹 Alert sukses -->
  @if (session('success'))
    <div class="alert alert-success alert-dismissible fade show" role="alert" id="success-alert">
      {{ session('success') }}
      <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    </div>

    <script>
      setTimeout(() => {
        const alert = document.getElementById('success-alert');
        if (alert) {
          alert.classList.remove('show');
          alert.classList.add('fade');
          setTimeout(() => alert.remove(), 500);
        }
      }, 3000);
    </script>
  @endif

  <!-- 🔹 Card utama -->
  <div class="card p-4">
    <div class="d-flex flex-wrap justify-content-between align-items-center mb-4 gap-2">
      <h5 class="mb-0"><i class="bi bi-briefcase text-primary me-2"></i>Daftar Lowongan</h5>
      <button class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#addPositionModal">
        <i class="bi bi-plus-circle me-1"></i> Tambah Lowongan
      </button>
    </div>

    <!-- 🔹 Table wrapper -->
    <div class="table-responsive">
      <table id="positionTable" class="table table-hover align-middle">
        <thead class="table-light">
          <tr>
            <th>Judul</th>
            <th>Departemen</th>
            <th>Kuota</th>
            <th>Batas Waktu</th>
            <th>Status</th>
            <th>Dibuat</th>
            <th class="text-end">Aksi</th>
          </tr>
        </thead>
        <tbody>
          @forelse($positions as $position)
            <tr>
              <td>{{ $position->title }}</td>
              <td>{{ $position->department }}</td>
              <td>{{ $position->quota }}</td>
              <td>{{ $position->deadline ?? '-' }}</td>
              <td>
                <span class="badge bg-{{ $position->status === 'open' ? 'success' : 'secondary' }}">
                  {{ $position->status === 'open' ? 'Dibuka' : 'Ditutup' }}
                </span>
              </td>
              <td>{{ $position->created_at->format('Y-m-d') }}</td>
              <td class="text-end">
                <div class="d-flex justify-content-end flex-wrap gap-1">
                  <button class="btn btn-sm btn-outline-warning" data-bs-toggle="modal"
                    data-bs-target="#editPositionModal{{ $position->id }}">
                    <i class="bi bi-pencil"></i>
                  </button>
                  <form action="{{ route('positions.destroy', $position->id) }}" method="POST" class="d-inline">
                    @csrf @method('DELETE')
                    <button class="btn btn-sm btn-outline-danger" onclick="return confirm('Hapus lowongan ini?')">
                      <i class="bi bi-trash"></i>
                    </button>
                  </form>
                </div>
              </td>
            </tr>

            <!-- 🔹 Modal Edit -->
            <div class="modal fade" id="editPositionModal{{ $position->id }}" tabindex="-1">
              <div class="modal-dialog modal-lg modal-dialog-centered">
                <div class="modal-content">
                  <div class="modal-header bg-primary text-white">
                    <h5 class="modal-title"><i class="bi bi-pencil-square me-2"></i>Edit Lowongan</h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                  </div>
                  <form action="{{ route('positions.update', $position->id) }}" method="POST">
                    @csrf @method('PUT')
                    <div class="modal-body">
                      <div class="row g-3">
                        <div class="col-md-6">
                          <label class="form-label">Judul</label>
                          <input type="text" name="title" class="form-control" value="{{ $position->title }}" required>
                        </div>
                        <div class="col-md-6">
                          <label class="form-label">Departemen</label>
                          <input type="text" name="department" class="form-control" value="{{ $position->department }}">
                        </div>
                        <div class="col-12">
                          <label class="form-label">Deskripsi</label>
                          <textarea name="description" class="form-control" rows="3">{{ $position->description }}</textarea>
                        </div>
                        <div class="col-12">
                          <label class="form-label">Persyaratan</label>
                          <textarea name="requirements" class="form-control" rows="3">{{ $position->requirements }}</textarea>
                        </div>
                        <div class="col-md-4">
                          <label class="form-label">Kuota</label>
                          <input type="number" name="quota" class="form-control" value="{{ $position->quota }}">
                        </div>
                        <div class="col-md-4">
                          <label class="form-label">Batas Waktu</label>
                          <input type="date" name="deadline" class="form-control" value="{{ $position->deadline }}">
                        </div>
                        <div class="col-md-4">
                          <label class="form-label">Status</label>
                          <select name="status" class="form-select">
                            <option value="open" {{ $position->status === 'open' ? 'selected' : '' }}>Dibuka</option>
                            <option value="closed" {{ $position->status === 'closed' ? 'selected' : '' }}>Ditutup</option>
                          </select>
                        </div>
                      </div>
                    </div>
                    <div class="modal-footer">
                      <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                      <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                    </div>
                  </form>
                </div>
              </div>
            </div>
          @empty
            <tr>
              <td colspan="7" class="text-center text-muted py-4">Belum ada lowongan yang tersedia.</td>
            </tr>
          @endforelse
        </tbody>
      </table>
    </div>

    <div class="mt-3">{{ $positions->links('pagination::bootstrap-5') }}</div>
  </div>
</div>

<!-- 🔹 CSS Responsif -->
<style>
  @media (max-width: 992px) {
    .navbar-brand {
      font-size: 1.1rem;
    }
    .form-select, .form-control {
      font-size: 0.9rem;
    }
  }

  @media (max-width: 768px) {
    .navbar .text-muted {
      display: none;
    }
    .table th, .table td {
      font-size: 0.85rem;
      white-space: nowrap;
    }
    .btn-sm {
      padding: 0.25rem 0.4rem;
      font-size: 0.8rem;
    }
  }

  @media (max-width: 576px) {
    .card h5 {
      font-size: 1rem;
    }
    .table th, .table td {
      font-size: 0.75rem;
      padding: 0.4rem;
    }
    .table-responsive {
      border-radius: 10px;
      overflow-x: auto;
      -webkit-overflow-scrolling: touch;
    }
    .modal-dialog {
      margin: 0.5rem;
      max-width: 100%;
    }
    .modal-body {
      font-size: 0.85rem;
    }
  }
</style>


  <!-- Modal Tambah Lowongan -->
  <div class="modal fade" id="addPositionModal" tabindex="-1">
    <div class="modal-dialog modal-lg modal-dialog-centered">
      <div class="modal-content">
        <div class="modal-header bg-success text-white">
          <h5 class="modal-title"><i class="bi bi-plus-circle me-2"></i>Tambah Lowongan Baru</h5>
          <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
        </div>
        <form action="{{ route('positions.store') }}" method="POST">
          @csrf
          <div class="modal-body">
            <div class="row g-3">
              <div class="col-md-6">
                <label class="form-label">Judul
                  <span class="text-danger">*</span>
                </label>
                <input type="text" name="title" class="form-control" required>
              </div>
              <div class="col-md-6">
                <label class="form-label">Departemen
                  <span class="text-danger">*</span>
                </label>
                <input type="text" name="department" class="form-control" required>
              </div>
              <div class="col-md-12">
                <label class="form-label">Deskripsi
                  <span class="text-danger">*</span>
                </label>
                <textarea name="description" class="form-control" rows="3"></textarea>
              </div>
              <div class="col-md-12">
                <label class="form-label">Persyaratan
                  <span class="text-danger">*</span>
                </label>
                <textarea name="requirements" class="form-control" rows="3"></textarea>
              </div>
              <div class="col-md-4">
                <label class="form-label">Kuota
                  <span class="text-danger">*</span>
                </label>
                <input type="number" name="quota" class="form-control" value="1">
              </div>
              <div class="col-md-4">
                <label class="form-label">Batas Waktu
                  <span class="text-danger">*</span>
                </label>
                <input type="date" name="deadline" class="form-control">
              </div>
              <div class="col-md-4">
                <label class="form-label">Status
                  <span class="text-danger">*</span>
                </label>
                <select name="status" class="form-select">
                  <option value="open" selected>Dibuka</option>
                  <option value="closed">Ditutup</option>
                </select>
              </div>
            </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
            <button type="submit" class="btn btn-success">Simpan</button>
          </div>
        </form>
      </div>
    </div>
  </div>

  <!-- Modal Logout -->
  <div class="modal fade" id="logoutModal" tabindex="-1" aria-labelledby="logoutModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content border-0 shadow">
        <div class="modal-header bg-danger text-white">
          <h5 class="modal-title" id="logoutModalLabel"><i class="bi bi-box-arrow-right me-2"></i>Konfirmasi Keluar</h5>
          <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          Apakah Anda yakin ingin keluar dari akun ini?
        </div>
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
  <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
  <script src="https://cdn.datatables.net/1.13.7/js/jquery.dataTables.min.js"></script>
  <script src="https://cdn.datatables.net/1.13.7/js/dataTables.bootstrap5.min.js"></script>
  <script>
    $(document).ready(function () {
      $.fn.dataTable.ext.errMode = 'none';
      $('#positionTable').DataTable({
        paging: true,
        searching: true,
        ordering: true,
        info: true,
        pageLength: 10,
        language: {
          search: "Cari:",
          lengthMenu: "Tampilkan _MENU_ entri per halaman",
          zeroRecords: "Tidak ada lowongan ditemukan",
          info: "Menampilkan _START_ sampai _END_ dari _TOTAL_ lowongan",
          infoEmpty: "Tidak ada data tersedia",
          infoFiltered: "(disaring dari total _MAX_ entri)"
        },
        columnDefs: [
          { orderable: false, targets: -1 }
        ]
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

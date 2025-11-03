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
      <span class="navbar-brand mb-0 h5">Lamaran Saya</span>
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
    <!-- Applications Table -->
<div class="card p-4 mb-5">
  <h5 class="mb-3"><i class="bi bi-list-check me-2 text-success"></i>Status Lamaran</h5>

  <!-- ✅ Tambahkan table-responsive agar tabel bisa di-scroll horizontal di mobile -->
  <div class="table-responsive">
    <table class="table align-middle">
      <thead class="table-light">
        <tr>
          <th>Tanggal Daftar</th>
          <th>Posisi</th>
          <th>Departemen</th>
          <th>Status</th>
          <th>Aksi</th>
        </tr>
      </thead>
      <tbody>
        @forelse ($applications as $app)
          <tr>
            <td>{{ $app->created_at->format('Y-m-d') }}</td>
            <td>{{ $app->position->title }}</td>
            <td>{{ $app->position->department }}</td>
            <td>
              @if ($app->status === 'accepted')
                <span class="badge bg-success">Diterima</span>
              @elseif ($app->status === 'rejected')
                <span class="badge bg-danger">Ditolak</span>
              @elseif ($app->status === 'active')
                <span class="badge bg-success">Aktif Magang</span>
              @elseif ($app->status === 'completed')
                <span class="badge bg-secondary">Selesai Magang</span>
              @elseif ($app->status === 'interview')
                <span class="badge bg-info">Wawancara</span>
              @elseif ($app->status === 'submitted')
                <span class="badge bg-primary">Terkirim</span>
              @else
                <span class="badge bg-warning text-dark">Sedang Ditinjau</span>
              @endif
            </td>
            <td>
              <button class="btn btn-sm btn-outline-primary" data-bs-toggle="modal"
                data-bs-target="#detailModal{{ $app->id }}">
                <i class="bi bi-eye"></i> Detail
              </button>
            </td>
          </tr>

          <!-- Detail Modal -->
          <div class="modal fade" id="detailModal{{ $app->id }}" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog modal-lg modal-dialog-centered">
              <div class="modal-content border-0 shadow">
                <div class="modal-header bg-primary text-white">
                  <h5 class="modal-title">
                    <i class="bi bi-file-text me-2"></i> Detail Lamaran
                  </h5>
                  <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                </div>

                <div class="modal-body">
                  <h6 class="fw-bold mb-3">{{ $app->position->title }} - {{ $app->position->department }}</h6>
                  <p><strong>Status:</strong>
                    @if ($app->status === 'accepted')
                      <span class="badge bg-success">Diterima</span>
                    @elseif ($app->status === 'rejected')
                      <span class="badge bg-danger">Ditolak</span>
                    @elseif ($app->status === 'active')
                      <span class="badge bg-success">Aktif Magang</span>
                    @elseif ($app->status === 'completed')
                      <span class="badge bg-secondary">Selesai Magang</span>
                    @elseif ($app->status === 'interview')
                      <span class="badge bg-info">Wawancara</span>
                    @elseif ($app->status === 'submitted')
                      <span class="badge bg-primary">Terkirim</span>
                    @else
                      <span class="badge bg-warning text-dark">Sedang Ditinjau</span>
                    @endif
                  </p>

                  <hr>
                  <h6 class="fw-bold">Informasi Lamaran</h6>
                  <ul class="list-unstyled small">
                    <li><strong>Email Aktif:</strong> {{ $app->active_email }}</li>
                    <li><strong>Nomor WhatsApp:</strong> {{ $app->whatsapp_number }}</li>
                    <li><strong>Durasi Magang:</strong> {{ $app->duration }}</li>
                    <li><strong>Motivasi:</strong> {{ $app->motivation }}</li>
                  </ul>

                  <hr>
                  <h6 class="fw-bold mb-2"><i class="bi bi-file-earmark-text me-2 text-success"></i>Dokumen yang
                    Diunggah
                  </h6>
                  @if ($app->documents->isEmpty())
                    <p class="text-muted">Tidak ada dokumen yang diunggah.</p>
                  @else
                    <ul class="list-group list-group-flush">
                      @foreach ($app->documents as $doc)
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                          <span class="text-capitalize">{{ $doc->type }}</span>
                          <a href="{{ asset($doc->path) }}" target="_blank"
                            class="btn btn-sm btn-outline-secondary">
                            <i class="bi bi-box-arrow-up-right"></i> Buka
                          </a>
                        </li>
                      @endforeach
                    </ul>
                  @endif
                </div>

                <div class="modal-footer">
                  <button class="btn btn-secondary" data-bs-dismiss="modal">
                    <i class="bi bi-x-circle me-1"></i> Tutup
                  </button>
                </div>
              </div>
            </div>
          </div>
        @empty
          <tr>
            <td colspan="5" class="text-center text-muted py-4">Belum ada lamaran.</td>
          </tr>
        @endforelse
      </tbody>
    </table>
  </div>
</div>

<style>
  /* Responsif tambahan */
  @media (max-width: 768px) {
    .card {
      padding: 1rem !important;
    }

    .table th,
    .table td {
      font-size: 0.85rem;
      white-space: nowrap;
    }

    /* Biar tabel tidak mepet di layar kecil */
    .table-responsive {
      margin-bottom: 1rem;
      border-radius: 8px;
      overflow-x: auto;
    }

    /* Modal biar pas di layar kecil */
    .modal-dialog {
      max-width: 95% !important;
      margin: 1rem auto;
    }

    .modal-body ul li {
      font-size: 0.9rem;
    }

    .btn-sm {
      font-size: 0.8rem;
      padding: 0.35rem 0.6rem;
    }
  }

  @media (max-width: 576px) {
    .table th,
    .table td {
      font-size: 0.8rem;
    }

    .modal-body h6 {
      font-size: 1rem;
    }
  }
</style>


<!-- Interview Schedule -->
<div class="card p-4">
  <h5 class="mb-3">
    <i class="bi bi-calendar-event me-2 text-primary"></i> Jadwal Interview
  </h5>

  <!-- ✅ Tambahkan pembungkus responsif -->
  <div class="table-responsive">
    <table class="table align-middle">
      <thead class="table-light">
        <tr>
          <th>Tanggal</th>
          <th>Posisi</th>
          <th>Status</th>
          <th>Catatan</th>
        </tr>
      </thead>
      <tbody>
        @forelse ($interviews as $interview)
          <tr>
            <td>
              {{ $interview->scheduled_at ? \Carbon\Carbon::parse($interview->scheduled_at)->format('Y-m-d H:i') : '-' }}
            </td>
            <td>{{ $interview->application->position->title }}</td>
            <td>
              <span class="badge bg-{{
                $interview->status == 'scheduled' ? 'warning text-dark' :
                ($interview->status == 'done' ? 'success' :
                ($interview->status == 'canceled' ? 'danger' : 'secondary'))
              }}">
                {{
                  $interview->status == 'scheduled' ? 'Dijadwalkan' :
                  ($interview->status == 'done' ? 'Selesai' :
                  ($interview->status == 'canceled' ? 'Gagal' : ucfirst($interview->status)))
                }}
              </span>
            </td>
            <td>{{ $interview->result ?? '-' }}</td>
          </tr>
        @empty
          <tr>
            <td colspan="4" class="text-center text-muted py-4">
              Tidak ada wawancara yang dijadwalkan dalam waktu dekat.
            </td>
          </tr>
        @endforelse
      </tbody>
    </table>
  </div>
</div>

  </div>

  <!-- Logout Confirmation Modal -->
  <div class="modal fade" id="logoutModal" tabindex="-1" aria-labelledby="logoutModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content border-0 shadow">
        <div class="modal-header bg-danger text-white">
          <h5 class="modal-title" id="logoutModalLabel"><i class="bi bi-box-arrow-right me-2"></i>Konfirmasi Logout</h5>
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
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>

document.addEventListener("DOMContentLoaded", function() {
    @if (session('success'))
        Swal.fire({
            icon: 'success',
            title: 'Berhasil!',
            text: "{{ session('success') }}",
            showConfirmButton: false,
            timer: 1800
        });
    @elseif (session('error'))
        Swal.fire({
            icon: 'error',
            title: 'Gagal!',
            text: "{{ session('error') }}",
            showConfirmButton: true
        });
    @endif
});
</script>
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
      <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
  <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
  <script src="https://cdn.datatables.net/1.13.7/js/jquery.dataTables.min.js"></script>
  <script src="https://cdn.datatables.net/1.13.7/js/dataTables.bootstrap5.min.js"></script>
  <script>
    $(document).ready(function () {
      $.fn.dataTable.ext.errMode = 'none';
      $('#applicantsTable').DataTable({
        paging: true,
        searching: true,
        ordering: true,
        info: true,
        pageLength: 10,
        order: [[0, 'desc']],
        language: {
          search: "Cari:",
          lengthMenu: "Tampilkan _MENU_ entri per halaman",
          zeroRecords: "Tidak ditemukan pendaftar",
          info: "Menampilkan _START_ sampai _END_ dari _TOTAL_ pendaftar",
          infoEmpty: "Tidak ada pendaftar tersedia",
          infoFiltered: "(disaring dari total _MAX_ entri)"
        },
        columnDefs: [
          { orderable: false, targets: -1 }
        ]
      });
    });
  </script>
</body>

</html>
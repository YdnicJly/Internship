<!DOCTYPE html>
<html lang="id">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="icon" type="image/png" href="{{ asset('images/logo_crop.png') }}">
  <title>Dashboard Admin - SIMMAGANG Diskominfo</title>

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
  </style>
</head>

<body>
  <!-- Sidebar -->
  <div class="sidebar p-3">
    <div>
      <h5 class="fw-bold mb-4 d-flex align-items-center">
        <i class="bi bi-building me-2"></i>SIMMAGANG
      </h5>
      <ul class="nav flex-column gap-1">
        <li><a href="{{ route('admin.dashboard') }}" class="nav-link active"><i class="bi bi-speedometer2 me-2"></i>
            Beranda</a></li>
        <li><a href="{{ route('admin.positions') }}" class="nav-link"><i class="bi bi-briefcase me-2"></i> Lowongan
            Magang
          </a></li>
        <li><a href="{{ route('admin.applicants') }}" class="nav-link"><i class="bi bi-people me-2"></i> Data Pendaftar
          </a></li>
        <li><a href="{{ route('admin.interviews') }}" class="nav-link "><i class="bi bi-calendar-event me-2"></i>
            Jadwal Wawancara
          </a></li>
        <li><a href="{{ route('admin.intern') }}" class="nav-link "><i class="bi bi-journal-check me-2"></i>
            Data Pemagang
          </a></li>
        <li><a href="{{ route('admin.user') }}" class="nav-link "><i
              class="bi bi-person-gear me-2"></i>Manajemen Pengguna</a></li>
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
    <!-- Top Navbar -->
    <nav class="navbar navbar-expand-lg navbar-light bg-white mb-4 rounded shadow-sm">
      <div class="container-fluid">
        <span class="navbar-brand mb-0 h5">Beranda Admin</span>
        <div class="d-flex align-items-center">
          <span class="me-3 text-muted small">Selamat datang, {{ Auth::user()->name ?? 'Admin' }}</span>
          <img
            src="https://ui-avatars.com/api/?name={{ urlencode(Auth::user()->name ?? 'A') }}&background=0d6efd&color=fff"
            class="rounded-circle" width="40" height="40" alt="Foto Admin">
        </div>
      </div>
    </nav>

    <!-- Statistik Dashboard -->
    <div class="row g-4">
      <div class="col-md-3">
        <div class="card p-3">
          <div class="d-flex align-items-center">
            <div class="rounded-circle bg-primary bg-opacity-10 text-primary p-3 me-3">
              <i class="bi bi-briefcase fs-4"></i>
            </div>
            <div>
              <h6 class="mb-0">Posisi Magang</h6>
              <h4 class="fw-bold mb-0">{{ $positionsCount }}</h4>
            </div>
          </div>
        </div>
      </div>

      <div class="col-md-3">
        <div class="card p-3">
          <div class="d-flex align-items-center">
            <div class="rounded-circle bg-success bg-opacity-10 text-success p-3 me-3">
              <i class="bi bi-people fs-4"></i>
            </div>
            <div>
              <h6 class="mb-0">Total Pendaftar</h6>
              <h4 class="fw-bold mb-0">{{ $applicantsCount }}</h4>
            </div>
          </div>
        </div>
      </div>

      <div class="col-md-3">
        <div class="card p-3">
          <div class="d-flex align-items-center">
            <div class="rounded-circle bg-warning bg-opacity-10 text-warning p-3 me-3">
              <i class="bi bi-calendar-event fs-4"></i>
            </div>
            <div>
              <h6 class="mb-0">Jadwal Wawancara</h6>
              <h4 class="fw-bold mb-0">{{ $interviewsCount }}</h4>
            </div>
          </div>
        </div>
      </div>

      <div class="col-md-3">
        <div class="card p-3">
          <div class="d-flex align-items-center">
            <div class="rounded-circle bg-danger bg-opacity-10 text-danger p-3 me-3">
              <i class="bi bi-award fs-4"></i>
            </div>
            <div>
              <h6 class="mb-0">Peserta Aktif</h6>
              <h4 class="fw-bold mb-0">{{ $internsCount }}</h4>
            </div>
          </div>
        </div>
      </div>
    </div>

    <!-- Pendaftar Terbaru -->
    <div class="card mt-5 p-4">
      <div class="d-flex justify-content-between align-items-center mb-3">
        <h5 class="mb-0"><i class="bi bi-people me-2 text-primary"></i>Pendaftar Terbaru</h5>
        <a href="{{ route('admin.applicants') }}" class="btn btn-sm btn-outline-primary">Lihat Semua</a>
      </div>
      <table class="table align-middle">
        <thead class="table-light">
          <tr>
            <th>Nama</th>
            <th>Asal Sekolah / Universitas</th>
            <th>Posisi Magang</th>
            <th>Status</th>
            <th>Tanggal Daftar</th>
          </tr>
        </thead>
        <tbody>
          @forelse($recentApplicants as $application)
            <tr>
              <td>{{ $application->user->name }}</td>
              <td>{{ $application->user->school_name ?? '-' }}</td>
              <td>{{ $application->position->title ?? '-' }}</td>
              <td>
                @if($application->status == 'submitted')
                  <span class="badge bg-secondary">Dikirim</span>
                @elseif($application->status == 'under_review')
                  <span class="badge bg-warning text-dark">Sedang Ditinjau</span>
                @elseif($application->status == 'active')
                  <span class="badge bg-success">Aktif</span>
                @else
                  <span class="badge bg-light text-muted">Tidak Diketahui</span>
                @endif
              </td>
              <td>{{ $application->created_at->format('d M Y') }}</td>
            </tr>
          @empty
            <tr>
              <td colspan="5" class="text-center text-muted">Belum ada pendaftar baru.</td>
            </tr>
          @endforelse
        </tbody>
      </table>
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
</body>

</html>
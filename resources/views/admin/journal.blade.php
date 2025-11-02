<!DOCTYPE html>
<html lang="id">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>SIMMAGANG</title>
  <link rel="icon" type="image/png" href="{{ asset('images/logo.jpg') }}">

  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css">
  <link rel="stylesheet" href="https://cdn.datatables.net/1.13.7/css/dataTables.bootstrap5.min.css">

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

    table.dataTable td,
    table.dataTable th {
      vertical-align: middle;
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
        <li><a href="{{ route('admin.dashboard') }}" class="nav-link"><i class="bi bi-speedometer2 me-2"></i>
            Beranda</a></li>
        <li><a href="{{ route('admin.positions') }}" class="nav-link"><i class="bi bi-briefcase me-2"></i> Lowongan
            Magang</a></li>
        <li><a href="{{ route('admin.applicants') }}" class="nav-link"><i class="bi bi-people me-2"></i> Data
            Pendaftar</a></li>
        <li><a href="{{ route('admin.interviews') }}" class="nav-link"><i class="bi bi-calendar-event me-2"></i> Jadwal
            Wawancara</a></li>
        <li><a href="{{ route('admin.intern') }}" class="nav-link active"><i class="bi bi-journal-check me-2"></i> Data
            Pemagang</a></li>
        <li><a href="{{ route('admin.user') }}" class="nav-link"><i class="bi bi-person-gear me-2"></i> Manajemen
            Pengguna</a></li>
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
    <nav class="navbar navbar-expand-lg navbar-light bg-white mb-4 rounded shadow-sm">
      <div class="container-fluid">
        <span class="navbar-brand mb-0 h5">Manajemen Data Pemagang</span>
        <div class="d-flex align-items-center">
          <span class="me-3 text-muted small">Halo, {{ Auth::user()->name ?? 'Admin' }}</span>
          <img
            src="https://ui-avatars.com/api/?name={{ urlencode(Auth::user()->name ?? 'A') }}&background=0d6efd&color=fff"
            class="rounded-circle" width="40" height="40" alt="Admin Avatar">
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
  <div class="container py-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
      <div>
        <h4 class="mb-0"><i class="bi bi-journal-text text-primary me-2"></i>Jurnal Pemagang</h4>
        <small class="text-muted">Nama: <strong>{{ $intern->name }}</strong> | Sekolah: {{ $intern->school_name ?? '-' }}</small>
      </div>
      <a href="{{ route('admin.intern') }}" class="btn btn-outline-secondary">
        <i class="bi bi-arrow-left me-1"></i> Kembali
      </a>
    </div>

    <div class="card p-4">
      <table id="journalsTable" class="table table-hover align-middle">
        <thead class="table-light">
          <tr>
            <th>Tanggal</th>
            <th>Kegiatan</th>
            <th>Deskripsi</th>
          </tr>
        </thead>
        <tbody>
          @forelse($journals as $journal)
            <tr>
              <td>{{ \Carbon\Carbon::parse($journal->date)->translatedFormat('d F Y') }}</td>
              <td>{{ $journal->activity }}</td>
              <td>{{ $journal->description ?? '-' }}</td>
            </tr>
          @empty
            <tr>
              <td colspan="3" class="text-center text-muted py-4">Belum ada jurnal yang diinput oleh pemagang ini.</td>
            </tr>
          @endforelse
        </tbody>
      </table>
    </div>
  </div>
  </div>

  <!-- Logout Modal -->
  <div class="modal fade" id="logoutModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content border-0 shadow">
        <div class="modal-header bg-danger text-white">
          <h5 class="modal-title"><i class="bi bi-box-arrow-right me-2"></i>Konfirmasi Logout</h5>
          <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
        </div>
        <div class="modal-body">Apakah Anda yakin ingin keluar?</div>
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

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
  <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
  <script src="https://cdn.datatables.net/1.13.7/js/jquery.dataTables.min.js"></script>
  <script src="https://cdn.datatables.net/1.13.7/js/dataTables.bootstrap5.min.js"></script>
  <script>
    $(document).ready(function () {
      $('#internsTable, #completedInternsTable').DataTable({
        paging: true,
        searching: true,
        ordering: true,
        info: true,
        pageLength: 10,
        language: {
          search: "Cari:",
          lengthMenu: "Tampilkan _MENU_ entri per halaman",
          zeroRecords: "Tidak ditemukan data",
          info: "Menampilkan _START_ sampai _END_ dari _TOTAL_ entri",
          infoEmpty: "Tidak ada data tersedia",
          infoFiltered: "(difilter dari total _MAX_ entri)"
        },
        columnDefs: [{ orderable: false, targets: -1 }]
      });
    });
  </script>
</body>

</html>
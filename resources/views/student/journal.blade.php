<!DOCTYPE html>
<html lang="id">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="icon" type="image/png" href="{{ asset('images/logo_crop.png') }}">
  <title>Jurnal Saya - SIMMAGANG Diskominfo</title>

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
        <i class="bi bi-person-workspace me-2"></i> SIMMAGANG
      </h5>
      <ul class="nav flex-column gap-1">
        <li><a href="{{ route('student.dashboard') }}" class="nav-link "><i class="bi bi-briefcase me-2"></i>
            Beranda</a></li>
        <li><a href="{{ route('student.applications') }}" class="nav-link "><i class="bi bi-clipboard-check me-2"></i>
            Lamaran Saya</a></li>
        <li><a href="{{ route('student.journal') }}" class="nav-link active"><i class="bi bi-journal-text me-2"></i>
            Jurnal Magang</a></li>
        <li><a href="{{ route('student.evaluation') }}" class="nav-link"><i class="bi bi-award me-2"></i>
            Evaluasi</a></li>
        <li><a href="{{ route('profile') }}" class="nav-link"><i class="bi bi-person-lines-fill me-2"></i>
            Profil</a></li>
      </ul>
    </div>

    <div>
      <hr class="text-white-50">
      <button type="button" class="btn btn-outline-light w-100" data-bs-toggle="modal" data-bs-target="#logoutModal">
        <i class="bi bi-box-arrow-right me-1"></i> Keluar
      </button>
    </div>
  </div>

  <!-- Konten Utama -->
  <div class="content">
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-light bg-white mb-4 rounded shadow-sm">
      <div class="container-fluid">
        <span class="navbar-brand mb-0 h5">Jurnal Saya</span>
        <div class="d-flex align-items-center">
          <span class="me-3 text-muted small">{{ Auth::user()->name ?? 'Mahasiswa Magang' }}</span>
          <img
            src="https://ui-avatars.com/api/?name={{ urlencode(Auth::user()->name ?? 'S') }}&background=0d6efd&color=fff"
            class="rounded-circle" width="40" height="40" alt="Avatar Mahasiswa">
        </div>
      </div>
    </nav>

    <!-- Form Tambah Jurnal -->
    <div class="card p-4 mb-4">
      <h5 class="mb-3"><i class="bi bi-pencil-square me-2 text-primary"></i> Tambah Entri Jurnal Baru</h5>
      <form action="{{ route('student.journal.store') }}" method="POST">
        @csrf
        <div class="row g-3">
          <div class="col-md-3">
            <label class="form-label fw-semibold">Tanggal</label>
            <input type="date" name="date" class="form-control" value="{{ date('Y-m-d') }}" required>
          </div>
          <div class="col-md-9">
            <label class="form-label fw-semibold">Kegiatan</label>
            <input type="text" name="activity" class="form-control" placeholder="Contoh: Membuat tampilan dashboard UI"
              required>
          </div>
          <div class="col-12">
            <label class="form-label fw-semibold">Deskripsi</label>
            <textarea name="description" rows="3" class="form-control"
              placeholder="Jelaskan apa yang Anda kerjakan hari ini..." required></textarea>
          </div>
          <div class="col-12 text-end">
            <button type="submit" class="btn btn-primary"><i class="bi bi-plus-circle me-1"></i> Tambah Jurnal</button>
          </div>
        </div>
      </form>
    </div>

    <!-- Tabel Jurnal -->
    <div class="card p-4">
      <h5 class="mb-3"><i class="bi bi-journal-text me-2 text-success"></i>Daftar Jurnal Saya</h5>
      <table class="table align-middle">
        <thead class="table-light">
          <tr>
            <th width="10%">Tanggal</th>
            <th width="20%">Kegiatan</th>
            <th>Deskripsi</th>
            <th width="10%" class="text-center">Aksi</th>
          </tr>
        </thead>
        <tbody>
          @forelse ($journals as $journal)
            <tr>
              <td>{{ \Carbon\Carbon::parse($journal->date)->format('d M Y') }}</td>
              <td>{{ $journal->activity }}</td>
              <td>{{ $journal->description }}</td>
              <td class="text-center">
                <form action="{{ route('student.journal.destroy', $journal->id) }}" method="POST"
                  onsubmit="return confirm('Hapus entri ini?')">
                  @csrf
                  @method('DELETE')
                  <button class="btn btn-sm btn-outline-danger"><i class="bi bi-trash"></i></button>
                </form>
              </td>
            </tr>
          @empty
            <tr>
              <td colspan="4" class="text-center text-muted py-4">
                <i class="bi bi-emoji-neutral display-6 d-block mb-2"></i>
                Belum ada entri jurnal.
              </td>
            </tr>
          @endforelse
        </tbody>
      </table>
    </div>
  </div>

  <!-- Modal Konfirmasi Logout -->
  <div class="modal fade" id="logoutModal" tabindex="-1" aria-labelledby="logoutModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content border-0 shadow">
        <div class="modal-header bg-danger text-white">
          <h5 class="modal-title" id="logoutModalLabel"><i class="bi bi-box-arrow-right me-2"></i>Konfirmasi Keluar</h5>
          <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Tutup"></button>
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

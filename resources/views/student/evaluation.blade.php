<!DOCTYPE html>
<html lang="id">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="icon" type="image/png" href="{{ asset('images/logo_crop.png') }}">
  <title>Evaluasi & Laporan Akhir - SIMMAGANG Diskominfo</title>

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
        <li><a href="{{ route('student.dashboard') }}" class="nav-link"><i class="bi bi-briefcase me-2"></i> Beranda</a></li>
        <li><a href="{{ route('student.applications') }}" class="nav-link"><i class="bi bi-clipboard-check me-2"></i> Lamaran Saya</a></li>
        <li><a href="{{ route('student.journal') }}" class="nav-link"><i class="bi bi-journal-text me-2"></i> Jurnal Magang</a></li>
        <li><a href="{{ route('student.evaluation') }}" class="nav-link active"><i class="bi bi-award me-2"></i> Evaluasi</a></li>
        <li><a href="{{ route('profile') }}" class="nav-link"><i class="bi bi-person-lines-fill me-2"></i> Profil</a></li>
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
        <span class="navbar-brand mb-0 h5">Evaluasi & Laporan Akhir</span>
        <div class="d-flex align-items-center">
          <span class="me-3 text-muted small">{{ Auth::user()->name ?? 'Mahasiswa Magang' }}</span>
          <img
            src="https://ui-avatars.com/api/?name={{ urlencode(Auth::user()->name ?? 'S') }}&background=0d6efd&color=fff"
            class="rounded-circle" width="40" height="40" alt="Avatar Mahasiswa">
        </div>
      </div>
    </nav>

    <!-- Upload Laporan Akhir -->
    <div class="card p-4 mb-4">
      <h5 class="mb-3"><i class="bi bi-upload me-2 text-primary"></i> Unggah Laporan Akhir</h5>
      @if ($finalReport)
        <div class="alert alert-success d-flex justify-content-between align-items-center">
          <div>
            <i class="bi bi-file-earmark-check-fill me-2"></i>
            <strong>Sudah diunggah:</strong> {{ basename($finalReport->file_path) }} <br>
            <small class="text-muted">Dikirim pada {{ $finalReport->created_at->format('d M Y, H:i') }}</small>
          </div>
          <a href="{{ asset('storage/' . $finalReport->file_path) }}" target="_blank"
            class="btn btn-outline-success btn-sm">
            <i class="bi bi-eye"></i> Lihat
          </a>
        </div>
      @else
        <form action="{{ route('finalreport.store') }}" method="POST" enctype="multipart/form-data">
          @csrf
          <div class="row g-3 align-items-center">
            <div class="col-md-8">
              <input type="file" name="file" accept=".pdf,.doc,.docx" class="form-control" required>
              <small class="text-muted">Format yang diterima: PDF, DOC, DOCX (maks. 5MB)</small>
            </div>
            <div class="col-md-4 text-end">
              <button type="submit" class="btn btn-primary"><i class="bi bi-cloud-arrow-up me-1"></i> Unggah Laporan</button>
            </div>
          </div>
        </form>
      @endif
    </div>

    <!-- Hasil Evaluasi -->
    <div class="card p-4 mb-4">
      <h5 class="mb-3"><i class="bi bi-clipboard-data me-2 text-success"></i> Hasil Evaluasi</h5>
      @if ($evaluation)
        <div class="table-responsive">
          <table class="table table-bordered align-middle">
            <thead class="table-light">
              <tr>
                <th>Kriteria</th>
                <th>Nilai</th>
              </tr>
            </thead>
            <tbody>
              <tr><td>Kedisiplinan</td><td>{{ $evaluation->discipline ?? '-' }}</td></tr>
              <tr><td>Kerja Sama Tim</td><td>{{ $evaluation->teamwork ?? '-' }}</td></tr>
              <tr><td>Komunikasi</td><td>{{ $evaluation->communication ?? '-' }}</td></tr>
              <tr><td>Kompetensi Keahlian</td><td>{{ $evaluation->skill ?? '-' }}</td></tr>
              <tr><td>Tanggung Jawab</td><td>{{ $evaluation->responsibility ?? '-' }}</td></tr>
            </tbody>
          </table>
          <p><strong>Catatan:</strong> {{ $evaluation->notes ?? '-' }}</p>
        </div>
      @else
        <div class="text-center text-muted py-3">
          <i class="bi bi-hourglass-split display-6 d-block mb-2"></i>
          Hasil evaluasi belum tersedia.
        </div>
      @endif
    </div>

    <!-- Sertifikat Magang -->
    <div class="card p-4">
      <h5 class="mb-3"><i class="bi bi-award-fill me-2 text-warning"></i> Sertifikat Magang</h5>
      @if ($certificate)
        <div class="d-flex justify-content-between align-items-center alert alert-light border">
          <div>
            <i class="bi bi-file-earmark-pdf-fill text-danger me-2"></i>
            <strong>{{ basename($certificate->file_path) }}</strong><br>
            <small class="text-muted">Diterbitkan pada {{ $certificate->created_at->format('d M Y') }}</small>
          </div>
          <a href="{{ asset('storage/' . $certificate->file_path) }}" target="_blank"
            class="btn btn-outline-primary btn-sm">
            <i class="bi bi-download"></i> Unduh
          </a>
        </div>
      @else
        <div class="text-center text-muted py-3">
          <i class="bi bi-hourglass-split display-6 d-block mb-2"></i>
          Sertifikat belum tersedia.
        </div>
      @endif
    </div>
  </div>

  <!-- Modal Logout -->
  <div class="modal fade" id="logoutModal" tabindex="-1" aria-labelledby="logoutModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content border-0 shadow">
        <div class="modal-header bg-danger text-white">
          <h5 class="modal-title" id="logoutModalLabel"><i class="bi bi-box-arrow-right me-2"></i>Konfirmasi Keluar</h5>
          <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Tutup"></button>
        </div>
        <div class="modal-body">Apakah Anda yakin ingin keluar dari akun ini?</div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal"><i class="bi bi-x-circle me-1"></i> Batal</button>
          <form action="{{ route('logout') }}" method="POST" class="d-inline">
            @csrf
            <button type="submit" class="btn btn-danger"><i class="bi bi-box-arrow-right me-1"></i> Keluar</button>
          </form>
        </div>
      </div>
    </div>
  </div>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>

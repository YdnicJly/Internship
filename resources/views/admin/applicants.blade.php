<!DOCTYPE html>
<html lang="id">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="icon" type="image/png" href="{{ asset('images/logo.jpg') }}">
  <title>SIMMAGANG</title>

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

    .badge-status {
      text-transform: capitalize;
    }

    /* Rapi tombol aksi */
    .action-buttons {
      display: flex;
      gap: 0.4rem;
      justify-content: flex-end;
    }

    .action-buttons .btn {
      min-width: 32px;
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
        <li><a href="{{ route('admin.applicants') }}" class="nav-link active"><i class="bi bi-people me-2"></i> Data
            Pendaftar</a></li>
        <li><a href="{{ route('admin.interviews') }}" class="nav-link"><i class="bi bi-calendar-event me-2"></i>
            Jadwal Wawancara</a></li>
        <li><a href="{{ route('admin.intern') }}" class="nav-link"><i class="bi bi-journal-check me-2"></i>
            Data Pemagang</a></li>
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
    <!-- Top Navbar -->
    <nav class="navbar navbar-expand-lg navbar-light bg-white mb-4 rounded shadow-sm">
      <div class="container-fluid">
        <span class="navbar-brand mb-0 h5">Manajemen Pendaftar</span>
        <div class="d-flex align-items-center">
          <span class="me-3 text-muted small">Selamat datang, {{ Auth::user()->name ?? 'Admin' }}</span>
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
    <!-- Filter + Table -->
    <div class="card p-4">
      <div class="d-flex justify-content-between align-items-center mb-4">
        <h5 class="mb-0"><i class="bi bi-list-task text-primary me-2"></i>Daftar Semua Pendaftar</h5>
        <form method="GET" class="d-flex gap-2">
          <select name="status" class="form-select" onchange="this.form.submit()">
            <option value="">Semua Status</option>
            <option value="submitted" {{ request('status') == 'submitted' ? 'selected' : '' }}>Dikirim</option>
            <option value="under_review" {{ request('status') == 'under_review' ? 'selected' : '' }}>Sedang Ditinjau
            </option>
            <option value="interview" {{ request('status') == 'interview' ? 'selected' : '' }}>
              Wawancara
              Terjadwal</option>
            <option value="accepted" {{ request('status') == 'accepted' ? 'selected' : '' }}>Diterima</option>
            <option value="rejected" {{ request('status') == 'rejected' ? 'selected' : '' }}>Ditolak</option>
          </select>
        </form>
      </div>

      <table id="applicantsTable" class="table table-hover align-middle">
        <thead class="table-light">
          <tr>
            <th>Nama</th>
            <th>Sekolah / Universitas</th>
            <th>Posisi</th>
            <th>Durasi</th>
            <th>WhatsApp</th>
            <th>Status</th>
            <th>Nilai</th>
            <th>Tanggal Daftar</th>
            <th class="text-end">Aksi</th>
          </tr>
        </thead>
        <tbody>
          @forelse($applications as $app)
            <tr>
              <td>{{ $app->user->name }}</td>
              <td>{{ $app->user->school_name ?? '-' }}</td>
              <td>{{ $app->position->title ?? '-' }}</td>
              <td>{{ $app->duration ?? '-' }}</td>
              <td>{{ $app->whatsapp_number ?? '-' }}</td>
              <td>
                @php
                  $statusMap = [
                    'submitted' => ['label' => 'Dikirim', 'class' => 'primary'],
                    'under_review' => ['label' => 'Sedang Ditinjau', 'class' => 'warning text-dark'],
                    'interview' => ['label' => 'Wawancara Terjadwal', 'class' => 'info'],
                    'accepted' => ['label' => 'Diterima', 'class' => 'success'],
                    'rejected' => ['label' => 'Ditolak', 'class' => 'danger'],
                    'completed' => ['label' => 'Selesai', 'class' => 'secondary'],
                  ];

                  $status = $statusMap[$app->status] ?? ['label' => ucfirst($app->status), 'class' => 'secondary'];
                @endphp

                <span class="badge bg-{{ $status['class'] }}">
                  {{ $status['label'] }}
                </span>
              </td>

              <td>{{ $app->selection->score ?? '-' }}</td>
              <td>{{ $app->created_at->format('Y-m-d') }}</td>
              <td class="text-end">
                <div class="action-buttons">
                  <button class="btn btn-sm btn-outline-primary" data-bs-toggle="modal"
                    data-bs-target="#detailModal{{ $app->id }}">
                    <i class="bi bi-eye"></i>
                  </button>
                  <button class="btn btn-sm btn-outline-warning" title="Edit" data-bs-toggle="modal"
                    data-bs-target="#editAppModal{{ $app->id }}">
                    <i class="bi bi-pencil"></i>
                  </button>
                  <form action="{{ route('admin.applicants.destroy', $app->id) }}" method="POST" class="d-inline">
                    @csrf
                    @method('DELETE')
                    <button class="btn btn-sm btn-outline-danger" title="Hapus"
                      onclick="return confirm('Yakin ingin menghapus pendaftar ini?')">
                      <i class="bi bi-trash"></i>
                    </button>
                  </form>

                </div>
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
                      @else
                        <span class="badge bg-warning text-dark">Sedang Ditinjau</span>
                      @endif
                    </p>

                    <hr>
                    <h6 class="fw-bold">Informasi Lamaran</h6>
                    <ul class="list-unstyled">
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
                      <p class="text-muted">TIdak Ada Dokumen yang Diunggah.</p>
                    @else
                      <ul class="list-group list-group-flush">
                        @foreach ($app->documents as $doc)
                          <li class="list-group-item d-flex justify-content-between align-items-center">
                            <span class="text-capitalize">{{ $doc->type }}</span>
                            <a href="{{ asset($doc->path) }}" target="_blank" class="btn btn-sm btn-outline-secondary">
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
            <!-- Modal Edit -->
            <div class="modal fade" id="editAppModal{{ $app->id }}" tabindex="-1" aria-hidden="true">
              <div class="modal-dialog modal-lg modal-dialog-centered">
                <div class="modal-content border-0 shadow">
                  <div class="modal-header bg-warning text-dark">
                    <h5 class="modal-title">
                      <i class="bi bi-pencil-square me-2"></i> Edit Lamaran
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                  </div>

                  <form action="{{ route('admin.applicants.update', $app->id) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="modal-body">
                      <div class="row g-3">
                        <!-- === Informasi Dasar === -->
                        <div class="col-md-6">
                          <label class="form-label fw-semibold">Email Aktif</label>
                          <input type="email" name="active_email" class="form-control" value="{{ $app->active_email }}"
                            readonly>
                        </div>

                        <div class="col-md-6">
                          <label class="form-label fw-semibold">Nomor WhatsApp</label>
                          <input type="text" name="whatsapp_number" class="form-control"
                            value="{{ $app->whatsapp_number }}" readonly>
                        </div>

                        <div class="col-md-6">
                          <label class="form-label fw-semibold">Durasi Magang</label>
                          <input type="text" name="duration" class="form-control" value="{{ $app->duration }}" readonly>
                        </div>

                        <div class="col-md-6">
                          <label class="form-label fw-semibold">Status</label>
                          <select name="status" class="form-select status-select" data-app-id="{{ $app->id }}">
                            
                            <option value="under_review" {{ $app->status == 'under_review' ? 'selected' : '' }}>Sedang
                              Ditinjau</option>
                            <option value="interview" {{ $app->status == 'interview' ? 'selected' : '' }}>Wawancara
                              Terjadwal</option>
                            <option value="accepted" {{ $app->status == 'accepted' ? 'selected' : '' }}>Diterima</option>
                            <option value="rejected" {{ $app->status == 'rejected' ? 'selected' : '' }}>Ditolak</option>
                            <option value="active" {{ $app->status == 'active' ? 'selected' : '' }}>Aktif</option>
                          </select>
                        </div>

                        <div class="col-12">
                          <label class="form-label fw-semibold">Motivasi</label>
                          <textarea name="motivation" class="form-control" rows="3"
                            readonly>{{ $app->motivation }}</textarea>
                        </div>

                        <!-- === Penilaian Seleksi === -->
                        <div class="col-12 mt-3 border-top pt-3">
                          <h6 class="fw-bold"><i class="bi bi-clipboard-check text-success me-2"></i> Penilaian Seleksi Berkas
                          </h6>
                          <div class="row g-3">
                            <div class="col-md-4">
                              <label class="form-label">Nilai
                                <span class="text-danger">*</span>
                              </label>
                              <input type="number" name="score" class="form-control"
                                value="{{ $app->selection->score ?? '' }}" min="0" max="100">
                            </div>
                            <div class="col-md-4">
                              <label class="form-label">Hasil
                                <span class="text-danger">*</span>
                              </label>
                              <select name="result" class="form-select">
                                <option value="pending" {{ optional($app->selection)->result == 'pending' ? 'selected' : '' }}>Menunggu</option>
                                <option value="passed" {{ optional($app->selection)->result == 'passed' ? 'selected' : '' }}>Lulus</option>
                                <option value="failed" {{ optional($app->selection)->result == 'failed' ? 'selected' : '' }}>Tidak Lulus</option>
                              </select>
                            </div>
                            <div class="col-md-12">
                              <label class="form-label">Catatan</label>
                              <textarea name="remarks" class="form-control"
                                rows="2">{{ $app->selection->remarks ?? '' }}</textarea>
                            </div>
                          </div>
                        </div>

                        <!-- === Jadwal Wawancara === -->
                        <div class="col-12 mt-3 border-top pt-3 interview-section" id="interviewSection{{ $app->id }}"
                          style="display: {{ $app->status == 'interview' ? 'block' : 'none' }};">
                          <h6 class="fw-bold"><i class="bi bi-calendar-event text-info me-2"></i> Jadwal Wawancara</h6>
                          <div class="row g-3">
                            <div class="col-md-6">
                              <label class="form-label">Tanggal & Waktu
                                <span class="text-danger">*</span>
                              </label>
                              <input type="datetime-local" name="scheduled_at" class="form-control"
                                value="{{ optional($app->interview)->scheduled_at ? \Carbon\Carbon::parse($app->interview->scheduled_at)->format('Y-m-d\TH:i') : '' }}">
                            </div>
                            <div class="col-md-6">
                              <label class="form-label">Status Wawancara
                                <span class="text-danger">*</span>
                              </label>
                              <select name="interview_status" class="form-select">
                                <option value="scheduled" {{ optional($app->interview)->status == 'scheduled' ? 'selected' : '' }}>Dijadwalkan</option>
                                <option value="done" {{ optional($app->interview)->status == 'done' ? 'selected' : '' }}>
                                  Selesai</option>
                                <option value="canceled" {{ optional($app->interview)->status == 'canceled' ? 'selected' : '' }}>Dibatalkan</option>
                              </select>
                            </div>
                            <div class="col-md-12">
                              <label class="form-label">Catatan</label>
                              <textarea name="interview_result" class="form-control"
                                rows="2">{{ $app->interview->result ?? '' }}</textarea>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>

                    <div class="modal-footer">
                      <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                        <i class="bi bi-x-circle me-1"></i> Batal
                      </button>
                      <button type="submit" class="btn btn-warning">
                        <i class="bi bi-save me-1"></i> Simpan Perubahan
                      </button>
                    </div>
                  </form>
                </div>
              </div>
            </div>

          @empty
            <tr>
              <td colspan="9" class="text-center text-muted py-4">Tidak ada data pendaftar.</td>
            </tr>
          @endforelse
        </tbody>
      </table>
    </div>
  </div>

  <!-- Logout Modal -->
  <div class="modal fade" id="logoutModal" tabindex="-1" aria-labelledby="logoutModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content border-0 shadow">
        <div class="modal-header bg-danger text-white">
          <h5 class="modal-title"><i class="bi bi-box-arrow-right me-2"></i>Konfirmasi Keluar</h5>
          <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
        </div>
        <div class="modal-body">
          Apakah Anda yakin ingin keluar dari sistem?
        </div>
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
      $('#applicantsTable').DataTable({
        paging: true,
        searching: true,
        ordering: true,
        info: true,
        pageLength: 10,
        order: [[7, 'desc']],
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
  <script>
    document.addEventListener('DOMContentLoaded', () => {
      // Ambil semua elemen select status berdasarkan class
      document.querySelectorAll('.status-select').forEach(select => {
        const appId = select.getAttribute('data-app-id');
        const interviewSection = document.getElementById('interviewSection' + appId);
    
        function toggleInterviewSection() {
          if (!interviewSection) return;
          interviewSection.style.display = select.value === 'interview' ? 'block' : 'none';
        }
    
        // Jalankan pertama kali ketika modal dibuka
        toggleInterviewSection();
    
        // Jalankan setiap kali status diganti
        select.addEventListener('change', toggleInterviewSection);
      });
    });
  </script>
<script>
  document.addEventListener('DOMContentLoaded', function() {
    // Tangkap semua select status
    document.querySelectorAll('.status-select').forEach(function(select) {
      const appId = select.getAttribute('data-app-id');

      // Fungsi untuk toggle readonly Penilaian Seleksi
      const toggleSelectionReadonly = () => {
        const status = select.value;
        const modal = document.querySelector(`#editAppModal${appId}`);
        const scoreInput = modal.querySelector('input[name="score"]');
        const resultSelect = modal.querySelector('select[name="result"]');
        const remarksTextarea = modal.querySelector('textarea[name="remarks"]');

        const isReadonly = status !== 'under_review';

        // Disable semua input penilaian
        scoreInput.readOnly = isReadonly;
        resultSelect.disabled = isReadonly;
        remarksTextarea.readOnly = isReadonly;

        // Tambahkan gaya visual agar terlihat nonaktif
        [scoreInput, resultSelect, remarksTextarea].forEach(el => {
          if (isReadonly) {
            el.classList.add('bg-light');
          } else {
            el.classList.remove('bg-light');
          }
        });
      };

      // Jalankan saat pertama kali modal dimuat
      toggleSelectionReadonly();

      // Jalankan setiap kali status berubah
      select.addEventListener('change', toggleSelectionReadonly);
    });
  });
</script>

</body>

</html>
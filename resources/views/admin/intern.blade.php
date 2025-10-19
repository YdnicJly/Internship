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

    <!-- ACTIVE INTERNS -->
    <div class="card p-4">
      <div class="d-flex justify-content-between align-items-center mb-4">
        <h5 class="mb-0"><i class="bi bi-people text-primary me-2"></i> Pemagang Aktif</h5>
      </div>
      <table id="internsTable" class="table table-hover align-middle">
        <thead class="table-light">
          <tr>
            <th>Nama</th>
            <th>Sekolah</th>
            <th>Jurusan</th>
            <th>Posisi</th>
            <th>Telepon</th>
            <th>Status</th>
            <th class="text-end">Aksi</th>
          </tr>
        </thead>
        <tbody>
          @forelse($interns as $intern)
            @php
              $application = $intern->applications->where('status', 'active')->first();
            @endphp
            <tr>
              <td>{{ $intern->name }}</td>
              <td>{{ $intern->school_name ?? '-' }}</td>
              <td>{{ $intern->major ?? '-' }}</td>
              <td>{{ $application->position->title ?? '-' }}</td>
              <td>{{ $intern->phone ?? '-' }}</td>
              <td>
                @php
                  $statusMap = [
                    'active' => ['label' => 'Aktif', 'class' => 'success'],
                  ];

                  $status = $statusMap[$application->status] ?? ['label' => ucfirst($application->status), 'class' => 'secondary'];
                @endphp

                <span class="badge bg-{{ $status['class'] }}">
                  {{ $status['label'] }}
                </span>
              </td>
              <td class="text-end d-flex justify-content-end align-items-center gap-2">
                <div class="dropdown">
                  <button class="btn btn-sm btn-outline-primary dropdown-toggle" type="button" data-bs-toggle="dropdown">
                    Aksi
                  </button>
                  <ul class="dropdown-menu dropdown-menu-end shadow-sm">
                    <a href="{{ route('admin.intern.journals', $intern->id) }}" class="dropdown-item">
                      <i class="bi bi-journal-text me-2 text-primary"></i> Jurnal
                    </a>
                    <li><a href="#" class="dropdown-item text-success" data-bs-toggle="modal"
                        data-bs-target="#evaluationModal{{ $intern->id }}"><i class="bi bi-clipboard2-check me-2"></i>
                        Evaluasi</a></li>
                    <li><a href="#" class="dropdown-item text-warning" data-bs-toggle="modal"
                        data-bs-target="#certificateModal{{ $intern->id }}"><i class="bi bi-file-earmark-pdf me-2"></i>
                        Sertifikat</a></li>
                  </ul>
                </div>

                <button class="btn btn-sm btn-outline-warning" data-bs-toggle="modal"
                  data-bs-target="#editInternModal{{ $intern->id }}">
                  <i class="bi bi-pencil"></i>
                </button>

                <form action="{{ route('admin.intern.destroy', $intern->id) }}" method="POST" class="d-inline">
                  @csrf
                  @method('DELETE')
                  <button type="submit" class="btn btn-sm btn-outline-danger"
                    onclick="return confirm('Hapus data pemagang ini?')">
                    <i class="bi bi-trash"></i>
                  </button>
                </form>
              </td>
            </tr>
            <!-- Modal Evaluasi + Final Report -->
<div class="modal fade" id="evaluationModal{{ $intern->id }}" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog modal-lg modal-dialog-centered">
    <div class="modal-content border-0 shadow">
      <div class="modal-header bg-primary text-white">
        <h5 class="modal-title"><i class="bi bi-clipboard2-check me-2"></i>Evaluasi Pemagang</h5>
        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
      </div>

      <form action="{{ route('admin.intern.evaluation.store', $intern->id) }}" method="POST">
        @csrf
        <div class="modal-body">

          {{-- 🔹 Form Penilaian --}}
          <div class="row g-3 mb-4">
            @foreach ([
              'discipline' => 'Kedisiplinan',
              'teamwork' => 'Kerja Sama Tim',
              'communication' => 'Komunikasi',
              'skill' => 'Keahlian',
              'responsibility' => 'Tanggung Jawab'
            ] as $key => $label)
              <div class="col-md-6">
                <label class="form-label">{{ $label }}</label>
                <input type="number" name="{{ $key }}" class="form-control" min="0" max="100" required>
              </div>
            @endforeach

            <div class="col-12">
              <label class="form-label">Catatan</label>
              <textarea name="notes" class="form-control" rows="3"></textarea>
            </div>
          </div>

          <hr class="my-3">

          {{-- 🔹 Bagian Laporan Akhir --}}
          <h6 class="fw-bold mb-3 text-info"><i class="bi bi-journal-richtext me-2"></i>Laporan Akhir</h6>
          @php
            $finalReport = $intern->finalReport ?? null;
          @endphp

          @if ($finalReport && $finalReport->file_path)
            <div class="ratio ratio-16x9 border rounded mb-3">
              <iframe src="{{ asset('storage/' . $finalReport->file_path) }}" class="rounded"></iframe>
            </div>
            <a href="{{ asset('storage/' . $finalReport->file_path) }}" target="_blank"
               class="btn btn-outline-info btn-sm">
              <i class="bi bi-box-arrow-up-right me-1"></i> Buka Laporan di Tab Baru
            </a>
          @else
            <p class="text-muted mb-0">Belum ada laporan akhir diunggah oleh pemagang ini.</p>
          @endif

        </div>

        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
          <button type="submit" class="btn btn-primary">Simpan Evaluasi</button>
        </div>
      </form>
    </div>
  </div>
</div>


            <!-- Modal Sertifikat -->
            <div class="modal fade" id="certificateModal{{ $intern->id }}" tabindex="-1" aria-hidden="true">
              <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content border-0 shadow">
                  <div class="modal-header bg-warning">
                    <h5 class="modal-title text-dark"><i class="bi bi-file-earmark-pdf me-2"></i>Upload Sertifikat</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                  </div>
                  <form action="{{ route('admin.intern.certificate.store', $intern->id) }}" method="POST"
                    enctype="multipart/form-data">
                    @csrf
                    <div class="modal-body">
                      <label class="form-label">File Sertifikat (PDF)</label>
                      <input type="file" name="certificate_file" class="form-control" accept="application/pdf" required>
                    </div>
                    <div class="modal-footer">
                      <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                      <button type="submit" class="btn btn-warning text-dark">Upload</button>
                    </div>
                  </form>
                </div>
              </div>
            </div>

            <!-- Modal Edit Status -->
            <div class="modal fade" id="editInternModal{{ $intern->id }}" tabindex="-1" aria-hidden="true">
              <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content border-0 shadow">
                  <div class="modal-header bg-info text-white">
                    <h5 class="modal-title"><i class="bi bi-pencil me-2"></i>Edit Status Pemagang</h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                  </div>
                  <form action="{{ route('admin.intern.update', $intern->id) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="modal-body">
                      <div class="mb-3">
                        <label class="form-label">Nama</label>
                        <input type="text" class="form-control" value="{{ $intern->name }}" readonly>
                      </div>
                      <div class="mb-3">
                        <label class="form-label">Sekolah</label>
                        <input type="text" class="form-control" value="{{ $intern->school_name }}" readonly>
                      </div>
                      <div class="mb-3">
                        <label class="form-label">Jurusan</label>
                        <input type="text" class="form-control" value="{{ $intern->major }}" readonly>
                      </div>
                      <div class="mb-3">
                        <label class="form-label">Status Magang</label>
                        <select name="status" class="form-select" required>
                          <option value="active" {{ $application->status == 'active' ? 'selected' : '' }}>Aktif</option>
                          <option value="completed" {{ $application->status == 'completed' ? 'selected' : '' }}>Selesai
                          </option>
                        </select>
                      </div>
                      <input type="hidden" name="position_id" value="{{ $application->position_id }}">
                      <input type="hidden" name="name" value="{{ $intern->name }}">
                      <input type="hidden" name="school_name" value="{{ $intern->school_name }}">
                      <input type="hidden" name="major" value="{{ $intern->major }}">
                      <input type="hidden" name="phone" value="{{ $intern->phone }}">
                    </div>
                    <div class="modal-footer">
                      <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                      <button type="submit" class="btn btn-info text-white">Simpan</button>
                    </div>
                  </form>
                </div>
              </div>
            </div>
          @empty
            <tr>
              <td colspan="7" class="text-center text-muted py-4">Tidak ada data pemagang aktif.</td>
            </tr>
          @endforelse
        </tbody>
      </table>
    </div>

    <!-- COMPLETED INTERNS -->
    <div class="card p-4 mt-5">
      <div class="d-flex justify-content-between align-items-center mb-4">
        <h5 class="mb-0"><i class="bi bi-check-circle text-success me-2"></i> Pemagang Selesai</h5>
      </div>

      <table id="completedInternsTable" class="table table-hover align-middle">
        <thead class="table-light">
          <tr>
            <th>Nama</th>
            <th>Sekolah</th>
            <th>Jurusan</th>
            <th>Posisi</th>
            <th>Telepon</th>
            <th>Status</th>
            <th class="text-end">Aksi</th>
          </tr>
        </thead>
        <tbody>
          @forelse($completedInterns as $intern)
            @php
              $application = $intern->applications->where('status', 'completed')->first();
              $evaluation = $intern->evaluations?->last();
              $certificate = $intern->certificate ?? null;
            @endphp

            <tr>
              <td>{{ $intern->name }}</td>
              <td>{{ $intern->school_name ?? '-' }}</td>
              <td>{{ $intern->major ?? '-' }}</td>
              <td>{{ $application?->position?->title ?? '-' }}</td>
              <td>{{ $intern->phone ?? '-' }}</td>
              <td><span class="badge bg-secondary">Selesai</span></td>

              <td class="text-end d-flex justify-content-end align-items-center gap-2">
                <!-- Jurnal -->
                <a href="{{ route('admin.journals.show', $intern->id) }}" class="btn btn-sm btn-outline-primary"
                  title="Lihat Jurnal">
                  <i class="bi bi-journal-text"></i>
                </a>

                <!-- Evaluasi -->
                <button class="btn btn-sm btn-outline-success" data-bs-toggle="modal"
                  data-bs-target="#evaluationModal{{ $intern->id }}" title="Lihat Evaluasi" {{ !$evaluation ? 'disabled' : '' }}>
                  <i class="bi bi-clipboard2-check"></i>
                </button>

                <!-- Sertifikat -->
                <button class="btn btn-sm btn-outline-warning" data-bs-toggle="modal"
                  data-bs-target="#certificateModal{{ $intern->id }}" title="Lihat Sertifikat" {{ !$certificate ? 'disabled' : '' }}>
                  <i class="bi bi-file-earmark-pdf"></i>
                </button>

                <!-- Hapus -->
                <form action="{{ route('admin.intern.destroy', $intern->id) }}" method="POST" class="d-inline">
                  @csrf
                  @method('DELETE')
                  <button type="submit" class="btn btn-sm btn-outline-danger"
                    onclick="return confirm('Hapus data pemagang ini?')" title="Hapus Data">
                    <i class="bi bi-trash"></i>
                  </button>
                </form>
              </td>
            </tr>

            <!-- Modal Evaluasi + Final Report -->
            <div class="modal fade" id="evaluationModal{{ $intern->id }}" tabindex="-1" aria-hidden="true">
              <div class="modal-dialog modal-lg modal-dialog-centered">
                <div class="modal-content border-0 shadow">
                  <div class="modal-header bg-success text-white">
                    <h5 class="modal-title">
                      <i class="bi bi-clipboard2-check me-2"></i>Hasil Evaluasi & Laporan Akhir
                    </h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                  </div>

                  <div class="modal-body">
                    {{-- Bagian Evaluasi --}}
                    <h6 class="fw-bold mb-3 text-success"><i class="bi bi-bar-chart-line me-2"></i>Evaluasi Pemagang</h6>
                    @if ($evaluation)
                      <ul class="list-group mb-4">
                        <li class="list-group-item"><strong>Kedisiplinan:</strong> {{ $evaluation->discipline ?? '-' }}</li>
                        <li class="list-group-item"><strong>Kerja Sama Tim:</strong> {{ $evaluation->teamwork ?? '-' }}</li>
                        <li class="list-group-item"><strong>Komunikasi:</strong> {{ $evaluation->communication ?? '-' }}
                        </li>
                        <li class="list-group-item"><strong>Keahlian:</strong> {{ $evaluation->skill ?? '-' }}</li>
                        <li class="list-group-item"><strong>Tanggung Jawab:</strong>
                          {{ $evaluation->responsibility ?? '-' }}</li>
                        <li class="list-group-item"><strong>Catatan:</strong> {{ $evaluation->notes ?? '-' }}</li>
                      </ul>
                    @else
                      <p class="text-muted mb-4">Belum ada data evaluasi.</p>
                    @endif

                    {{-- Bagian Laporan Akhir --}}
                    <h6 class="fw-bold mb-3 text-info"><i class="bi bi-journal-richtext me-2"></i>Laporan Akhir</h6>
                    @php
                      $finalReport = $intern->finalReport ?? null;
                    @endphp
                    @if ($finalReport && $finalReport->file_path)
                      <div class="ratio ratio-16x9 border rounded mb-3">
                        <iframe src="{{ asset('storage/' . $finalReport->file_path) }}" class="rounded"></iframe>
                      </div>
                      <a href="{{ asset('storage/' . $finalReport->file_path) }}" target="_blank"
                        class="btn btn-outline-info btn-sm">
                        <i class="bi bi-box-arrow-up-right me-1"></i> Buka di Tab Baru
                      </a>
                    @else
                      <p class="text-muted mb-0">Belum ada laporan akhir diunggah.</p>
                    @endif
                  </div>

                  <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                  </div>
                </div>
              </div>
            </div>


            <!-- Modal Sertifikat -->
            <div class="modal fade" id="certificateModal{{ $intern->id }}" tabindex="-1" aria-hidden="true">
              <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content border-0 shadow">
                  <div class="modal-header bg-warning">
                    <h5 class="modal-title text-dark"><i class="bi bi-file-earmark-pdf me-2"></i>Sertifikat Pemagang</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                  </div>
                  <div class="modal-body text-center">
                    @if ($certificate)
                      <a href="{{ asset('storage/' . $certificate->file_path) }}" target="_blank"
                        class="btn btn-outline-warning">
                        <i class="bi bi-file-earmark-pdf me-1"></i> Lihat Sertifikat
                      </a>
                    @else
                      <p class="text-muted mb-0">Belum ada sertifikat diunggah.</p>
                    @endif
                  </div>
                  <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                  </div>
                </div>
              </div>
            </div>

          @empty
            <tr>
              <td colspan="7" class="text-center text-muted py-4">Tidak ada data pemagang selesai.</td>
            </tr>
          @endforelse
        </tbody>
      </table>

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
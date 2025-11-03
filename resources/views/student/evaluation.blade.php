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
      <span class="navbar-brand mb-0 h5">Evaluasi & Laporan Akhir</span>
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

    <!-- Alert Success -->
    @if (session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert" id="success-alert">
            <i class="bi bi-check-circle-fill me-2"></i>
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    <!-- Alert Error -->
    @if (session('error'))
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <i class="bi bi-exclamation-triangle-fill me-2"></i>
            {{ session('error') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    <!-- Validation Errors -->
    @if ($errors->any())
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <i class="bi bi-exclamation-triangle-fill me-2"></i>
            <strong>Terjadi kesalahan:</strong>
            <ul class="mb-0 mt-2">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    <!-- Upload Laporan Akhir -->
    <div class="card p-4 mb-4">
  <h5 class="mb-3">
    <i class="bi bi-upload me-2 text-primary"></i> Laporan Akhir Magang
  </h5>

  @if ($finalReport)
    <!-- ✅ Tampilan jika sudah ada laporan -->
    <div class="file-info-box mb-3">
      <div class="d-flex flex-wrap justify-content-between align-items-start gap-3">
        <div class="flex-grow-1">
          <h6 class="mb-2">
            <i class="bi bi-file-earmark-check-fill text-success me-2"></i>
            <strong>Laporan Anda</strong>
          </h6>
          <p class="mb-1 text-break">
            <i class="bi bi-file-text me-2"></i>
            <span class="text-dark">{{ basename($finalReport->file_path) }}</span>
          </p>
          <small class="text-muted d-block">
            <i class="bi bi-clock me-1"></i>
            Diunggah pada {{ $finalReport->created_at->format('d M Y, H:i') }} WIB
          </small>
        </div>

        <div class="btn-action-group d-flex flex-wrap gap-2">
          <!-- Tombol Lihat -->
          <a href="{{ asset($finalReport->file_path) }}" 
             target="_blank" 
             class="btn btn-success btn-sm w-100 w-md-auto">
            <i class="bi bi-eye"></i> Lihat
          </a>

          <!-- Tombol Ubah / Terkunci -->
          @if (!$evaluation)
            <button class="btn btn-warning btn-sm w-100 w-md-auto" 
                    type="button"
                    data-bs-toggle="collapse" 
                    data-bs-target="#editFinalReport"
                    aria-expanded="false">
              <i class="bi bi-pencil-square"></i> Ubah
            </button>
          @else
            <button class="btn btn-secondary btn-sm w-100 w-md-auto" disabled>
              <i class="bi bi-lock"></i> Terkunci
            </button>
          @endif
        </div>
      </div>
    </div>

    <!-- ✅ Form Ubah Laporan -->
    @if (!$evaluation)
      <div class="collapse" id="editFinalReport">
        <div class="card card-body bg-light">
          <h6 class="mb-3">
            <i class="bi bi-arrow-repeat me-2"></i> Perbarui Laporan Akhir
          </h6>

          <form action="{{ route('student.finalreport.update', $finalReport->id) }}" 
                method="POST" 
                enctype="multipart/form-data"
                onsubmit="return confirm('Apakah Anda yakin ingin memperbarui laporan ini?')">
            @csrf
            @method('PUT')

            <div class="mb-3">
              <label for="file" class="form-label">Pilih File Baru</label>
              <input type="file" 
                     class="form-control @error('file') is-invalid @enderror" 
                     id="file"
                     name="file" 
                     accept=".pdf,.doc,.docx" 
                     required>
              <div class="form-text">
                <i class="bi bi-info-circle me-1"></i>
                Format: PDF, DOC, DOCX (Maksimal 5MB)
              </div>
              @error('file')
                <div class="invalid-feedback">{{ $message }}</div>
              @enderror
            </div>

            <div class="d-flex flex-wrap gap-2">
              <button type="submit" class="btn btn-warning">
                <i class="bi bi-arrow-repeat me-1"></i> Perbarui
              </button>
              <button type="button" 
                      class="btn btn-secondary" 
                      data-bs-toggle="collapse" 
                      data-bs-target="#editFinalReport">
                <i class="bi bi-x-circle me-1"></i> Batal
              </button>
            </div>
          </form>
        </div>
      </div>
    @endif

  @else
    <!-- ✅ Form Upload Pertama Kali -->
    <div class="alert alert-info" role="alert">
      <i class="bi bi-info-circle-fill me-2"></i>
      Anda belum mengunggah laporan akhir. Silakan unggah file laporan Anda.
    </div>

    <form action="{{ route('student.finalreport.store') }}" 
          method="POST" 
          enctype="multipart/form-data"
          onsubmit="return confirm('Pastikan file yang akan diunggah sudah benar. Lanjutkan?')">
      @csrf

      <div class="mb-3">
        <label for="file" class="form-label">
          <i class="bi bi-file-earmark-arrow-up me-2"></i>
          Pilih File Laporan Akhir
        </label>
        <input type="file" 
               class="form-control @error('file') is-invalid @enderror" 
               id="file"
               name="file" 
               accept=".pdf,.doc,.docx" 
               required>
        <div class="form-text">
          <i class="bi bi-info-circle me-1"></i>
          Format: PDF, DOC, DOCX (Maksimal 5MB)
        </div>
        @error('file')
          <div class="invalid-feedback">{{ $message }}</div>
        @enderror
      </div>

      <button type="submit" class="btn btn-primary w-100 w-md-auto">
        <i class="bi bi-cloud-arrow-up me-1"></i> Unggah Laporan
      </button>
    </form>
  @endif
</div>


    <!-- Hasil Evaluasi -->
    <div class="card p-4 mb-4">
  <h5 class="mb-3">
    <i class="bi bi-clipboard-data me-2 text-success"></i> Hasil Evaluasi
  </h5>

  @if ($evaluation)
    <div class="alert alert-success mb-3">
      <i class="bi bi-check-circle-fill me-2"></i>
      Evaluasi Anda telah tersedia
    </div>

    <!-- ✅ Table Responsive -->
    <div class="table-responsive">
      <table class="table table-bordered align-middle">
        <thead class="table-light">
          <tr>
            <th width="60%">Kriteria Penilaian</th>
            <th width="40%" class="text-center">Nilai</th>
          </tr>
        </thead>
        <tbody>
          <tr>
            <td><i class="bi bi-clock-fill text-primary me-2"></i> Kedisiplinan</td>
            <td class="text-center"><strong>{{ $evaluation->discipline ?? '-' }}</strong></td>
          </tr>
          <tr>
            <td><i class="bi bi-people-fill text-primary me-2"></i> Kerja Sama Tim</td>
            <td class="text-center"><strong>{{ $evaluation->teamwork ?? '-' }}</strong></td>
          </tr>
          <tr>
            <td><i class="bi bi-chat-dots-fill text-primary me-2"></i> Komunikasi</td>
            <td class="text-center"><strong>{{ $evaluation->communication ?? '-' }}</strong></td>
          </tr>
          <tr>
            <td><i class="bi bi-gear-fill text-primary me-2"></i> Kompetensi Keahlian</td>
            <td class="text-center"><strong>{{ $evaluation->skill ?? '-' }}</strong></td>
          </tr>
          <tr>
            <td><i class="bi bi-shield-check text-primary me-2"></i> Tanggung Jawab</td>
            <td class="text-center"><strong>{{ $evaluation->responsibility ?? '-' }}</strong></td>
          </tr>
        </tbody>
      </table>
    </div>

    @if ($evaluation->notes)
      <div class="mt-3">
        <h6><i class="bi bi-chat-left-text me-2"></i> Catatan Pembimbing:</h6>
        <div class="alert alert-light border">
          {{ $evaluation->notes }}
        </div>
      </div>
    @endif
  @else
    <!-- ✅ Tampilan jika belum ada evaluasi -->
    <div class="text-center text-muted py-5">
      <i class="bi bi-hourglass-split display-4 d-block mb-3 text-secondary"></i>
      <p class="mb-0">Hasil evaluasi belum tersedia.</p>
      <small>Pembimbing akan memberikan evaluasi setelah meninjau laporan Anda.</small>
    </div>
  @endif
</div>


    <!-- Sertifikat Magang -->
    <div class="card p-4">
  <h5 class="mb-3">
    <i class="bi bi-award-fill me-2 text-warning"></i> Sertifikat Magang
  </h5>

  @if ($certificate)
    <div class="alert alert-light border d-flex flex-wrap justify-content-between align-items-center gap-3">
      <div class="flex-grow-1">
        <h6 class="mb-1 text-break">
          <i class="bi bi-file-earmark-pdf-fill text-danger me-2"></i>
          <strong>{{ basename($certificate->file_path) }}</strong>
        </h6>
        <small class="text-muted d-block mt-1">
          <i class="bi bi-calendar-check me-1"></i>
          Diterbitkan pada {{ $certificate->created_at->format('d M Y') }}
        </small>
      </div>

      <div class="text-end">
        <a href="{{ asset($certificate->file_path) }}" 
           target="_blank"
           download
           class="btn btn-primary btn-sm w-100 w-md-auto">
          <i class="bi bi-download"></i> Unduh Sertifikat
        </a>
      </div>
    </div>
  @else
    <div class="text-center text-muted py-5">
      <i class="bi bi-award display-4 d-block mb-3 text-secondary"></i>
      <p class="mb-0">Sertifikat belum tersedia.</p>
      <small>Sertifikat akan diterbitkan setelah Anda menyelesaikan seluruh proses magang.</small>
    </div>
  @endif
</div>

  </div>

  <!-- Modal Logout -->
  <div class="modal fade" id="logoutModal" tabindex="-1" aria-labelledby="logoutModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content border-0 shadow">
        <div class="modal-header bg-danger text-white">
          <h5 class="modal-title" id="logoutModalLabel">
            <i class="bi bi-box-arrow-right me-2"></i>Konfirmasi Keluar
          </h5>
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
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <!-- ✅ Tambahkan library PDF.js -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdf.js/2.16.105/pdf.min.js"></script>   
  <script>
    // Auto-hide success alert after 3 seconds
    setTimeout(() => {
      const alert = document.getElementById('success-alert');
      if (alert) {
        const bsAlert = new bootstrap.Alert(alert);
        bsAlert.close();
      }
    }, 3000);
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
</body>

</html>
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
      <span class="navbar-brand mb-0 h5">Beranda</span>
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
        <!-- Filter Section -->
        <div class="card p-4 mb-4">
            <h5 class="mb-3"><i class="bi bi-funnel me-2 text-primary"></i> Lowongan Magang Tersedia</h5>
            <form action="{{ route('student.dashboard') }}" method="GET" class="row g-3">
                <div class="col-md-4">
                    <label class="form-label fw-semibold">Departemen</label>
                    <select name="department" class="form-select">
                        <option {{ request('department') == 'All Departments' ? 'selected' : '' }}>Semua Departemen
                        </option>
                        @foreach ($positions->pluck('department')->unique() as $dept)
                            <option value="{{ $dept }}" {{ request('department') == $dept ? 'selected' : '' }}>
                                {{ $dept }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="col-md-4">
                    <label class="form-label fw-semibold">Posisi</label>
                    <select name="title" class="form-select">
                        <option {{ request('title') == 'All Position' ? 'selected' : '' }}>Semua Posisi</option>
                        @foreach ($positions->pluck('title')->unique() as $title)
                            <option value="{{ $title }}" {{ request('title') == $title ? 'selected' : '' }}>
                                {{ $title }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="col-md-4">
                    <label class="form-label fw-semibold">Kata Kunci</label>
                    <input type="text" name="keyword" class="form-control"
                        placeholder="Cari berdasarkan judul atau kata kunci" value="{{ request('keyword') }}">
                </div>

                <div class="col-12 text-end">
                    <button type="submit" class="btn btn-primary mt-2">
                        <i class="bi bi-search me-1"></i> Terapkan Filter
                    </button>
                </div>
            </form>

        </div>

        <!-- Internship Listings -->
        <div class="card p-4">
            <h5 class="mb-3"><i class="bi bi-briefcase me-2 text-primary"></i> Posisi Magang yang Tersedia</h5>
            <div class="row g-3">
                @foreach ($positions as $position)
                    <div class="col-md-4">
                        <div class="card p-3 border-0 shadow-sm h-100">
                            <h6 class="fw-bold mb-1">{{ $position->title }}</h6>
                            <p class="small text-muted mb-2">{{ $position->department }}</p>
                            <p class="small text-secondary mb-3">{{ Str::limit($position->description, 100) }}</p>
                            <div class="mt-auto">
                                <button class="btn btn-sm btn-outline-primary w-100" data-bs-toggle="modal"
                                    data-bs-target="#positionModal{{ $position->id }}">
                                    Lihat Rincian
                                </button>
                            </div>
                        </div>
                    </div>

                    <!-- Position Detail Modal -->
                    <div class="modal fade" id="positionModal{{ $position->id }}" tabindex="-1"
                        aria-labelledby="positionModalLabel{{ $position->id }}" aria-hidden="true">
                        <div class="modal-dialog modal-lg modal-dialog-centered">
                            <div class="modal-content border-0 shadow">
                                <div class="modal-header bg-primary text-white">
                                    <h5 class="modal-title" id="positionModalLabel{{ $position->id }}">
                                        <i class="bi bi-briefcase me-2"></i>{{ $position->title }}
                                    </h5>
                                    <button type="button" class="btn-close btn-close-white"
                                        data-bs-dismiss="modal"></button>
                                </div>
                                <div class="modal-body">
                                    <p><strong>Departemen:</strong> {{ $position->department }}</p>
                                    <p><strong>Deskripsi:</strong><br>{{ $position->description }}</p>
                                    <p><strong>Persyaratan:</strong><br>{{ $position->requirements }}</p>
                                    <p><strong>Kuota:</strong> {{ $position->quota }}</p>
                                    <p><strong>Tanggal batas waktu:</strong>
                                        {{ \Carbon\Carbon::parse($position->deadline)->format('d M Y') }}</p>
                                    <p><strong>Status:</strong>
                                        <span class="badge bg-{{ $position->status == 'open' ? 'success' : 'secondary' }}">
                                            {{ ucfirst($position->status) }}
                                        </span>
                                    </p>
                                </div>
                                <div class="modal-footer">
                                    <button class="btn btn-secondary" data-bs-dismiss="modal">
                                        <i class="bi bi-x-circle me-1"></i> Tutup
                                    </button>
                                    @php
    // 🔍 Cek apakah user sudah punya lamaran aktif
    $hasActiveApplication = auth()->user()
        ->applications()
        ->where('status', 'active')
        ->exists();
@endphp

@if ($position->status === 'open')
    @if ($hasActiveApplication)
        {{-- 🚫 Jika user punya lamaran aktif, tombol terkunci --}}
        <button class="btn btn-secondary" disabled title="Anda sudah memiliki magang aktif">
            <i class="bi bi-lock-fill me-1"></i>Terkunci
        </button>
    @else
        {{-- ✅ Jika belum ada lamaran aktif, boleh daftar --}}
        <button class="btn btn-primary"
            data-bs-target="#applyModal{{ $position->id }}"
            data-bs-toggle="modal"
            data-bs-dismiss="modal">
            <i class="bi bi-send me-1"></i> Daftar
        </button>
    @endif
@endif
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Application Form Modal -->
<div class="modal fade" id="applyModal{{ $position->id }}" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content border-0 shadow">
            <div class="modal-header bg-success text-white">
                <h5 class="modal-title">
                    <i class="bi bi-send me-2"></i>Ajukan permohonan untuk {{ $position->title }}
                </h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
            </div>

            <form action="{{ route('student.applications.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <input type="hidden" name="position_id" value="{{ $position->id }}">

                <div class="modal-body">
                    <div class="row g-3">
                        <div class="col-md-6">
                            <label class="form-label fw-semibold">Email Aktif
                                <span class="text-danger">*</span>
                            </label>
                            <input type="email" name="active_email" class="form-control"
                                value="{{ old('active_email', Auth::user()->email) }}"
                                placeholder="Masukkan email aktif Anda" required>
                            <div class="form-text" style="font-size: 0.8rem; color: #6c757d;">
                                ⚠️ Anda dapat mengubah ini jika Anda lebih memilih alamat email aktif yang berbeda.
                            </div>
                        </div>

                        <div class="col-md-6">
                            <label class="form-label fw-semibold">Nomor WhatsApp
                                <span class="text-danger">*</span>
                            </label>
                            <input type="text" name="whatsapp_number" class="form-control"
                                value="{{ old('whatsapp_number', Auth::user()->phone ?? '') }}"
                                placeholder="Contoh: 08123456789" required>
                            <div class="form-text" style="font-size: 0.8rem; color: #6c757d;">
                                ⚠️ Anda dapat memperbarui nomor WhatsApp Anda jika berbeda dengan yang tertera di profil Anda.
                            </div>
                        </div>

                        <div class="col-md-12">
                            <label class="form-label fw-semibold">Durasi Magang
                                <span class="text-danger">*</span>
                            </label>
                            <select name="duration" class="form-select" required>
                                <option value="">Pilih Durasi</option>
                                <option value="1 Month">1 Bulan</option>
                                <option value="3 Months">3 Bulan</option>
                                <option value="6 Months">6 Bulan</option>
                                <option value="8 Months">8 Bulan</option>
                                <option value="12 Months">12 Bulan</option>
                            </select>
                        </div>

                        <div class="col-12">
                            <label class="form-label fw-semibold">Motivasi
                                <span class="text-danger">*</span>
                            </label>
                            <textarea name="motivation" class="form-control" rows="3"
                                placeholder="Mengapa kamu tertarik untuk magang di sini?" required></textarea>
                        </div>

                        <hr class="my-3">

                        <h6 class="fw-bold">
                            <i class="bi bi-file-earmark-arrow-up me-2 text-success"></i>Unggah Dokumen
                        </h6>
                        <p class="small text-muted">
                            Format yang diterima: PDF, ukuran maksimum 2MB per file.
                        </p>

                        <div class="row g-4">
                            @php
                                $docs = [
                                    'cv' => 'Curriculum Vitae (CV)',
                                    'recommendation' => 'Surat Rekomendasi',
                                    'portfolio' => 'Portofolio',
                                    'transcript' => 'Transkrip',
                                ];
                            @endphp

                            @foreach ($docs as $key => $label)
                                <div class="col-md-6">
                                    <label class="form-label fw-semibold">{{ $label }}
                                        @if (in_array($key, ['cv', 'recommendation']))
                                            <span class="text-danger">*</span>
                                        @endif
                                    </label>
                                    <input type="file" name="documents[{{ $key }}]" class="form-control file-input"
                                        accept=".pdf" @if (in_array($key, ['cv', 'recommendation'])) required @endif>

                                    <!-- Tempat preview file PDF -->
                                    <div class="mt-2 pdf-preview border rounded p-2 text-center" style="display:none;">
                                        <canvas class="pdf-canvas" style="width:100%; max-height:250px; object-fit:contain;"></canvas>
                                        <div class="small text-muted mt-1 file-name"></div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                        <i class="bi bi-x-circle me-1"></i> Batal
                    </button>
                    <button type="submit" class="btn btn-success">
                        <i class="bi bi-check-circle me-1"></i> Kirimkan Permohonan
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

                @endforeach

                @if ($positions->isEmpty())
                    <div class="text-center text-muted py-5">
                        <i class="bi bi-emoji-neutral display-6 mb-2"></i>
                        <p>Tidak ditemukan posisi magang.</p>
                    </div>
                @endif
            </div>
        </div>
    </div>

    <!-- Logout Confirmation Modal -->
    <div class="modal fade" id="logoutModal" tabindex="-1" aria-labelledby="logoutModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content border-0 shadow">
                <div class="modal-header bg-danger text-white">
                    <h5 class="modal-title" id="logoutModalLabel"><i class="bi bi-box-arrow-right me-2"></i>Konfirmasi
                        Logout</h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">Apakah Anda yakin ingin keluar dari akun ini?</div>
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
        <!-- Scripts -->
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
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <!-- ✅ Tambahkan library PDF.js -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdf.js/2.16.105/pdf.min.js"></script>   
    <script>
        @if (session('success'))
            Swal.fire({
                icon: 'success',
                title: 'Berhasil!',
                text: "{{ session('success') }}",
                showConfirmButton: false,
                timer: 1800
            });
        @endif
    </script>


<!-- ✅ Script Preview PDF -->
<script>
    document.addEventListener("DOMContentLoaded", function () {
        const fileInputs = document.querySelectorAll(".file-input");

        fileInputs.forEach(input => {
            input.addEventListener("change", async function (e) {
                const file = e.target.files[0];
                const previewContainer = input.closest(".col-md-6").querySelector(".pdf-preview");
                const canvas = previewContainer.querySelector(".pdf-canvas");
                const fileNameDisplay = previewContainer.querySelector(".file-name");

                if (file && file.type === "application/pdf") {
                    previewContainer.style.display = "block";
                    fileNameDisplay.textContent = `📄 ${file.name}`;

                    // Buat URL sementara untuk file PDF
                    const fileURL = URL.createObjectURL(file);
                    const loadingTask = pdfjsLib.getDocument(fileURL);

                    try {
                        const pdf = await loadingTask.promise;
                        const page = await pdf.getPage(1);
                        const viewport = page.getViewport({ scale: 1.0 });

                        // Render setengah halaman (atas)
                        const canvasContext = canvas.getContext("2d");
                        const scale = canvas.width / viewport.width || 0.8;
                        const renderViewport = page.getViewport({ scale });

                        canvas.height = renderViewport.height / 2; // setengah halaman
                        const renderContext = {
                            canvasContext: canvasContext,
                            viewport: renderViewport,
                            transform: [1, 0, 0, 0.5, 0, 0], // render separuh tinggi
                        };
                        await page.render(renderContext).promise;
                    } catch (err) {
                        fileNameDisplay.textContent = "⚠️ Gagal menampilkan preview PDF.";
                        console.error(err);
                    }
                } else {
                    previewContainer.style.display = "none";
                    canvas.getContext("2d").clearRect(0, 0, canvas.width, canvas.height);
                }
            });
        });
    });
</script>
</body>

</html>
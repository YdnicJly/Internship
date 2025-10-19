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
                <li><a href="{{ route('student.dashboard') }}" class="nav-link active"><i
                            class="bi bi-briefcase me-2"></i> Beranda</a></li>
                <li><a href="{{ route('student.applications') }}" class="nav-link"><i
                            class="bi bi-clipboard-check me-2"></i> Lamaran saya</a></li>
                <li><a href="{{ route('student.journal') }}" class="nav-link"><i class="bi bi-journal-text me-2"></i>
                        Jurnal Magang
                    </a></li>
                <li><a href="{{ route('student.evaluation') }}" class="nav-link"><i class="bi bi-award me-2"></i>
                        Evaluasi</a></li>
                <li><a href="{{ route('profile') }}" class="nav-link"><i class="bi bi-person-lines-fill me-2"></i>
                        Profil</a></li>
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
        <nav class="navbar navbar-expand-lg navbar-light bg-white mb-4 rounded shadow-sm">
            <div class="container-fluid">
                <span class="navbar-brand mb-0 h5">Selamat Datang di Beranda,
                    {{ Auth::user()->name ?? 'Student' }}</span>
                <div class="d-flex align-items-center">
                    <span class="me-3 text-muted small">{{ Auth::user()->name ?? 'Internship Candidate' }}</span>
                    <img src="https://ui-avatars.com/api/?name={{ urlencode(Auth::user()->name ?? 'S') }}&background=0d6efd&color=fff"
                        class="rounded-circle" width="40" height="40" alt="Student Avatar">
                </div>
            </div>
        </nav>

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
                                    @if ($position->status === 'open')
                                        <button class="btn btn-primary" data-bs-target="#applyModal{{ $position->id }}"
                                            data-bs-toggle="modal" data-bs-dismiss="modal">
                                            <i class="bi bi-send me-1"></i> Daftar
                                        </button>
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
                                    <button type="button" class="btn-close btn-close-white"
                                        data-bs-dismiss="modal"></button>
                                </div>

                                <form action="{{ route('student.applications.store') }}" method="POST"
                                    enctype="multipart/form-data">
                                    @csrf
                                    <input type="hidden" name="position_id" value="{{ $position->id }}">

                                    <div class="modal-body">
                                        <div class="row g-3">
                                            <div class="col-md-6">
                                                <label class="form-label fw-semibold">Email Aktif</label>
                                                <input type="email" name="active_email" class="form-control"
                                                    value="{{ old('active_email', Auth::user()->email) }}"
                                                    placeholder="Enter your active email" required>
                                                <div class="form-text text-muted">
                                                    Anda dapat mengubah ini jika Anda lebih memilih alamat email aktif yang
                                                    berbeda.
                                                </div>
                                            </div>

                                            <div class="col-md-6">
                                                <label class="form-label fw-semibold">Nomor WhatsApp</label>
                                                <input type="text" name="whatsapp_number" class="form-control"
                                                    value="{{ old('whatsapp_number', Auth::user()->phone ?? '') }}"
                                                    placeholder="e.g. 08123456789" required>
                                                <div class="form-text text-muted">
                                                    Anda dapat memperbarui nomor WhatsApp Anda jika berbeda dengan yang
                                                    tertera di profil Anda.
                                                </div>
                                            </div>


                                            <div class="col-md-6">
                                                <label class="form-label fw-semibold">Durasi Magang</label>
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
                                                <label class="form-label fw-semibold">Motivasi</label>
                                                <textarea name="motivation" class="form-control" rows="3"
                                                    placeholder="Why do you want to join this internship?"
                                                    required></textarea>
                                            </div>

                                            <hr class="my-3">

                                            <h6 class="fw-bold"><i
                                                    class="bi bi-file-earmark-arrow-up me-2 text-success"></i>Unggah
                                                Dokumen</h6>
                                            <p class="small text-muted">Format yang diterima: PDF, ukuran maksimum 2MB per
                                                file.</p>

                                            <div class="col-md-6">
                                                <label class="form-label fw-semibold">Curriculum Vitae (CV)</label>
                                                <input type="file" name="documents[cv]" class="form-control" accept=".pdf"
                                                    required>
                                            </div>

                                            <div class="col-md-6">
                                                <label class="form-label fw-semibold">Surat Rekomendasi</label>
                                                <input type="file" name="documents[recommendation]" class="form-control"
                                                    accept=".pdf">
                                            </div>

                                            <div class="col-md-6">
                                                <label class="form-label fw-semibold">Portofolio (opsional)</label>
                                                <input type="file" name="documents[portfolio]" class="form-control"
                                                    accept=".pdf">
                                            </div>

                                            <div class="col-md-6">
                                                <label class="form-label fw-semibold">Transkrip (opsional)</label>
                                                <input type="file" name="documents[transcript]" class="form-control"
                                                    accept=".pdf">
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

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
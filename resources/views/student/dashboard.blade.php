<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Internship Openings - Diskominfo Internship</title>

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
                <i class="bi bi-person-workspace me-2"></i> Student Portal
            </h5>
            <ul class="nav flex-column gap-1">
                <li><a href="{{ route('student.dashboard') }}" class="nav-link active"><i
                            class="bi bi-briefcase me-2"></i> Dashboard</a></li>
                <li><a href="{{ route('student.applications') }}" class="nav-link"><i
                            class="bi bi-clipboard-check me-2"></i> My Applications</a></li>
                <li><a href="{{ route('student.journal') }}" class="nav-link"><i class="bi bi-journal-text me-2"></i> My
                        Journal</a></li>
                <li><a href="{{ route('student.evaluation') }}" class="nav-link"><i class="bi bi-award me-2"></i>
                        Evaluation</a></li>
                <li><a href="{{ route('profile') }}" class="nav-link"><i class="bi bi-person-lines-fill me-2"></i>
                        Profile</a></li>
            </ul>
        </div>

        <div>
            <hr class="text-white-50">
            <button type="button" class="btn btn-outline-light w-100" data-bs-toggle="modal"
                data-bs-target="#logoutModal">
                <i class="bi bi-box-arrow-right me-1"></i> Logout
            </button>
        </div>

    </div>

    <!-- Main Content -->
    <div class="content">
        <!-- Navbar -->
        <nav class="navbar navbar-expand-lg navbar-light bg-white mb-4 rounded shadow-sm">
            <div class="container-fluid">
                <span class="navbar-brand mb-0 h5">Welcome to Dashboard, {{ Auth::user()->name ?? 'Student' }}</span>
                <div class="d-flex align-items-center">
                    <span
                        class="me-3 text-muted small">{{ Auth::user()->education_level ?? 'Internship Candidate' }}</span>
                    <img src="https://ui-avatars.com/api/?name={{ urlencode(Auth::user()->name ?? 'S') }}&background=0d6efd&color=fff"
                        class="rounded-circle" width="40" height="40" alt="Student Avatar">
                </div>
            </div>
        </nav>

        <!-- Filter Section -->
        <div class="card p-4 mb-4">
            <h5 class="mb-3"><i class="bi bi-funnel me-2 text-primary"></i> Filter Internship Openings</h5>
            <form class="row g-3">
                <div class="col-md-4">
                    <label class="form-label fw-semibold">Department</label>
                    <select class="form-select">
                        <option selected>All Departments</option>
                        <option>Web Development</option>
                        <option>Data Center</option>
                        <option>Creative Division</option>
                        <option>Public Relations</option>
                    </select>
                </div>
                <div class="col-md-4">
                    <label class="form-label fw-semibold">Internship Type</label>
                    <select class="form-select">
                        <option selected>All Types</option>
                        <option>SMK Internship</option>
                        <option>University Internship</option>
                    </select>
                </div>
                <div class="col-md-4">
                    <label class="form-label fw-semibold">Keyword</label>
                    <input type="text" class="form-control" placeholder="Search by title or keyword">
                </div>
                <div class="col-12 text-end">
                    <button type="submit" class="btn btn-primary mt-2"><i class="bi bi-search me-1"></i> Apply
                        Filter</button>
                </div>
            </form>
        </div>

        <!-- Internship Listings -->
        <div class="card p-4">
            <h5 class="mb-3"><i class="bi bi-briefcase me-2 text-primary"></i>Available Internship Positions</h5>
            <div class="row g-3">
                @foreach ($positions as $position)
                    <div class="col-md-4">
                        <div class="card p-3 border-0 shadow-sm h-100">
                            <h6 class="fw-bold mb-1">{{ $position->title }}</h6>
                            <p class="small text-muted mb-2">{{ $position->department }}</p>
                            <p class="small text-secondary mb-3">{{ Str::limit($position->description, 100) }}</p>
                            <div class="mt-auto">
                                <a href="#" class="btn btn-sm btn-outline-primary w-100">View Details</a>
                            </div>
                        </div>
                    </div>
                @endforeach

                @if ($positions->isEmpty())
                    <div class="text-center text-muted py-5">
                        <i class="bi bi-emoji-neutral display-6 mb-2"></i>
                        <p>No internship positions found.</p>
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
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"
                        aria-label="Close"></button>
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
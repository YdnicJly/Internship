<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>My Profile - Diskominfo Internship</title>

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

    .profile-avatar {
      width: 120px;
      height: 120px;
      border-radius: 50%;
      object-fit: cover;
      border: 3px solid #0d6efd;
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
        <li><a href="{{ route('student.dashboard') }}" class="nav-link"><i class="bi bi-speedometer2 me-2"></i>
            Dashboard</a></li>
        <li><a href="{{ route('student.applications') }}" class="nav-link"><i class="bi bi-clipboard-check me-2"></i> My
            Applications</a></li>
        <li><a href="{{ route('student.journal') }}" class="nav-link"><i class="bi bi-journal-text me-2"></i> My
            Journal</a></li>
        <li><a href="{{ route('student.evaluation') }}" class="nav-link"><i class="bi bi-award me-2"></i> Evaluation</a>
        </li>
        <li><a href="{{ route('profile') }}" class="nav-link active"><i class="bi bi-person-lines-fill me-2"></i>
            Profile</a></li>
      </ul>
    </div>

    <div>
      <hr class="text-white-50">
      <button type="button" class="btn btn-outline-light w-100" data-bs-toggle="modal" data-bs-target="#logoutModal">
        <i class="bi bi-box-arrow-right me-1"></i> Logout
      </button>
    </div>

  </div>

  <!-- Main Content -->
  <div class="content">
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-light bg-white mb-4 rounded shadow-sm">
      <div class="container-fluid">
        <span class="navbar-brand mb-0 h5">My Profile</span>
        <div class="d-flex align-items-center">
          <span class="me-3 text-muted small">{{ Auth::user()->education_level ?? 'Internship Student' }}</span>
          <img
            src="https://ui-avatars.com/api/?name={{ urlencode(Auth::user()->name ?? 'S') }}&background=0d6efd&color=fff"
            class="rounded-circle" width="40" height="40" alt="Student Avatar">
        </div>
      </div>
    </nav>

    <!-- Profile Info -->
    <div class="card p-4">
      <div class="d-flex align-items-center mb-4">
        <img
          src="{{ Auth::user()->photo ? asset('storage/' . Auth::user()->photo) : 'https://ui-avatars.com/api/?name=' . urlencode(Auth::user()->name) . '&background=0d6efd&color=fff' }}"
          class="profile-avatar me-3" alt="Profile Photo">
        <div>
          <h5 class="mb-0">{{ Auth::user()->name }}</h5>
          <small class="text-muted">{{ Auth::user()->email }}</small>
        </div>
      </div>

      <form action="{{ route('profile.update') }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="row g-3">
          <div class="col-md-6">
            <label class="form-label fw-semibold">Full Name</label>
            <input type="text" name="name" class="form-control" value="{{ old('name', Auth::user()->name) }}" required>
          </div>

          <div class="col-md-6">
            <label class="form-label fw-semibold">Email</label>
            <input type="email" name="email" class="form-control" value="{{ old('email', Auth::user()->email) }}"
              required>
          </div>

          <div class="col-md-6">
            <label class="form-label fw-semibold">School / University</label>
            <input type="text" name="school" class="form-control" value="{{ old('school', Auth::user()->school) }}"
              required>
          </div>

          <div class="col-md-6">
            <label class="form-label fw-semibold">Education Level</label>
            <select name="education_level" class="form-select" required>
              <option value="SMA/SMK" {{ Auth::user()->education_level == 'SMA/SMK' ? 'selected' : '' }}>SMA / SMK
              </option>
              <option value="University" {{ Auth::user()->education_level == 'University' ? 'selected' : '' }}>University
              </option>
              <option value="Other" {{ Auth::user()->education_level == 'Other' ? 'selected' : '' }}>Other</option>
            </select>
          </div>

          <div class="col-md-6">
            <label class="form-label fw-semibold">Phone</label>
            <input type="text" name="phone" class="form-control" value="{{ old('phone', Auth::user()->phone) }}">
          </div>

          <div class="col-md-6">
            <label class="form-label fw-semibold">Profile Photo</label>
            <input type="file" name="photo" accept="image/*" class="form-control">
            <small class="text-muted">Optional - JPG/PNG up to 2MB</small>
          </div>

          <div class="col-12 text-end mt-3">
            <button type="submit" class="btn btn-primary px-4">
              <i class="bi bi-save me-1"></i> Save Changes
            </button>
          </div>
        </div>
      </form>
    </div>
  </div>
  <!-- Logout Confirmation Modal -->
  <div class="modal fade" id="logoutModal" tabindex="-1" aria-labelledby="logoutModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content border-0 shadow">
        <div class="modal-header bg-danger text-white">
          <h5 class="modal-title" id="logoutModalLabel"><i class="bi bi-box-arrow-right me-2"></i>Konfirmasi Logout</h5>
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
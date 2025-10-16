<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Positions - Diskominfo Internship</title>

  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css">
  <!-- DataTables CSS -->
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
      background-color: rgba(255,255,255,0.15);
      border-radius: 6px;
    }
    .content {
      margin-left: 250px;
      padding: 2rem;
    }
    .card {
      border: none;
      border-radius: 12px;
      box-shadow: 0 2px 10px rgba(0,0,0,0.05);
    }
    .navbar {
      background: white;
      border-bottom: 1px solid #dee2e6;
    }
    .modal-content {
      border-radius: 12px;
    }
  </style>
</head>

<body>
  <!-- Sidebar -->
  <div class="sidebar p-3">
    <div>
      <h5 class="fw-bold mb-4 d-flex align-items-center">
        <i class="bi bi-building me-2"></i> Diskominfo Admin
      </h5>
      <ul class="nav flex-column gap-1">
        <li><a href="{{ route('admin.dashboard') }}" class="nav-link"><i class="bi bi-speedometer2 me-2"></i> Dashboard</a></li>
        <li><a href="{{ route('admin.positions') }}" class="nav-link active"><i class="bi bi-briefcase me-2"></i> Positions</a></li>
        <li><a href="{{ route('admin.applicants') }}" class="nav-link"><i class="bi bi-people me-2"></i> Applicants</a></li>
        <li><a href="{{ route('admin.interviews') }}" class="nav-link"><i class="bi bi-calendar-event me-2"></i> Interviews</a></li>
        <li><a href="{{ route('admin.journals') }}" class="nav-link"><i class="bi bi-journal-check me-2"></i> Journals</a></li>
        <li><a href="{{ route('admin.evaluations') }}" class="nav-link"><i class="bi bi-file-earmark-bar-graph me-2"></i> Evaluations</a></li>
        <li><a href="{{ route('admin.certificates') }}" class="nav-link"><i class="bi bi-award me-2"></i> Certificates</a></li>
        <li><a href="{{ route('admin.user') }}" class="nav-link"><i class="bi bi-person-gear me-2"></i> User Management</a></li>
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
    <nav class="navbar navbar-expand-lg navbar-light bg-white mb-4 rounded shadow-sm">
      <div class="container-fluid">
        <span class="navbar-brand mb-0 h5">Manage Internship Positions</span>
        <div class="d-flex align-items-center">
          <span class="me-3 text-muted small">Welcome, {{ Auth::user()->name ?? 'Admin' }}</span>
          <img src="https://ui-avatars.com/api/?name={{ urlencode(Auth::user()->name ?? 'A') }}&background=0d6efd&color=fff" 
               class="rounded-circle" width="40" height="40" alt="Admin Avatar">
        </div>
      </div>
    </nav>

    @if (session('success'))
      <div class="alert alert-success alert-dismissible fade show" role="alert">
        {{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
      </div>
    @endif

    <div class="card p-4">
      <div class="d-flex justify-content-between align-items-center mb-4">
        <h5 class="mb-0"><i class="bi bi-briefcase text-primary me-2"></i>Available Positions</h5>
        <button class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#addPositionModal">
          <i class="bi bi-plus-circle me-1"></i> Add Position
        </button>
      </div>

      <table id="positionTable" class="table table-hover align-middle">
        <thead class="table-light">
          <tr>
            <th>Title</th>
            <th>Department</th>
            <th>Quota</th>
            <th>Deadline</th>
            <th>Status</th>
            <th>Created</th>
            <th class="text-end">Actions</th>
          </tr>
        </thead>
        <tbody>
          @forelse($positions as $position)
          <tr>
            <td>{{ $position->title }}</td>
            <td>{{ $position->department }}</td>
            <td>{{ $position->quota }}</td>
            <td>{{ $position->deadline ?? '-' }}</td>
            <td>
              <span class="badge bg-{{ $position->status === 'open' ? 'success' : 'secondary' }}">
                {{ ucfirst($position->status) }}
              </span>
            </td>
            <td>{{ $position->created_at->format('Y-m-d') }}</td>
            <td class="text-end">
              <button class="btn btn-sm btn-outline-warning" data-bs-toggle="modal" data-bs-target="#editPositionModal{{ $position->id }}">
                <i class="bi bi-pencil"></i>
              </button>
              <form action="{{ route('positions.destroy', $position->id) }}" method="POST" class="d-inline">
                @csrf @method('DELETE')
                <button class="btn btn-sm btn-outline-danger" onclick="return confirm('Delete this position?')">
                  <i class="bi bi-trash"></i>
                </button>
              </form>
            </td>
          </tr>

          <!-- Edit Modal -->
          <div class="modal fade" id="editPositionModal{{ $position->id }}" tabindex="-1">
            <div class="modal-dialog modal-lg modal-dialog-centered">
              <div class="modal-content">
                <div class="modal-header bg-primary text-white">
                  <h5 class="modal-title"><i class="bi bi-pencil-square me-2"></i>Edit Position</h5>
                  <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                </div>
                <form action="{{ route('positions.update', $position->id) }}" method="POST">
                  @csrf @method('PUT')
                  <div class="modal-body">
                    <div class="row g-3">
                      <div class="col-md-6">
                        <label class="form-label">Title</label>
                        <input type="text" name="title" class="form-control" value="{{ $position->title }}" required>
                      </div>
                      <div class="col-md-6">
                        <label class="form-label">Department</label>
                        <input type="text" name="department" class="form-control" value="{{ $position->department }}">
                      </div>
                      <div class="col-md-12">
                        <label class="form-label">Description</label>
                        <textarea name="description" class="form-control" rows="3">{{ $position->description }}</textarea>
                      </div>
                      <div class="col-md-12">
                        <label class="form-label">Requirements</label>
                        <textarea name="requirements" class="form-control" rows="3">{{ $position->requirements }}</textarea>
                      </div>
                      <div class="col-md-4">
                        <label class="form-label">Quota</label>
                        <input type="number" name="quota" class="form-control" value="{{ $position->quota }}">
                      </div>
                      <div class="col-md-4">
                        <label class="form-label">Deadline</label>
                        <input type="date" name="deadline" class="form-control" value="{{ $position->deadline }}">
                      </div>
                      <div class="col-md-4">
                        <label class="form-label">Status</label>
                        <select name="status" class="form-select">
                          <option value="open" {{ $position->status === 'open' ? 'selected' : '' }}>Open</option>
                          <option value="closed" {{ $position->status === 'closed' ? 'selected' : '' }}>Closed</option>
                        </select>
                      </div>
                    </div>
                  </div>
                  <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-primary">Save Changes</button>
                  </div>
                </form>
              </div>
            </div>
          </div>

          @empty
          <tr><td colspan="7" class="text-center text-muted py-4">No positions available.</td></tr>
          @endforelse
        </tbody>
      </table>

      <div class="mt-3">{{ $positions->links('pagination::bootstrap-5') }}</div>
    </div>
  </div>

  <!-- Add Position Modal -->
  <div class="modal fade" id="addPositionModal" tabindex="-1">
    <div class="modal-dialog modal-lg modal-dialog-centered">
      <div class="modal-content">
        <div class="modal-header bg-success text-white">
          <h5 class="modal-title"><i class="bi bi-plus-circle me-2"></i>Add New Position</h5>
          <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
        </div>
        <form action="{{ route('positions.store') }}" method="POST">
          @csrf
          <div class="modal-body">
            <div class="row g-3">
              <div class="col-md-6">
                <label class="form-label">Title</label>
                <input type="text" name="title" class="form-control" required>
              </div>
              <div class="col-md-6">
                <label class="form-label">Department</label>
                <input type="text" name="department" class="form-control" required>
              </div>
              <div class="col-md-12">
                <label class="form-label">Description</label>
                <textarea name="description" class="form-control" rows="3"></textarea>
              </div>
              <div class="col-md-12">
                <label class="form-label">Requirements</label>
                <textarea name="requirements" class="form-control" rows="3"></textarea>
              </div>
              <div class="col-md-4">
                <label class="form-label">Quota</label>
                <input type="number" name="quota" class="form-control" value="1">
              </div>
              <div class="col-md-4">
                <label class="form-label">Deadline</label>
                <input type="date" name="deadline" class="form-control">
              </div>
              <div class="col-md-4">
                <label class="form-label">Status</label>
                <select name="status" class="form-select">
                  <option value="open" selected>Open</option>
                  <option value="closed">Closed</option>
                </select>
              </div>
            </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
            <button type="submit" class="btn btn-success">Create Position</button>
          </div>
        </form>
      </div>
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
  <!-- jQuery + DataTables JS -->
  <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
  <script src="https://cdn.datatables.net/1.13.7/js/jquery.dataTables.min.js"></script>
  <script src="https://cdn.datatables.net/1.13.7/js/dataTables.bootstrap5.min.js"></script>
  <script>
    $(document).ready(function () {
      $('#positionTable').DataTable({
        paging: true,
        searching: true,
        ordering: true,
        info: true,
        pageLength: 10,
        language: {
          search: "Search:",
          lengthMenu: "Show _MENU_ entries per page",
          zeroRecords: "No Position found",
          info: "Showing _START_ to _END_ of _TOTAL_ Position",
          infoEmpty: "No Position available",
          infoFiltered: "(filtered from _MAX_ total entries)"
        },
        columnDefs: [
          { orderable: false, targets: -1 } // disable sort on "Actions" column
        ]
      });
    });
  </script>
</body>
</html>
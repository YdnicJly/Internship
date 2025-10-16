<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Applicants - Diskominfo Internship</title>

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
        <li><a href="{{ route('admin.dashboard') }}" class="nav-link"><i class="bi bi-speedometer2 me-2"></i>
            Dashboard</a></li>
        <li><a href="{{ route('admin.positions') }}" class="nav-link"><i class="bi bi-briefcase me-2"></i> Positions</a>
        </li>
        <li><a href="{{ route('admin.applicants') }}" class="nav-link active"><i class="bi bi-people me-2"></i>
            Applicants</a></li>
        <li><a href="{{ route('admin.interviews') }}" class="nav-link"><i class="bi bi-calendar-event me-2"></i>
            Interviews</a></li>
        <li><a href="{{ route('admin.journals') }}" class="nav-link"><i class="bi bi-journal-check me-2"></i>
            Journals</a></li>
        <li><a href="{{ route('admin.evaluations') }}" class="nav-link"><i
              class="bi bi-file-earmark-bar-graph me-2"></i> Evaluations</a></li>
        <li><a href="{{ route('admin.certificates') }}" class="nav-link"><i class="bi bi-award me-2"></i>
            Certificates</a></li>
        <li><a href="{{ route('admin.user') }}" class="nav-link"><i class="bi bi-person-gear me-2"></i> User
            Management</a></li>
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
    <!-- Top Navbar -->
    <nav class="navbar navbar-expand-lg navbar-light bg-white mb-4 rounded shadow-sm">
      <div class="container-fluid">
        <span class="navbar-brand mb-0 h5">Applicants Management</span>
        <div class="d-flex align-items-center">
          <span class="me-3 text-muted small">Welcome, {{ Auth::user()->name ?? 'Admin' }}</span>
          <img
            src="https://ui-avatars.com/api/?name={{ urlencode(Auth::user()->name ?? 'A') }}&background=0d6efd&color=fff"
            class="rounded-circle" width="40" height="40" alt="Admin Avatar">
        </div>
      </div>
    </nav>

    <!-- Filter + Table -->
    <div class="card p-4">
      <div class="d-flex justify-content-between align-items-center mb-4">
        <h5 class="mb-0"><i class="bi bi-list-task text-primary me-2"></i>All Applicants</h5>
        <form method="GET" class="d-flex gap-2">
          <select name="status" class="form-select" onchange="this.form.submit()">
            <option value="">All Status</option>
            <option value="submitted" {{ request('status') == 'submitted' ? 'selected' : '' }}>Submitted</option>
            <option value="under_review" {{ request('status') == 'under_review' ? 'selected' : '' }}>Under Review</option>
            <option value="interview_scheduled" {{ request('status') == 'interview_scheduled' ? 'selected' : '' }}>
              Interview Scheduled</option>
            <option value="accepted" {{ request('status') == 'accepted' ? 'selected' : '' }}>Accepted</option>
            <option value="rejected" {{ request('status') == 'rejected' ? 'selected' : '' }}>Rejected</option>
          </select>
        </form>
      </div>

      <table id="applicantsTable" class="table table-hover align-middle">

        <thead class="table-light">
          <tr>
            <th>Name</th>
            <th>School / University</th>
            <th>Position</th>
            <th>Duration</th>
            <th>WhatsApp</th>
            <th>Status</th>
            <th>Score</th>
            <th>Applied At</th>
            <th class="text-end">Actions</th>
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
                      <span class="badge bg-{{ 
                          $app->status == 'submitted' ? 'secondary' :
            ($app->status == 'under_review' ? 'warning text-dark' :
              ($app->status == 'interview' ? 'info' :
                ($app->status == 'accepted' ? 'success' : 'danger'))) 
                        }}">
                        {{ str_replace('_', ' ', $app->status) }}
                      </span>
                    </td>
                    <td>{{ $app->selection->score ?? '-' }}</td>
                    <td>{{ $app->created_at->format('Y-m-d') }}</td>
                    <td class="text-end">
                      <button class="btn btn-sm btn-outline-primary" onclick="showApplicantDetail({{ $app->id }})">
                        <i class="bi bi-eye"></i>
                      </button>

                      <button class="btn btn-sm btn-outline-warning" data-bs-toggle="modal"
                        data-bs-target="#editAppModal{{ $app->id }}">
                        <i class="bi bi-pencil"></i>
                      </button>
                      <form action="" method="POST" class="d-inline">
                        @csrf @method('DELETE')
                        <button class="btn btn-sm btn-outline-danger" onclick="return confirm('Delete this Applicant?')">
                          <i class="bi bi-trash"></i>
                        </button>
                      </form>
                    </td>
                  </tr>
          @empty
            <tr>
              <td colspan="9" class="text-center text-muted py-4">No applicants found.</td>
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
          <h5 class="modal-title"><i class="bi bi-box-arrow-right me-2"></i>Logout Confirmation</h5>
          <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
        </div>
        <div class="modal-body">
          Are you sure you want to logout?
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
          <form action="{{ route('logout') }}" method="POST" class="d-inline">
            @csrf
            <button type="submit" class="btn btn-danger">Logout</button>
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
      $('#applicantsTable').DataTable({
        paging: true,
        searching: true,
        ordering: true,
        info: true,
        pageLength: 10,
        language: {
          search: "Search:",
          lengthMenu: "Show _MENU_ entries per page",
          zeroRecords: "No applicants found",
          info: "Showing _START_ to _END_ of _TOTAL_ applicants",
          infoEmpty: "No applicants available",
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
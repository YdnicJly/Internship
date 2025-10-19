<!DOCTYPE html>
<html lang="id">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="icon" type="image/png" href="{{ asset('images/logo.jpg') }}">
  <title>SIMMAGANG</title>

  <!-- Bootstrap & Icons -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css">

  <!-- DataTables -->
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

    .dataTables_wrapper .dataTables_filter input {
      border-radius: 6px;
      border: 1px solid #ced4da;
      padding: 5px 10px;
    }

    .dataTables_length select {
      border-radius: 6px;
      border: 1px solid #ced4da;
      padding: 4px;
    }
      .dataTables_length select {
    border-radius: 6px;
    border: 1px solid #ced4da;
    padding: 5px 30px 5px 10px;
    appearance: none; /* Hilangkan dropdown bawaan */
    background: url("data:image/svg+xml;utf8,<svg fill='gray' height='14' viewBox='0 0 20 20' width='14' xmlns='http://www.w3.org/2000/svg'><path d='M5.516 7.548l4.484 4.482 4.484-4.482a.625.625 0 0 1 .884.884l-5 5a.625.625 0 0 1-.884 0l-5-5a.625.625 0 1 1 .884-.884z'/></svg>") no-repeat right 10px center;
    background-color: #fff;
    background-size: 14px;
    cursor: pointer;
    min-width: 70px;
  }

  /* Supaya dropdown tidak terlalu dekat dengan teks */
  .dataTables_length label {
    display: flex;
    align-items: center;
    gap: 6px;
  }

  .dataTables_wrapper .dataTables_filter input {
    border-radius: 6px;
    border: 1px solid #ced4da;
    padding: 5px 10px;
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
        <li><a href="{{ route('admin.dashboard') }}" class="nav-link "><i class="bi bi-speedometer2 me-2"></i> Beranda</a></li>
        <li><a href="{{ route('admin.positions') }}" class="nav-link"><i class="bi bi-briefcase me-2"></i> Lowongan Magang</a></li>
        <li><a href="{{ route('admin.applicants') }}" class="nav-link"><i class="bi bi-people me-2"></i> Data Pendaftar</a></li>
        <li><a href="{{ route('admin.interviews') }}" class="nav-link"><i class="bi bi-calendar-event me-2"></i> Jadwal Wawancara</a></li>
        <li><a href="{{ route('admin.intern') }}" class="nav-link"><i class="bi bi-journal-check me-2"></i> Data Pemagang</a></li>
        <li><a href="{{ route('admin.user') }}" class="nav-link active"><i class="bi bi-person-gear me-2"></i> Manajemen Pengguna</a></li>
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
        <span class="navbar-brand mb-0 h5">Manajemen Pengguna</span>
        <button class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#addUserModal">
          <i class="bi bi-plus-lg me-1"></i> Tambah Pengguna
        </button>
      </div>
    </nav>

    <div class="card p-4">
      <table id="usersTable" class="table table-striped align-middle">
        <thead class="table-light">
          <tr>
            <th>Nama</th>
            <th>Email</th>
            <th>Peran</th>
            <th class="text-end">Aksi</th>
          </tr>
        </thead>
        <tbody>
          @forelse($users as $user)
            <tr>
              <td>{{ $user->name }}</td>
              <td>{{ $user->email }}</td>
              <td>
                @if($user->role === 'admin')
                  <span class="badge bg-danger">Admin</span>
                @else
                  <span class="badge bg-primary">Mahasiswa</span>
                @endif
              </td>
              <td class="text-end">
                <button class="btn btn-sm btn-outline-warning" data-bs-toggle="modal"
                  data-bs-target="#editUserModal{{ $user->id }}">
                  <i class="bi bi-pencil"></i>
                </button>
                <form action="{{ route('admin.user.destroy', $user->id) }}" method="POST" class="d-inline">
                  @csrf
                  @method('DELETE')
                  <button type="submit" class="btn btn-sm btn-outline-danger"
                    onclick="return confirm('Apakah Anda yakin ingin menghapus pengguna ini?')">
                    <i class="bi bi-trash"></i>
                  </button>
                </form>
              </td>
            </tr>

            <!-- Modal Edit -->
            <div class="modal fade" id="editUserModal{{ $user->id }}" tabindex="-1" aria-hidden="true">
              <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content border-0 shadow">
                  <div class="modal-header bg-warning text-white">
                    <h5 class="modal-title"><i class="bi bi-pencil me-2"></i>Ubah Pengguna</h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                  </div>
                  <form action="{{ route('admin.user.update', $user->id) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="modal-body">
                      <div class="mb-3">
                        <label class="form-label">Nama Lengkap</label>
                        <input type="text" name="name" class="form-control" value="{{ $user->name }}" required>
                      </div>
                      <div class="mb-3">
                        <label class="form-label">Email</label>
                        <input type="email" name="email" class="form-control" value="{{ $user->email }}" required>
                      </div>
                      <div class="mb-3">
                        <label class="form-label">Peran</label>
                        <select name="role" class="form-select" required>
                          <option value="student" @selected($user->role == 'student')>Mahasiswa</option>
                          <option value="admin" @selected($user->role == 'admin')>Admin</option>
                        </select>
                      </div>
                      <div class="mb-3">
                        <label class="form-label">Kata Sandi Baru <small class="text-muted">(biarkan kosong jika tidak
                            diubah)</small></label>
                        <input type="password" name="password" class="form-control" placeholder="Masukkan kata sandi baru">
                      </div>
                    </div>
                    <div class="modal-footer">
                      <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                      <button type="submit" class="btn btn-warning">Simpan Perubahan</button>
                    </div>
                  </form>
                </div>
              </div>
            </div>
          @empty
            <tr>
              <td colspan="4" class="text-center text-muted py-3">Tidak ada pengguna yang ditemukan.</td>
            </tr>
          @endforelse
        </tbody>
      </table>
    </div>
  </div>

  <!-- Modal Tambah -->
  <div class="modal fade" id="addUserModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content border-0 shadow">
        <div class="modal-header bg-primary text-white">
          <h5 class="modal-title"><i class="bi bi-plus-circle me-2"></i>Tambah Pengguna Baru</h5>
          <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
        </div>
        <form action="{{ route('admin.user.store') }}" method="POST">
          @csrf
          <div class="modal-body">
            <div class="mb-3">
              <label class="form-label">Nama Lengkap</label>
              <input type="text" name="name" class="form-control" placeholder="Masukkan nama lengkap" required>
            </div>
            <div class="mb-3">
              <label class="form-label">Email</label>
              <input type="email" name="email" class="form-control" placeholder="Masukkan email" required>
            </div>
            <div class="mb-3">
              <label class="form-label">Kata Sandi</label>
              <input type="password" name="password" class="form-control" placeholder="Masukkan kata sandi" required>
            </div>
            <div class="mb-3">
              <label class="form-label">Peran</label>
              <select name="role" class="form-select" required>
                <option value="student">Mahasiswa</option>
                <option value="admin">Admin</option>
              </select>
            </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
            <button type="submit" class="btn btn-primary">Tambah</button>
          </div>
        </form>
      </div>
    </div>
  </div>

  <!-- Modal Logout -->
  <div class="modal fade" id="logoutModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content border-0 shadow">
        <div class="modal-header bg-danger text-white">
          <h5 class="modal-title"><i class="bi bi-box-arrow-right me-2"></i>Konfirmasi Keluar</h5>
          <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
        </div>
        <div class="modal-body">Apakah Anda yakin ingin keluar dari akun ini?</div>
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

  <!-- JS -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
  <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
  <script src="https://cdn.datatables.net/1.13.7/js/jquery.dataTables.min.js"></script>
  <script src="https://cdn.datatables.net/1.13.7/js/dataTables.bootstrap5.min.js"></script>

  <script>
    $(document).ready(function () {
      $('#usersTable').DataTable({
        paging: true,
        searching: true,
        ordering: true,
        info: true,
        pageLength: 10,
        language: {
          search: "Cari:",
          lengthMenu: "Tampilkan _MENU_ entri per halaman",
          zeroRecords: "Tidak ditemukan data pengguna",
          info: "Menampilkan _START_ sampai _END_ dari _TOTAL_ pengguna",
          infoEmpty: "Tidak ada pengguna tersedia",
          infoFiltered: "(difilter dari total _MAX_ entri)"
        }
      });
    });
  </script>
</body>

</html>

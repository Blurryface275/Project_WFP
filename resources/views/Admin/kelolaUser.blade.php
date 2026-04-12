<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>VitaGuard Admin - Kelola User</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    <style>
        body { font-family: 'Plus Jakarta Sans', sans-serif; background-color: #f8fafc; }
        .navbar { background: white; box-shadow: 0 2px 10px rgba(0,0,0,0.05); }
        .card { border: none; border-radius: 20px; box-shadow: 0 5px 25px rgba(0,0,0,0.03); overflow: hidden; }
        .table thead th { background-color: #f1f5f9; border-bottom: none; color: #64748b; font-weight: 600; text-transform: uppercase; font-size: 0.75rem; padding: 15px; }
        .table td { vertical-align: middle; padding: 15px; color: #1e293b; }
        .badge-admin { background: #e0f2fe; color: #0369a1; }
        .badge-doctor { background: #fef3c7; color: #92400e; }
        .badge-member { background: #dcfce7; color: #166534; }
        .btn-action { width: 32px; height: 32px; padding: 0; display: inline-flex; align-items: center; justify-content: center; border-radius: 8px; margin-right: 5px; }
    </style>
</head>
<body>

<nav class="navbar navbar-expand-lg py-3">
    <div class="container">
        <a class="navbar-brand fw-bold text-primary fs-4" href="#">VitaGuard <span class="text-muted fw-normal fs-6">Admin</span></a>
        <div class="d-flex align-items-center">
            <span class="me-3 d-none d-md-inline text-muted">Halo, <strong>Admin</strong></span>
            <form action="{{ route('logout') }}" method="POST">
                @csrf
                <button type="submit" class="btn btn-outline-danger btn-sm px-3 rounded-pill">Logout</button>
            </form>
        </div>
    </div>
</nav>

<div class="container py-5">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h2 class="fw-bold mb-1">Kelola Data User</h2>
            <p class="text-muted">Administrator dapat mengelola akses Dokter, Admin, dan Member.</p>
        </div>
        <div class="d-flex gap-2">
            <a href="#" class="btn btn-outline-secondary px-4 py-2 rounded-3 shadow-sm border-2 fw-semibold">
                <i class="bi bi-file-earmark-bar-graph me-2"></i> Laporan Aktivitas
            </a>
            <button class="btn btn-primary px-4 py-2 rounded-3 shadow-sm fw-semibold" data-bs-toggle="modal" data-bs-target="#modalAdd">
                <i class="bi bi-plus-lg me-2"></i> Tambah User
            </button>
        </div>
    </div>

    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show rounded-4 border-0 mb-4" role="alert">
            <i class="bi bi-check-circle-fill me-2"></i> {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    @if(session('error'))
        <div class="alert alert-danger alert-dismissible fade show rounded-4 border-0 mb-4" role="alert">
            <i class="bi bi-exclamation-circle-fill me-2"></i> {{ session('error') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <div class="card p-2">
        <div class="table-responsive">
            <table class="table table-hover mb-0">
                <thead>
                    <tr>
                        <th class="ps-4">ID</th>
                        <th>Nama Pengguna</th>
                        <th>Email</th>
                        <th>Peran / Role</th>
                        <th class="pe-4">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($users as $u)
                    <tr>
                        <td class="ps-4 fw-bold text-muted">#{{ $u->id }}</td>
                        <td class="fw-semibold">{{ $u->name }}</td>
                        <td>{{ $u->email }}</td>
                        <td>
                            <span class="badge rounded-pill px-3 py-2 {{ $u->role == 'admin' ? 'badge-admin' : ($u->role == 'doctor' ? 'badge-doctor' : 'badge-member') }}">
                                {{ ucfirst($u->role) }}
                            </span>
                        </td>
                        <td class="pe-4">
                            <button class="btn btn-warning btn-action text-white" 
                                    data-bs-toggle="modal" 
                                    data-bs-target="#modalEdit{{ $u->id }}">
                                <i class="bi bi-pencil-square"></i>
                            </button>
                            <button class="btn btn-danger btn-action" 
                                    data-bs-toggle="modal" 
                                    data-bs-target="#modalDelete{{ $u->id }}">
                                <i class="bi bi-trash"></i>
                            </button>
                        </td>
                    </tr>

                    <!-- Modal Edit -->
                    <div class="modal fade" id="modalEdit{{ $u->id }}" tabindex="-1">
                        <div class="modal-dialog modal-dialog-centered">
                            <form action="{{ route('admin.kelolaUser.update', $u->id) }}" method="POST">
                                @csrf
                                @method('PUT')
                                <div class="modal-content rounded-4 border-0">
                                    <div class="modal-header border-0 pb-0">
                                        <h5 class="fw-bold">Edit Informasi User</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                    </div>
                                    <div class="modal-body">
                                        <div class="mb-3">
                                            <label class="form-label">Nama Lengkap</label>
                                            <input type="text" name="name" class="form-control rounded-3" value="{{ $u->name }}" required>
                                        </div>
                                        <div class="mb-3">
                                            <label class="form-label">Alamat Email</label>
                                            <input type="email" name="email" class="form-control rounded-3" value="{{ $u->email }}" required>
                                        </div>
                                        <div class="mb-3">
                                            <label class="form-label">Role Pengguna</label>
                                            <select name="role" class="form-select rounded-3" required>
                                                <option value="member" {{ $u->role == 'member' ? 'selected' : '' }}>Member</option>
                                                <option value="doctor" {{ $u->role == 'doctor' ? 'selected' : '' }}>Dokter</option>
                                                <option value="admin" {{ $u->role == 'admin' ? 'selected' : '' }}>Admin</option>
                                            </select>
                                        </div>
                                        <div class="mb-1">
                                            <label class="form-label">Reset Password</label>
                                            <input type="password" name="password" class="form-control rounded-3" placeholder="Isi hanya jika ingin ganti password">
                                        </div>
                                    </div>
                                    <div class="modal-footer border-0">
                                        <button type="button" class="btn btn-light rounded-3 px-4" data-bs-dismiss="modal">Batal</button>
                                        <button type="submit" class="btn btn-primary rounded-3 px-4 shadow-sm">Simpan Perubahan</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>

                    <!-- Modal Delete -->
                    <div class="modal fade" id="modalDelete{{ $u->id }}" tabindex="-1">
                        <div class="modal-dialog modal-sm modal-dialog-centered">
                            <form action="{{ route('admin.kelolaUser.destroy', $u->id) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <div class="modal-content rounded-4 border-0">
                                    <div class="modal-body text-center p-4">
                                        <i class="bi bi-trash3 text-danger fs-1 mb-3 d-block"></i>
                                        <h5 class="fw-bold">Konfirmasi Hapus</h5>
                                        <p class="text-muted small">Anda akan menghapus akun <strong>{{ $u->name }}</strong>. Tindakan ini permanen.</p>
                                        <div class="d-grid gap-2 mt-4">
                                            <button type="submit" class="btn btn-danger rounded-3 py-2 fw-bold">Ya, Hapus Akun</button>
                                            <button type="button" class="btn btn-light rounded-3 py-2" data-bs-dismiss="modal">Batalkan</button>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>

                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>

<!-- Modal Add -->
<div class="modal fade" id="modalAdd" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
        <form action="{{ route('admin.kelolaUser.store') }}" method="POST">
            @csrf
            <div class="modal-content rounded-4 border-0 shadow-lg">
                <div class="modal-header border-0 pb-0">
                    <h5 class="fw-bold">Tambah Pengguna Baru</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label class="form-label">Nama Lengkap</label>
                        <input type="text" name="name" class="form-control rounded-3" placeholder="Masukan nama lengkap" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Alamat Email</label>
                        <input type="email" name="email" class="form-control rounded-3" placeholder="email@contoh.com" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Set Role</label>
                        <select name="role" class="form-select rounded-3" required>
                            <option value="member" selected>Member (Pasien)</option>
                            <option value="doctor">Dokter (Staff Medis)</option>
                            <option value="admin">Admin (Staff Sistem)</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Password</label>
                        <input type="password" name="password" class="form-control rounded-3" placeholder="Minimal 8 karakter" required minlength="8">
                    </div>
                </div>
                <div class="modal-footer border-0">
                    <button type="button" class="btn btn-light rounded-3 px-4" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-primary rounded-3 px-4 shadow-sm">Simpan User</button>
                </div>
            </div>
        </form>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

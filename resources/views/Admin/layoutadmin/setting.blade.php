@extends('admin.layoutadmin.main')

@section('content')
<div class="content-wrapper">
    <!-- Content Header -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Settings Management</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Home</a></li>
                        <li class="breadcrumb-item active">Settings</li>
                    </ol>
                </div>
            </div>
        </div>
    </section>

    <!-- Main Content -->
    <section class="content">
        <div class="container-fluid">
            <!-- Tab Navigation -->
            <ul class="nav nav-tabs mb-3" id="settingsTabs" role="tablist">
                <li class="nav-item">
                    <a class="nav-link active" id="user-tab" data-toggle="tab" href="#user-content" role="tab">
                        <i class="fas fa-user-friends mr-1"></i> Daftar User
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" id="admin-tab" data-toggle="tab" href="#admin-content" role="tab">
                        <i class="fas fa-user-shield mr-1"></i> Daftar Admin
                    </a>
                </li>
            </ul>

            <!-- Tab Content -->
            <div class="tab-content" id="settingsTabsContent">
                
                <!-- Daftar User -->
                <div class="tab-pane fade show active" id="user-content" role="tabpanel">
                    <div class="card card-blue">
                        <div class="card-header">
                            <h3 class="card-title">
                                <i class="fas fa-user-friends mr-2"></i>
                                Daftar Akun User
                            </h3>
                            <div class="card-tools">
                                <button class="btn btn-success btn-sm" data-toggle="modal" data-target="#addUserModal">
                                    <i class="fas fa-plus"></i> Tambah User
                                </button>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table id="userTable" class="table table-bordered table-striped">
                                    <thead>
                                        <tr>
                                            <th>ID</th>
                                            <th>Foto</th>
                                            <th>Nama</th>
                                            <th>Email</th>
                                            <th>Telepon</th>
                                            <th>Status</th>
                                            <th>Tanggal Daftar</th>
                                            <th width="100">Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>USR001</td>
                                            <td>
                                                <img src="https://via.placeholder.com/40" class="user-avatar" alt="User Avatar">
                                            </td>
                                            <td>John Doe</td>
                                            <td>john@example.com</td>
                                            <td>08123456789</td>
                                            <td><span class="badge badge-success">Aktif</span></td>
                                            <td>2024-01-15</td>
                                            <td>
                                                <button class="btn btn-info btn-sm" title="Edit">
                                                    <i class="fas fa-edit"></i>
                                                </button>
                                                <button class="btn btn-danger btn-sm" title="Hapus">
                                                    <i class="fas fa-trash"></i>
                                                </button>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>USR002</td>
                                            <td>
                                                <img src="https://via.placeholder.com/40" class="user-avatar" alt="User Avatar">
                                            </td>
                                            <td>Jane Smith</td>
                                            <td>jane@example.com</td>
                                            <td>08129876543</td>
                                            <td><span class="badge badge-warning">Tidak Aktif</span></td>
                                            <td>2024-01-10</td>
                                            <td>
                                                <button class="btn btn-info btn-sm" title="Edit">
                                                    <i class="fas fa-edit"></i>
                                                </button>
                                                <button class="btn btn-success btn-sm" title="Aktifkan">
                                                    <i class="fas fa-check"></i>
                                                </button>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Daftar Admin -->
                <div class="tab-pane fade" id="admin-content" role="tabpanel">
                    <div class="card card-blue">
                        <div class="card-header">
                            <h3 class="card-title">
                                <i class="fas fa-user-shield mr-2"></i>
                                Daftar Akun Admin
                            </h3>
                            <div class="card-tools">
                                <button class="btn btn-success btn-sm" data-toggle="modal" data-target="#addAdminModal">
                                    <i class="fas fa-plus"></i> Tambah Admin
                                </button>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table id="adminTable" class="table table-bordered table-striped">
                                    <thead>
                                        <tr>
                                            <th>ID</th>
                                            <th>Foto</th>
                                            <th>Nama</th>
                                            <th>Email</th>
                                            <th>Role</th>
                                            <th>Status</th>
                                            <th>Terakhir Login</th>
                                            <th width="100">Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>ADM001</td>
                                            <td>
                                                <img src="https://via.placeholder.com/40" class="user-avatar" alt="Admin Avatar">
                                            </td>
                                            <td>Super Admin</td>
                                            <td>superadmin@fanesya.com</td>
                                            <td><span class="badge badge-danger">Super Admin</span></td>
                                            <td><span class="badge badge-success">Aktif</span></td>
                                            <td>2024-01-20 14:30</td>
                                            <td>
                                                <button class="btn btn-info btn-sm" title="Edit">
                                                    <i class="fas fa-edit"></i>
                                                </button>
                                                <button class="btn btn-warning btn-sm" title="Reset Password">
                                                    <i class="fas fa-key"></i>
                                                </button>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>ADM002</td>
                                            <td>
                                                <img src="https://via.placeholder.com/40" class="user-avatar" alt="Admin Avatar">
                                            </td>
                                            <td>Content Manager</td>
                                            <td>content@fanesya.com</td>
                                            <td><span class="badge badge-warning">Content Manager</span></td>
                                            <td><span class="badge badge-success">Aktif</span></td>
                                            <td>2024-01-19 10:15</td>
                                            <td>
                                                <button class="btn btn-info btn-sm" title="Edit">
                                                    <i class="fas fa-edit"></i>
                                                </button>
                                                <button class="btn btn-warning btn-sm" title="Reset Password">
                                                    <i class="fas fa-key"></i>
                                                </button>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>

<!-- Modal Tambah User -->
<div class="modal fade" id="addUserModal" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Tambah User Baru</h5>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body">
                <form>
                    <div class="form-group">
                        <label>Nama Lengkap</label>
                        <input type="text" class="form-control" placeholder="Masukkan nama lengkap">
                    </div>
                    <div class="form-group">
                        <label>Email</label>
                        <input type="email" class="form-control" placeholder="Masukkan email">
                    </div>
                    <div class="form-group">
                        <label>Password</label>
                        <input type="password" class="form-control" placeholder="Masukkan password">
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                <button type="button" class="btn btn-primary">Simpan</button>
            </div>
        </div>
    </div>
</div>

<!-- Modal Tambah Admin -->
<div class="modal fade" id="addAdminModal" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Tambah Admin Baru</h5>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body">
                <form>
                    <div class="form-group">
                        <label>Nama Admin</label>
                        <input type="text" class="form-control" placeholder="Masukkan nama admin">
                    </div>
                    <div class="form-group">
                        <label>Email</label>
                        <input type="email" class="form-control" placeholder="Masukkan email">
                    </div>
                    <div class="form-group">
                        <label>Role</label>
                        <select class="form-control">
                            <option value="superadmin">Super Admin</option>
                            <option value="content">Content Manager</option>
                            <option value="support">Support</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Password</label>
                        <input type="password" class="form-control" placeholder="Masukkan password">
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                <button type="button" class="btn btn-primary">Simpan</button>
            </div>
        </div>
    </div>
</div>

@section('scripts')
<script>
    $(document).ready(function() {
        // Initialize DataTables
        $('#userTable').DataTable({
            "responsive": true,
            "autoWidth": false,
            "language": {
                "url": "//cdn.datatables.net/plug-ins/1.13.6/i18n/id.json"
            }
        });

        $('#adminTable').DataTable({
            "responsive": true,
            "autoWidth": false,
            "language": {
                "url": "//cdn.datatables.net/plug-ins/1.13.6/i18n/id.json"
            }
        });
    });
</script>
@endsection
@endsection
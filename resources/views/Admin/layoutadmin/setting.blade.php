@extends('admin.layoutadmin.main')

@section('content')
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
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table id="userTable" class="table table-bordered table-striped">
                                    <thead>
                                        <tr>
                                            <th>ID</th>
                                            <th>Nama</th>
                                            <th>Email</th>
                                            <th>Tanggal Daftar</th>
                                            <th width="100">Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($users as $user)
                                        <tr>
                                            <td>{{ $user->id }}</td>
                                            <td>{{ $user->name }}</td>
                                            <td>{{ $user->email }}</td>
                                            <td>{{ $user->created_at->format('Y-m-d') }}</td>
                                            <td>
                                                <button class="btn btn-info btn-sm" title="Edit">
                                                    <i class="fas fa-edit"></i>
                                                </button>
                                                <button class="btn btn-danger btn-sm" title="Hapus">
                                                    <i class="fas fa-trash"></i>
                                                </button>
                                            </td>
                                        </tr>
                                        @endforeach
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
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table id="adminTable" class="table table-bordered table-striped">
                                    <thead>
                                        <tr>
                                            <th>ID</th>
                                            <th>Nama</th>
                                            <th>Username</th>
                                            <th>Email</th>
                                            <th>Terakhir Login</th>
                                            <th width="100">Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($admins as $admin)
                                        <tr>
                                            <td>{{ $admin->id }}</td>
                                            <td>{{ $admin->name }}</td>
                                            <td>{{ $admin->username }}</td>
                                            <td>{{ $admin->email }}</td>
                                            <td>{{ $admin->last_login ? $admin->last_login->format('Y-m-d H:i') : '-' }}</td>
                                            <td>
                                                <button class="btn btn-info btn-sm" title="Edit">
                                                    <i class="fas fa-edit"></i>
                                                </button>
                                                <button class="btn btn-warning btn-sm" title="Reset Password">
                                                    <i class="fas fa-key"></i>
                                                </button>
                                            </td>
                                        </tr>
                                        @endforeach
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
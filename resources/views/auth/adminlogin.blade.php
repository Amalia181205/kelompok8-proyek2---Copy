<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Login - Fanesya Photo</title>
    
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    <!-- Bootstrap 4 -->
    <link rel="stylesheet" href="{{ asset('adminlte/adminlte/plugins/bootstrap/css/bootstrap.min.css') }}">
    
    <!-- Theme style -->
    <link rel="stylesheet" href="{{ asset('adminlte/adminlte/dist/css/adminlte.min.css') }}">

    <style>
        .admin-login-page {
            background: linear-gradient(135deg, #6c757d 0%, #495057 100%);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 20px;
        }
        
        .admin-login-box {
            width: 100%;
            max-width: 400px;
        }
        
        .admin-login-logo {
            font-size: 2.5rem;
            font-weight: 300;
            margin-bottom: 2rem;
        }
        
        .admin-login-card {
            border-radius: 15px;
            box-shadow: 0 10px 30px rgba(0,0,0,0.3);
            border: none;
            background: #fff;
        }
        
        .admin-login-card-body {
            padding: 2.5rem;
        }
        
        .admin-badge {
            background: #5435dc;
            color: white;
            padding: 5px 15px;
            border-radius: 20px;
            font-size: 12px;
            font-weight: bold;
            position: absolute;
            top: -10px;
            right: 20px;
        }
        
        .btn-admin {
            padding: 12px;
            font-weight: 600;
            border-radius: 8px;
            background: #6c757d;
            border-color: #6c757d;
        }
        
        .btn-admin:hover {
            background: #5a6268;
            border-color: #545b62;
        }
        
        .input-group-text {
            background: #f8f9fa;
            border-right: none;
        }
        
        .form-control {
            border-left: none;
            padding: 12px;
        }
        
        .form-control:focus {
            box-shadow: none;
            border-color: #ced4da;
        }
        
        .back-to-user {
            text-align: center;
            margin-top: 20px;
            padding-top: 20px;
            border-top: 1px solid #e9ecef;
        }
    </style>
</head>
<body class="admin-login-page">
    <div class="admin-login-box">
        <!-- Logo -->
        <div class="admin-login-logo text-center">
            <a href="/" class="text-white">
                <i class="fas fa-camera"></i>
                <b>Fanesya</b> Photo
                <br>
                <small class="text-light">Admin Panel</small>
            </a>
        </div>

        <!-- Login Card -->
        <div class="card admin-login-card position-relative">
            <div class="admin-badge">ADMIN</div>
            <div class="card-body admin-login-card-body">
                <h4 class="text-center mb-4 text-dark">
                    <i class="fas fa-lock mr-2"></i>Admin Access
                </h4>

                <!-- Error Messages -->
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <i class="fas fa-exclamation-circle mr-2"></i>
                        <strong>Login failed!</strong>
                        <ul class="mb-0 mt-2">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                @if (session('success'))
                    <div class="alert alert-success">
                        <i class="fas fa-check-circle mr-2"></i>
                        {{ session('success') }}
                    </div>
                @endif

                <!-- Login Form -->
                <form action="{{ url('/admin/login') }}" method="post">
                    @csrf
                    
                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text">
                                <i class="fas fa-envelope"></i>
                            </span>
                        </div>
                        <input type="email" name="email" class="form-control" placeholder="Admin Email" 
                               value="{{ old('email') }}" required autofocus>
                    </div>
                    
                    <div class="input-group mb-4">
                        <div class="input-group-prepend">
                            <span class="input-group-text">
                                <i class="fas fa-lock"></i>
                            </span>
                        </div>
                        <input type="password" name="password" class="form-control" placeholder="Password" required>
                    </div>
                    
                    <div class="row mb-3">
                        <div class="col-12">
                            <div class="icheck-primary">
                                <input type="checkbox" id="remember" name="remember" {{ old('remember') ? 'checked' : '' }}>
                                <label for="remember">Remember me</label>
                            </div>
                        </div>
                    </div>
                    
                    <button type="submit" class="btn btn-admin btn-block">
                        <i class="fas fa-sign-in-alt mr-2"></i> Login as Admin
                    </button>
                </form>

                <!-- Back to User Login -->
                <div class="back-to-user">
                    <p class="mb-0">
                        <a href="{{ url('/auth') }}" class="text-muted">
                            <i class="fas fa-arrow-left mr-1"></i> Back to User Login
                        </a>
                    </p>
                </div>
            </div>
        </div>
    </div>

    <!-- jQuery -->
    <script src="{{ asset('adminlte/adminlte/plugins/jquery/jquery.min.js') }}"></script>
    <!-- Bootstrap 4 -->
    <script src="{{ asset('adminlte/adminlte/plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <!-- AdminLTE App -->
    <script src="{{ asset('adminlte/adminlte/dist/js/adminlte.min.js') }}"></script>
</body>
</html>
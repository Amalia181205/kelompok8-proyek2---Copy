<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login & Register - Fanesya Photo</title>
    
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    <!-- Bootstrap 4 -->
    <link rel="stylesheet" href="{{ asset('adminlte/adminlte/plugins/bootstrap/css/bootstrap.min.css') }}">
    
    <!-- Theme style -->
    <link rel="stylesheet" href="{{ asset('adminlte/adminlte/dist/css/adminlte.min.css') }}">

    <style>
        .auth-page {
            background: linear-gradient(135deg, #007bff 0%, #0056b3 100%);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 20px;
        }
        
        .auth-box {
            width: 100%;
            max-width: 400px;
        }
        
        .auth-logo {
            font-size: 2.5rem;
            font-weight: 300;
            margin-bottom: 2rem;
        }
        
        .auth-card {
            border-radius: 15px;
            box-shadow: 0 10px 30px rgba(0,0,0,0.2);
            border: none;
        }
        
        .auth-card-body {
            padding: 2rem;
        }
    </style>
</head>
<body class="auth-page">
    <div class="auth-box">
        <!-- Logo -->
        <div class="auth-logo text-center">
            <a href="/" class="text-white">
                <i class="fas fa-camera"></i>
                <b>Fanesya</b> Photo
            </a>
        </div>

        <!-- Auth Card -->
        <div class="card auth-card">
            <div class="card-body auth-card-body">
                <!-- Tabs Navigation -->
                <ul class="nav nav-tabs nav-justified" id="authTabs" role="tablist">
                    <li class="nav-item">
                        <a class="nav-link active" id="login-tab" data-toggle="tab" href="#login" role="tab" aria-controls="login" aria-selected="true">
                            <i class="fas fa-sign-in-alt mr-2"></i> Login
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="register-tab" data-toggle="tab" href="#register" role="tab" aria-controls="register" aria-selected="false">
                            <i class="fas fa-user-plus mr-2"></i> Register
                        </a>
                    </li>
                </ul>

                <!-- Tab Content -->
                <div class="tab-content" id="authTabsContent">
                    
                    <!-- Login Tab -->
                    <div class="tab-pane fade show active" id="login" role="tabpanel" aria-labelledby="login-tab">
                        <h5 class="text-center mb-4 text-dark">Sign in to your account</h5>

                        @if ($errors->any() && (!old('form_type') || old('form_type') === 'login'))
                            <div class="alert alert-danger">
                                @foreach ($errors->all() as $error)
                                    <div>{{ $error }}</div>
                                @endforeach
                            </div>
                        @endif

                        <!-- Login Form -->
                        <form action="{{ url('/login') }}" method="POST">
                            @csrf <!-- PASTIKAN INI ADA -->
                            <input type="hidden" name="form_type" value="login">
                            
                            <div class="form-group mb-3">
                                <label for="login-email">Email</label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">
                                            <i class="fas fa-envelope"></i>
                                        </span>
                                    </div>
                                    <input type="email" name="email" id="login-email" class="form-control" placeholder="Email address" 
                                           value="{{ old('email') }}" required autofocus>
                                </div>
                            </div>
                            
                            <div class="form-group mb-4">
                                <label for="login-password">Password</label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">
                                            <i class="fas fa-lock"></i>
                                        </span>
                                    </div>
                                    <input type="password" name="password" id="login-password" class="form-control" placeholder="Password" required>
                                </div>
                            </div>
                            
                            <!-- <div class="form-group mb-3">
                                <div class="form-check">
                                    <input type="checkbox" id="remember" name="remember" class="form-check-input" {{ old('remember') ? 'checked' : '' }}>
                                    <label for="remember" class="form-check-label">Remember me</label>
                                </div>
                            </div> -->
                            
                            <button type="submit" class="btn btn-primary btn-block" style="padding: 12px; font-weight: 600;">
                                <i class="fas fa-sign-in-alt mr-2"></i> Sign In
                            </button>
                        </form>

                        <div class="text-center mt-3">
                            <p class="mb-0">Don't have an account? 
                                <a href="javascript:void(0)" onclick="switchToRegister()">Create one here</a>
                            </p>
                        </div>
                    </div>

                    <!-- Register Tab -->
                    <div class="tab-pane fade" id="register" role="tabpanel" aria-labelledby="register-tab">
                        <h5 class="text-center mb-4 text-dark">Create new account</h5>

                        @if ($errors->any() && old('form_type') === 'register')
                            <div class="alert alert-danger">
                                @foreach ($errors->all() as $error)
                                    <div>{{ $error }}</div>
                                @endforeach
                            </div>
                        @endif

                        <!-- Register Form -->
                        <form action="{{ url('/register') }}" method="POST">
                            @csrf <!-- PASTIKAN INI ADA -->
                            <input type="hidden" name="form_type" value="register">
                            
                            <div class="form-group mb-3">
                                <label for="register-name">Full Name</label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">
                                            <i class="fas fa-user"></i>
                                        </span>
                                    </div>
                                    <input type="text" name="name" id="register-name" class="form-control" placeholder="Full name" 
                                           value="{{ old('name') }}" required>
                                </div>
                            </div>
                            
                            <div class="form-group mb-3">
                                <label for="register-email">Email</label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">
                                            <i class="fas fa-envelope"></i>
                                        </span>
                                    </div>
                                    <input type="email" name="email" id="register-email" class="form-control" placeholder="Email address" 
                                           value="{{ old('email') }}" required>
                                </div>
                            </div>
                            
                            <div class="form-group mb-3">
                                <label for="register-password">Password</label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">
                                            <i class="fas fa-lock"></i>
                                        </span>
                                    </div>
                                    <input type="password" name="password" id="register-password" class="form-control" placeholder="Password" required>
                                </div>
                            </div>
                            
                            <div class="form-group mb-4">
                                <label for="register-password-confirm">Confirm Password</label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">
                                            <i class="fas fa-lock"></i>
                                        </span>
                                    </div>
                                    <input type="password" name="password_confirmation" id="register-password-confirm" class="form-control" placeholder="Confirm password" required>
                                </div>
                            </div>
                            
                            <div class="form-group mb-4">
                                <div class="form-check">
                                    <input type="checkbox" id="agreeTerms" name="terms" class="form-check-input" value="agree" required>
                                    <label for="agreeTerms" class="form-check-label">
                                        I agree to the <a href="#">terms and conditions</a>
                                    </label>
                                </div>
                            </div>
                            
                            <button type="submit" class="btn btn-success btn-block" style="padding: 12px; font-weight: 600;">
                                <i class="fas fa-user-plus mr-2"></i> Create Account
                            </button>
                        </form>

                        <div class="text-center mt-3">
                            <p class="mb-0">Already have an account? 
                                <a href="javascript:void(0)" onclick="switchToLogin()">Sign in here</a>
                            </p>
                        </div>
                    </div>
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

    <script>
        function switchToRegister() {
            $('#register-tab').tab('show');
        }
        
        function switchToLogin() {
            $('#login-tab').tab('show');
        }

        @if($errors->any() && old('form_type') === 'register')
            $(document).ready(function() {
                $('#register-tab').tab('show');
            });
        @endif
    </script>
</body>
</html>
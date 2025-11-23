<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register - Fanesya Photo</title>
    
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    <!-- Bootstrap 4 -->
    <link rel="stylesheet" href="{{ asset('adminlte/adminlte/plugins/bootstrap/css/bootstrap.min.css') }}">
    
    <!-- Theme style -->
    <link rel="stylesheet" href="{{ asset('adminlte/adminlte/dist/css/adminlte.min.css') }}">

    <style>
        .register-page {
            background: linear-gradient(135deg, #007bff 0%, #0056b3 100%);
            min-height: 100vh;
            display: flex;
            align-items: center;
        }
        
        .register-box {
            width: 400px;
        }
        
        .register-logo {
            font-size: 2.5rem;
            font-weight: 300;
            margin-bottom: 1rem;
        }
        
        .register-card-body {
            border-radius: 10px;
            box-shadow: 0 10px 25px rgba(0,0,0,0.1);
        }
    </style>
</head>
<body class="register-page">
    <div class="register-box">
        <div class="register-logo text-center">
            <a href="#" class="text-white">
                <i class="fas fa-camera"></i>
                <b>Fanesya</b> Photo
            </a>
        </div>

        <div class="card register-card-body">
            <div class="card-body register-card-body">
                <p class="login-box-msg">Register a new membership</p>

                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul class="mb-0">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                @if (session('success'))
                    <div class="alert alert-success">
                        {{ session('success') }}
                    </div>
                @endif

                <form action="{{ url('/register') }}" method="post">
                    @csrf
                    <div class="input-group mb-3">
                        <input type="text" name="name" class="form-control" placeholder="Full name" 
                               value="{{ old('name') }}" required autofocus>
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-user"></span>
                            </div>
                        </div>
                    </div>
                    <div class="input-group mb-3">
                        <input type="email" name="email" class="form-control" placeholder="Email" 
                               value="{{ old('email') }}" required>
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-envelope"></span>
                            </div>
                        </div>
                    </div>
                    <div class="input-group mb-3">
                        <input type="password" name="password" class="form-control" placeholder="Password" required>
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-lock"></span>
                            </div>
                        </div>
                    </div>
                    <div class="input-group mb-3">
                        <input type="password" name="password_confirmation" class="form-control" placeholder="Retype password" required>
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-lock"></span>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-8">
                            <div class="icheck-primary">
                                <input type="checkbox" id="agreeTerms" name="terms" value="agree" required>
                                <label for="agreeTerms">
                                    I agree to the <a href="#">terms</a>
                                </label>
                            </div>
                        </div>
                        <div class="col-4">
                            <button type="submit" class="btn btn-primary btn-block">
                                <i class="fas fa-user-plus"></i> Register
                            </button>
                        </div>
                    </div>
                </form>

                <p class="mb-0 mt-3 text-center">
                    <a href="{{ url('/login') }}" class="text-center">I already have a membership</a>
                </p>
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
@extends('bagianAwal.main')

@section('title', 'Register - FotoStudio')

@section('content')

<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card shadow-sm">
                <div class="card-body p-5">
                    <h2 class="text-center mb-4" style="color: #00aaff;">Create Account</h2>

                    @if($errors->any())
                        <div class="alert alert-danger">
                            <ul class="mb-0">
                                @foreach($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <form method="POST" action="{{ url('/register') }}">
                        @csrf
                        <div class="mb-3">
                            <label for="name" class="form-label">Full Name</label>
                            <input type="text" class="form-control" id="name" name="name" value="{{ old('name') }}" required>
                        </div>

                        <div class="mb-3">
                            <label for="email" class="form-label">Email Address</label>
                            <input type="email" class="form-control" id="email" name="email" value="{{ old('email') }}" required>
                        </div>

                        <div class="mb-3">
                            <label for="password" class="form-label">Password</label>
                            <input type="password" class="form-control" id="password" name="password" required>
                        </div>

                        <div class="mb-4">
                            <label for="password_confirmation" class="form-label">Confirm Password</label>
                            <input type="password" class="form-control" id="password_confirmation" name="password_confirmation" required>
                        </div>

                        <button type="submit" class="btn w-100 mb-3" style="background-color: #00aaff; color: white; border-radius: 30px; padding: 10px;">
                            Register
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
    .form-control { border-radius: 8px; padding: 10px 15px; }
    .form-control:focus { border-color: #00aaff; box-shadow: 0 0 0 0.2rem rgba(0,170,255,0.15); }
    .card { border-radius: 15px; border: none; }
</style>

@endsection

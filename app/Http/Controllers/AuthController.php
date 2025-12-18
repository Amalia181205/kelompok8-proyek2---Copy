<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Admin;

class AuthController extends Controller
{
    // ==================== SHOW FORMS ====================

    // Form login + register user
    public function showLoginRegister()
    {
        return view('auth.loginregister');
    }

    // Form login admin
    public function showAdminLogin()
    {
        return view('auth.adminlogin');
    }

    // ==================== LOGIN USER ====================

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email'    => 'required|email',
            'password' => 'required|string',
        ]);

        $remember = $request->boolean('remember');

        if (Auth::attempt($credentials, $remember)) {
            $request->session()->regenerate();
            return redirect()->intended('/')
                ->with('success', 'Welcome back!');
        }

        return redirect('/auth')
            ->withErrors(['email' => 'Email atau password salah'])
            ->withInput()
            ->with('form_type', 'login');
    }

    // ==================== LOGIN ADMIN ====================

    public function adminLogin(Request $request)
    {
        $credentials = $request->validate([
            'email'    => 'required|email',
            'password' => 'required|string',
        ]);

        $remember = $request->boolean('remember');

        if (Auth::guard('admin')->attempt($credentials, $remember)) {
            $request->session()->regenerate();
            return redirect()->intended('/admin/dashboard')
                ->with('success', 'Welcome back, Admin!');
        }

        return redirect('/admin/login')
            ->withErrors(['email' => 'Email atau password admin salah'])
            ->withInput();
    }

    // ==================== REGISTER USER ====================

    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name'     => 'required|string|max:255',
            'email'    => 'required|email|max:255|unique:users,email',
            'password' => 'required|string|min:6|confirmed',
        ]);

        if ($validator->fails()) {
            return redirect('/auth')
                ->withErrors($validator)
                ->withInput()
                ->with('form_type', 'register');
        }

        $user = User::create([
            'name'     => $request->name,
            'email'    => $request->email,
            'password' => Hash::make($request->password),
        ]);

        Auth::login($user);

        return redirect('/')
            ->with('success', 'Account created successfully!');
    }

    // ==================== LOGOUT (USER & ADMIN) ====================

    public function logout(Request $request)
    {
        if (Auth::guard('admin')->check()) {
            Auth::guard('admin')->logout();
            $redirect = '/admin/login';
        } else {
            Auth::logout();
            $redirect = '/auth';
        }

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect($redirect)
            ->with('success', 'You have been logged out.');
    }
}

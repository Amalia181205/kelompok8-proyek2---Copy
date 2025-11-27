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

    /**
     * Show combined login/register form for users
     */
    public function showLoginRegister()
    {
        return view('auth.loginregister'); 
    }

    /**
     * Show admin login form
     */
    public function showAdminLogin()
    {
        return view('auth.adminlogin');
    }

    // ==================== AUTHENTICATION ====================

    /**
     * Handle login for both user and admin
     */
    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required|string',
        ]);

        $isAdmin = $request->is('admin/login');
        $guard = $isAdmin ? 'admin' : 'web';
        $remember = $request->has('remember');

        // LOGIN UNTUK ADMIN
        if ($isAdmin) {
            $admin = Admin::where('email', $credentials['email'])->first();
            
            if (!$admin) {
                return redirect('/admin/login')
                    ->withErrors(['email' => 'Admin account not found.'])
                    ->withInput($request->only('email', 'remember'));
            }

            if (Auth::guard('admin')->attempt($credentials, $remember)) {
                $request->session()->regenerate();
                return redirect()->intended('/admin/dashboard')
                    ->with('success', 'Welcome back, Admin!');
            } else {
                return redirect('/admin/login')
                    ->withErrors(['password' => 'Invalid password for admin.'])
                    ->withInput($request->only('email', 'remember'));
            }
        } 
        // LOGIN UNTUK USER
        else {
            $user = User::where('email', $credentials['email'])->first();
            
            if (!$user) {
                return redirect('/auth')
                    ->withErrors(['email' => 'User account not found. Please register first.'])
                    ->withInput($request->only('email', 'remember'))
                    ->with('form_type', 'login');
            }

            if (Auth::guard('web')->attempt($credentials, $remember)) {
                $request->session()->regenerate();
                return redirect()->intended('/')
                    ->with('success', 'Welcome back!');
            } else {
                return redirect('/auth')
                    ->withErrors(['password' => 'Invalid password.'])
                    ->withInput($request->only('email', 'remember'))
                    ->with('form_type', 'login');
            }
        }
    }

    /**
     * Handle registration (only for users)
     */
    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:users,email',
            'password' => 'required|string|min:6|confirmed',
        ]);

        if ($validator->fails()) {
            return redirect('/auth')
                ->withErrors($validator)
                ->withInput()
                ->with('form_type', 'register');
        }

        $user = User::create([
            'name' => $request->input('name'),
            'email' => $request->input('email'),
            'password' => Hash::make($request->input('password')),
        ]);

        // Auto login setelah registrasi
        Auth::login($user);
        
        return redirect('/')
            ->with('success', 'Account created successfully! Welcome!')
            ->with('form_type', 'register');
    }

    /**
     * Handle logout for both user and admin
     */
    public function logout(Request $request)
    {
        $isAdmin = $request->is('admin/logout');
        
        if ($isAdmin) {
            Auth::guard('admin')->logout();
            $redirectPath = '/admin/login';
        } else {
            Auth::logout();
            $redirectPath = '/auth';
        }
        
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect($redirectPath)->with('success', 'You have been logged out.');
    }
}
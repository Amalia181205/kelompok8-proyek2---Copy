<?php
// app/Http/Controllers/AdminController.php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Admin;

class AdminController extends Controller
{
    public function showLoginForm()
    {
        return view('admin.login');
    }

    public function login(Request $request)
{
    $credentials = $request->only('email', 'password');

    if (Auth::guard('admin')->attempt($credentials)) {
        $request->session()->regenerate();
        return redirect()->route('admin.dashboard');
    }

    return back()->withErrors([
        'email' => 'Email atau password salah',
    ]);
}

    public function dashboard()
    {
        return view('admin.dashboard');
    }

    public function logout(Request $request)
    {
        Auth::guard('admin')->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/admin/login');
    }
}
<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    /**
     * Show admin dashboard
     */
    public function index()
    {
        $title = 'Admin Dashboard';
        $slug = 'dashboard';
        return view('Admin.layoutadmin.dashboard', compact('title', 'slug'));
    }
}
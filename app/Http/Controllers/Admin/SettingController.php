<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Admin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class SettingController extends Controller
{
    public function index()
    {
        $title = 'Setting';
        $slug = 'setting';
        
        // Ambil data dari database - sesuaikan dengan model yang ada
        $users = \App\Models\User::all();
        $admins = \App\Models\Admin::all();
        
        return view('admin.layoutadmin.setting', compact('title', 'slug', 'users', 'admins'));
    }
}
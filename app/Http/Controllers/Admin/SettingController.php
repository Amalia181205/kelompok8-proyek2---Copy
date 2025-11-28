<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class SettingController extends Controller
{
    //
    public function index()
    {
        $title = 'Admin Setting';
        $slug = 'setting';
        return view('Admin.layoutadmin.setting', compact('title', 'slug'));
    }
}

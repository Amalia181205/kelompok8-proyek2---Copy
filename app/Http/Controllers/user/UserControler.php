<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserControler extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:6',
        ]);

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'password' => bcrypt($request->password),
            'status' => 'active'
        ]);

        return redirect()->back()->with('success', 'User berhasil ditambahkan');
    }

    public function destroy($id)
    {
        $user = User::findOrFail($id);
        $user->delete();

        return redirect()->back()->with('success', 'User berhasil dihapus');
    }

    public function toggleStatus($id, Request $request)
    {
        $user = User::findOrFail($id);
        $user->update(['status' => $request->status]);

        return redirect()->back()->with('success', 'Status user berhasil diubah');
    }
}
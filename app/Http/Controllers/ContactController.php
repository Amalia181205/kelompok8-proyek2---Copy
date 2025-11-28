<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Contact;

class ContactController extends Controller
{
    // Tampilkan form contact
    public function create()
    {
        return view('konten.contact'); 
    }

    // Simpan data (POST)
    public function store(Request $request)
    {

        $validated = $request->validate([
            'name' => 'required|string',
            'email' => 'required|string',
            'message' => 'required|string',
        ]);

        Contact::create($validated);

        return redirect()->back()->with('success', 'Pesan berhasil dikirim!');
    }
}

<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Package;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PackageController extends Controller
{
    // Menampilkan semua paket
    public function index()
    {
        $title = 'Package Management';
        $slug = 'packages';
        $packages = Package::all();
        
        return view('admin.packages.index', compact('title', 'slug', 'packages'));
    }

    // Menampilkan form tambah paket
    public function create()
    {
        $title = 'Tambah Paket Baru';
        $slug = 'packages';
        
        return view('admin.packages.create', compact('title', 'slug'));
    }

    // Menyimpan paket baru
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'price' => 'required|numeric|min:0',
            'duration' => 'required|integer|min:1',
            'photo_count' => 'required|integer|min:1',
            'features' => 'required|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'category' => 'required|in:wedding,family,graduation,maternity,other'
        ]);

        $data = $request->all();
        
        // Konversi features dari string ke array
        $data['features'] = array_filter(array_map('trim', explode(',', $request->features)));
        
        // Upload gambar jika ada
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('packages', 'public');
            $data['image'] = $imagePath;
        }

        Package::create($data);

        return redirect()->route('admin.packages.index')
            ->with('success', 'Paket berhasil ditambahkan');
    }

    // Menampilkan detail paket
    public function show(Package $package)
    {
        $title = 'Detail Paket';
        $slug = 'packages';
        
        return view('admin.packages.show', compact('title', 'slug', 'package'));
    }

    // Menampilkan form edit paket
    public function edit(Package $package)
    {
        $title = 'Edit Paket';
        $slug = 'packages';
        
        return view('admin.packages.edit', compact('title', 'slug', 'package'));
    }

    // Update paket
    public function update(Request $request, Package $package)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'price' => 'required|numeric|min:0',
            'duration' => 'required|integer|min:1',
            'photo_count' => 'required|integer|min:1',
            'features' => 'required|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'category' => 'required|in:wedding,family,graduation,maternity,other'
        ]);

        $data = $request->all();
        
        // Konversi features
        $data['features'] = array_filter(array_map('trim', explode(',', $request->features)));
        
        // Upload gambar baru jika ada
        if ($request->hasFile('image')) {
            // Hapus gambar lama jika ada
            if ($package->image) {
                Storage::disk('public')->delete($package->image);
            }
            
            $imagePath = $request->file('image')->store('packages', 'public');
            $data['image'] = $imagePath;
        }

        $package->update($data);

        return redirect()->route('admin.packages.index')
            ->with('success', 'Paket berhasil diperbarui');
    }

    // Hapus paket
    public function destroy(Package $package)
    {
        // Hapus gambar jika ada
        if ($package->image) {
            Storage::disk('public')->delete($package->image);
        }
        
        $package->delete();

        return redirect()->route('admin.packages.index')
            ->with('success', 'Paket berhasil dihapus');
    }

    // Toggle status aktif/tidak aktif
    public function toggleStatus(Package $package)
    {
        $package->update(['is_active' => !$package->is_active]);
        
        $status = $package->is_active ? 'diaktifkan' : 'dinonaktifkan';
        
        return redirect()->back()
            ->with('success', "Paket berhasil $status");
    }
}
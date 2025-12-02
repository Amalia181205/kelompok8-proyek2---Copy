<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Gallery;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;

class GalleryController extends Controller
{
    // Menampilkan semua galeri
    public function index()
    {
        $title = 'Gallery Management';
        $slug = 'gallery';
        $galleries = Gallery::orderBy('sort_order')->orderBy('created_at', 'desc')->get();
        
        return view('admin.gallery.index', compact('title', 'slug', 'galleries'));
    }

    // Menampilkan form tambah galeri
    public function create()
    {
        $title = 'Tambah Galeri Baru';
        $slug = 'gallery';
        
        return view('admin.gallery.create', compact('title', 'slug'));
    }

    // Menyimpan galeri baru
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,webp|max:5120',
            'category' => 'required|in:wedding,family,graduation,maternity,portrait,event,other',
            'sort_order' => 'nullable|integer',
            'is_active' => 'nullable|boolean'
        ]);

        // Upload dan optimasi gambar
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $filename = time() . '_' . $image->getClientOriginalName();
            $path = 'gallery/' . $filename;
            
            // Simpan gambar dengan ukuran optimal
            $image = Image::make($image);
            $image->resize(1200, null, function ($constraint) {
                $constraint->aspectRatio();
                $constraint->upsize();
            });
            
            Storage::disk('public')->put($path, (string) $image->encode());
        }

        // Simpan data galeri
        Gallery::create([
            'title' => $request->title,
            'description' => $request->description,
            'image' => $path,
            'category' => $request->category,
            'sort_order' => $request->sort_order ?? 0,
            'is_active' => $request->has('is_active')
        ]);

        return redirect()->route('admin.gallery.index')
            ->with('success', 'Gambar galeri berhasil ditambahkan!');
    }

    // Menampilkan detail galeri
    public function show(Gallery $gallery)
    {
        $title = 'Detail Galeri';
        $slug = 'gallery';
        
        return view('admin.gallery.show', compact('title', 'slug', 'gallery'));
    }

    // Menampilkan form edit galeri
    public function edit(Gallery $gallery)
    {
        $title = 'Edit Galeri';
        $slug = 'gallery';
        
        return view('admin.gallery.edit', compact('title', 'slug', 'gallery'));
    }

    // Update galeri
    public function update(Request $request, Gallery $gallery)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:5120',
            'category' => 'required|in:wedding,family,graduation,maternity,portrait,event,other',
            'sort_order' => 'nullable|integer',
            'is_active' => 'nullable|boolean'
        ]);

        $data = $request->all();
        
        // Upload gambar baru jika ada
        if ($request->hasFile('image')) {
            // Hapus gambar lama
            if ($gallery->image) {
                Storage::disk('public')->delete($gallery->image);
            }
            
            // Upload gambar baru
            $image = $request->file('image');
            $filename = time() . '_' . $image->getClientOriginalName();
            $path = 'gallery/' . $filename;
            
            // Optimasi gambar
            $image = Image::make($image);
            $image->resize(1200, null, function ($constraint) {
                $constraint->aspectRatio();
                $constraint->upsize();
            });
            
            Storage::disk('public')->put($path, (string) $image->encode());
            $data['image'] = $path;
        }

        // Update status aktif
        $data['is_active'] = $request->has('is_active');

        $gallery->update($data);

        return redirect()->route('admin.gallery.index')
            ->with('success', 'Galeri berhasil diperbarui!');
    }

    // Hapus galeri
    public function destroy(Gallery $gallery)
    {
        // Hapus gambar dari storage
        if ($gallery->image) {
            Storage::disk('public')->delete($gallery->image);
        }
        
        $gallery->delete();

        return redirect()->route('admin.gallery.index')
            ->with('success', 'Galeri berhasil dihapus!');
    }

    // Toggle status aktif
    public function toggleStatus(Gallery $gallery)
    {
        $gallery->update(['is_active' => !$gallery->is_active]);
        
        $status = $gallery->is_active ? 'diaktifkan' : 'dinonaktifkan';
        
        return redirect()->back()
            ->with('success', "Galeri berhasil $status");
    }

    // Update sort order
    public function updateSortOrder(Request $request)
    {
        $request->validate([
            'items' => 'required|array'
        ]);

        foreach ($request->items as $index => $id) {
            Gallery::where('id', $id)->update(['sort_order' => $index + 1]);
        }

        return response()->json(['success' => true]);
    }
}
<?php

namespace App\Http\Controllers;

use App\Models\Gallery;

class GalleryUserController extends Controller
{
    public function index()
    {
        $kategori = [
            ['slug' => 'prewedding', 'nama' => 'PREWEDDING', 'icon' => 'fa-solid fa-hand-holding-heart'],
            ['slug' => 'personal', 'nama' => 'PERSONAL GALLERY', 'icon' => 'fa-solid fa-user'],
            ['slug' => 'family', 'nama' => 'FAMILY', 'icon' => 'fa-solid fa-users'],
            ['slug' => 'wedding', 'nama' => 'WEDDING', 'icon' => 'fa-solid fa-heart'],
            ['slug' => 'baby', 'nama' => 'BABY & MATERNITY', 'icon' => 'fa-solid fa-baby-carriage'],
        ];

        return view('konten.gallery', [
            'page' => 'index',
            'kategori' => $kategori
        ]);
    }

    public function detail($kategori)
    {
        // Ambil data dari database
        $images = Gallery::where('category', $kategori)
            ->where('is_active', 1)
            ->orderBy('sort_order')
            ->orderBy('created_at', 'desc')
            ->get();

        return view('konten.gallery', [
            'page' => 'detail',
            'kategori' => $kategori,
            'images' => $images
        ]);
    }

    // public function detail($kategori)
    // {
    //     $data = [
    //         'prewedding' => ['Prewed1.jpg', 'Prewed2.jpg','Prewed3.jpg','Prewed4.jpg','Prewed5.jpg',
    //                         'Prewed7.jpg','Prewed11.jpg','Prewed13.jpg','Prewed14.jpg',
    //                         'Prewed6.jpg', 'Prewed12.jpg', 'Prewed17.jpg'],
    //         'personal'   => ['Personal1.jpg', 'Personal2.jpg', 'Personal4.jpg', 'Personal5.jpg',
    //                         'Personal6.jpg', 'Personal8.jpg','Personal9.jpg','Personal10.jpg',
    //                         'Personal3.jpg', 'Personal12.jpg', 'Personal13.jpg', 'Personal14.jpg' ],
    //         'family'     => ['PaketKeluarga.jpg', 'Familly1.jpg', 'Family2.jpg','Family3.jpg',
    //                         'Family4.jpg', 'Family5.jpg', 'Family7.jpg', 'Family8.jpg',
    //                         'Family9.jpg', 'Family10.jpg', 'Family11.jpg'],
    //         'wedding'    => ['Wedding1.jpg', 'Wedding2.jpg','Wedding3.jpg','Wedding4.jpg','Wedding5.jpg',
    //                         'Wedding6.jpg', 'Wedding8.jpg', 'Wedding10.jpg',
    //                         'Wedding11.jpg','Wedding12.jpg','Wedding13.jpg','Wedding15.jpg',
    //                         'Wedding16.jpg','Wedding17.jpg','Wedding18.jpg','Wedding19.jpg','Wedding20.jpg'],
    //         'baby'       => ['baby1.jpg', 'baby2.jpg','baby3.jpg','baby4.jpg','baby5.jpg',
    //                         'baby6.jpg','baby7.jpg','baby8.jpg','baby9.jpg','baby10.jpg','baby11.jpg',
    //                         'baby12.jpg','baby13.jpg','baby14.jpg',
    //                         'Family2.jpg', 'Maternity2.jpg','Maternity3.jpg','Maternity4.jpg',
    //                         'Maternity5.jpg','Maternity6.jpg'],
    //     ];

    //     return view('konten.gallery', [
    //         'page' => 'detail',
    //         'kategori' => $kategori,
    //         'images' => $data[$kategori] ?? []
    //     ]);
    // }
}

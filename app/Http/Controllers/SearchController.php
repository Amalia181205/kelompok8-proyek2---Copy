<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Booking;

class SearchController extends Controller
{

    public function search(Request $request)
{
    $query = strtolower($request->query('query'));

    $packages = [
        'personal',
        'family',
        'maternity',
        'prewedding',
    ];

    foreach ($packages as $package) {
        if (str_contains($package, $query)) {
            return redirect()->route('booking.show', ['type' => $package]);
        }
    }

    // kalau tidak ketemu paket
    return view('search.results', [
        'query' => $query,
        'results' => collect()
    ]);
}

}


// namespace App\Http\Controllers;

// use Illuminate\Http\Request;
// use App\Models\Post; // atau Product, User, dll

// class SearchController extends Controller
// {
//     public function search(Request $request)
//     {
//         $request->validate([
//             'query' => 'required|min:2',
//         ]);

//         $query = $request->input('query');

//         $results = Post::where('title', 'like', "%{$query}%")
//                         ->orWhere('content', 'like', "%{$query}%")
//                         ->get();

//         return view('search.results', compact('results', 'query'));
//     }
// } 


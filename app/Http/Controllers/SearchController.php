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

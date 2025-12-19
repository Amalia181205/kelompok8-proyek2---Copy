<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class MidtransController extends Controller
{
    public function callback(Request $request)
    {
        \Log::info('MIDTRANS CALLBACK', $request->all());

         return response()->json(['message' => 'OK'], 200);
    }

}

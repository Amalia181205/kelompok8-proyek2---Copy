<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;
use App\Models\PaymentConfirmation;


class OrdersController extends Controller
{
    
    public function index()
    {
        $orders = PaymentConfirmation::with('booking')->latest()->get();
        return view('admin.layoutadmin.orders', compact('orders'));
    }

    public function store(Request $request)
    {
        $order = Order::create($request->all());
        return response()->json($order, 201);
    }

    public function show($id)
    {
        return response()->json(Order::findOrFail($id));
    }

    public function update(Request $request, $id)
    {
        $order = Order::findOrFail($id);
        $order->update($request->all());
        return response()->json($order);
    }

    public function destroy($id)
    {
        Order::destroy($id);
        return response()->json(null, 204);
    }
}

<?php

namespace App\Http\Controllers\Seller;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function index()
    {
        $seller = \App\Models\Seller::find(auth('seller')->id());

        // Mark all orders as read (update orders_seen_at to now)
        $seller->orders_seen_at = now();
        $seller->save();

        $orders = \App\Models\Order::with(['items.drug', 'user'])
            ->where('seller_id', $seller->id)
            ->orderBy('created_at', 'desc')
            ->paginate(10);

        return view('seller.orders.index', compact('orders'));
    }
    public function update(Request $request, \App\Models\Order $order)
{
    $request->validate([
        'status' => 'required|in:pending,processing,completed,cancelled',
    ]);

    // Make sure the order belongs to the seller
    if ($order->seller_id !== auth('seller')->id()) {
        return response()->json(['success' => false, 'message' => 'Unauthorized'], 403);
    }

    $order->status = $request->status;
    $order->save();

    return response()->json(['success' => true]);
}

}

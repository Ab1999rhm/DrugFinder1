<?php

namespace App\Http\Controllers\Seller;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Order;

class SellerOrderController extends Controller
{
    public function index()
    {
        $orders = Order::with(['items.drug', 'user'])
            ->where('seller_id', auth('seller')->id())
            ->orderBy('created_at', 'desc')
            ->paginate(10);

        return view('seller.orders.index', compact('orders'));
    }

    public function updateStatus(Request $request, Order $order)
    {
        $request->validate([
            'status' => 'required|in:pending,processing,completed,cancelled'
        ]);

        $order->update(['status' => $request->status]);

        return response()->json([
            'success' => true,
            'message' => 'Order status updated!'
        ]);
    }
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Drug;

class OrderController extends Controller
{
    public function updateStatus(Request $request, Order $order)
{
    $request->validate([
        'status' => 'required|in:pending,processing,completed,cancelled'
    ]);
    $order->status = $request->status;
    $order->save();

    return response()->json(['success' => true]);
}

    public function index()
{
    // Only show orders for the logged-in seller
    $orders = \App\Models\Order::with(['user', 'items.drug'])
        ->where('seller_id', auth('seller')->id())
        ->orderBy('created_at', 'desc')
        ->paginate(15);

    return view('seller.orders.index', compact('orders'));
}

    public function store(Request $request)
    {
        $request->validate([
            'drug_id' => 'required|exists:drugs,id',
            'quantity' => 'required|integer|min:1'
        ]);

        $drug = Drug::findOrFail($request->drug_id);

        // Check stock
        if ($request->quantity > $drug->quantity) {
            return response()->json(['success' => false, 'message' => 'Not enough stock.']);
        }

        // Create order
        $order = Order::create([
            'user_id' => auth()->id(),
            'seller_id' => $drug->seller_id,
            'total' => $drug->price * $request->quantity,
            'status' => 'pending',
        ]);

        // Create order item (relationship should be 'items')
        $order->items()->create([
            'drug_id' => $drug->id,
            'quantity' => $request->quantity,
            'price' => $drug->price,
        ]);

        // Decrement stock
        $drug->decrement('quantity', $request->quantity);

        return response()->json([
            'success' => true,
            'message' => 'Order placed successfully!'
        ]);
    }
}

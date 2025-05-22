<?php

namespace App\Http\Controllers\Seller;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Store;
use Illuminate\Support\Facades\Auth;

class StoreController extends Controller
{
    public function register(Request $request)
    {
        // Validate request data
        $request->validate([
            'store_name' => 'required|string|max:255',
            'location' => 'required|string',
            'contact_details' => 'required|string',
            'prescription_required' => 'required|in:yes,no',
        ]);

        // Ensure authenticated seller
        $seller = Auth::user();
        if (!$seller) {
            return redirect()->route('seller.login')->with('error', 'You must be logged in as a seller.');
        }

        // Create store entry
        Store::create([
            'seller_id' => $seller->id,
            'name' => $request->store_name,
            'location' => $request->location,
            'contact_details' => $request->contact_details,
            'prescription_required' => $request->prescription_required,
        ]);

        return redirect()->route('seller.dashboard')->with('success', 'Store registered successfully!');
    }
}

<?php

namespace App\Http\Controllers\Seller;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Models\Drug;

class SellerController extends Controller
{
    /**
     * Display the seller dashboard.
     */
    public function index()
    {
        $seller = Auth::user(); // Ensure correct authentication

        // Check if seller exists before querying
        if (!$seller) {
            return redirect()->route('login')->with('error', 'You must be logged in as a seller.');
        }

        // Fetch seller's drugs
        $drugs = Drug::where('seller_id', $seller->id)->get();

        // Get total and low-stock drugs
        $totalDrugs = $drugs->count();
        $lowStockCount = Drug::where('seller_id', $seller->id)->where('quantity', '<', 5)->count();

        // Prepare drugs added per month data for charts
        $drugsPerMonth = Drug::where('seller_id', $seller->id)
            ->selectRaw('MONTH(created_at) as month, COUNT(*) as count')
            ->groupBy('month')
            ->pluck('count', 'month')
            ->toArray();

        $months = array_keys($drugsPerMonth);
        $drugsData = array_values($drugsPerMonth);

        // Pass all data to the view
        return view('seller.dashboard', compact('seller', 'drugs', 'totalDrugs', 'lowStockCount', 'months', 'drugsData'));
    }
}

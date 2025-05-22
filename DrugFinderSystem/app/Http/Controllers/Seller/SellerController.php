<?php

namespace App\Http\Controllers\Seller;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\Drug;
use App\Models\Seller;
use App\Models\SellerDrug;
class SellerController extends Controller
{
    /**
     * Display the seller dashboard.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        $seller = Auth::guard('seller')->user();
        $totalDrugs = \App\Models\Drug::where('seller_id', $seller->id)->count();
        $lowStockCount = \App\Models\Drug::where('seller_id', $seller->id)->where('quantity', '<', 5)->count();
        $drugsPerMonth = \App\Models\Drug::where('seller_id', $seller->id)
            ->selectRaw('MONTH(created_at) as month, COUNT(*) as count')
            ->groupBy('month')
            ->pluck('count', 'month');
    
        return view('seller.dashboard', compact('seller', 'totalDrugs', 'lowStockCount', 'drugsPerMonth'));
    }
    
}

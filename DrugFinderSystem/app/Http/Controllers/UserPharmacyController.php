<?php

namespace App\Http\Controllers;

use App\Models\Seller;
use Illuminate\Http\Request;

class UserPharmacyController extends Controller
{
    public function index(Request $request)
    {
        $query = Seller::with(['drugs' => function ($q) {
            $q->where('quantity', '>', 0);
        }])
            ->whereNotNull('latitude')
            ->whereNotNull('longitude');

        // Location filtering
        if ($request->filled('city')) {
            $query->where('city', 'like', '%' . $request->city . '%');
        }
        if ($request->filled('state')) {
            $query->where('state', 'like', '%' . $request->state . '%');
        }
        if ($request->filled('country')) {
            $query->where('country', 'like', '%' . $request->country . '%');
        }

        // Search by pharmacy name or drug name
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('shop_name', 'like', "%$search%")
                    ->orWhere('name', 'like', "%$search%")
                    ->orWhereHas('drugs', function ($q2) use ($search) {
                        $q2->where('name', 'like', "%$search%");
                    });
            });
        }

        $pharmacies = $query->get();

        return view('user.pharmacies', compact('pharmacies'));
    }
}

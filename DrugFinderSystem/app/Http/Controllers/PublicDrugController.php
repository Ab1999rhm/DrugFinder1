<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Drug;

class PublicDrugController extends Controller
{
    public function index(Request $request)
    {
        $query = Drug::query();

        // Filter by drug name (q)
        if ($request->filled('q')) {
            $query->where('name', 'like', '%' . $request->q . '%');
        }

        // Filter by price range
        if ($request->filled('price_min')) {
            $query->where('price', '>=', $request->price_min);
        }
        if ($request->filled('price_max')) {
            $query->where('price', '<=', $request->price_max);
        }

        // Filter by seller location fields using whereHas
        $query->whereHas('seller', function ($q) use ($request) {
            if ($request->filled('country')) {
                $q->where('country', 'like', '%' . $request->country . '%');
            }
            if ($request->filled('state')) {
                $q->where('state', 'like', '%' . $request->state . '%');
            }
            if ($request->filled('wereda')) {
                $q->where('wereda', 'like', '%' . $request->wereda . '%');
            }
            if ($request->filled('city')) {
                $q->where('city', 'like', '%' . $request->city . '%');
            }
        });

        // Optionally eager load seller to reduce queries
        $drugs = $query->with('seller')->paginate(15);

        return view('public.drugs.index', compact('drugs'));
    }
}

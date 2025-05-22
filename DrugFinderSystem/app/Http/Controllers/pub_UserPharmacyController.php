<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class pub_UserPharmacyController extends Controller
{
    public function publicPharmacies(Request $request)
    {
        $query = \App\Models\Drug::with('seller')->where('quantity', '>', 0);

        if ($request->filled('q')) {
            $query->where('name', 'like', '%' . $request->q . '%');
        }
        if ($request->filled('price_min')) {
            $query->where('price', '>=', $request->price_min);
        }
        if ($request->filled('price_max')) {
            $query->where('price', '<=', $request->price_max);
        }
        if ($request->filled('country')) {
            $query->whereHas('seller', function ($q) use ($request) {
                $q->where('country', 'like', '%' . $request->country . '%');
            });
        }
        if ($request->filled('state')) {
            $query->whereHas('seller', function ($q) use ($request) {
                $q->where('state', 'like', '%' . $request->state . '%');
            });
        }
        if ($request->filled('city')) {
            $query->whereHas('seller', function ($q) use ($request) {
                $q->where('city', 'like', '%' . $request->city . '%');
            });
        }
        if ($request->filled('wereda')) {
            $query->whereHas('seller', function ($q) use ($request) {
                $q->where('wereda', 'like', '%' . $request->wereda . '%');
            });
        }

        $drugs = $query->get();

        // Pass ONLY $drugs to the view!
        return view('user.public_pharmacies', compact('drugs'));
    }
}

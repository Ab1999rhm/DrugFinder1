<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Drug;
use App\Models\Category;
use App\Models\DrugOffer;

class UserDrugController extends Controller
{
    /**
     * Display the browse/search drugs page with optional AJAX filtering.
     */
    public function index(Request $request)
    {
        // Fetch filter options from the drugs table (if you use them in your sidebar)
        $countries = Drug::select('country')->distinct()->pluck('country')->filter()->values();
        $states = Drug::select('state')->distinct()->pluck('state')->filter()->values();
        $cities = Drug::select('city')->distinct()->pluck('city')->filter()->values();
        $weredas = Drug::select('wereda')->distinct()->pluck('wereda')->filter()->values();

        // Build the drugs query with filters
        $query = Drug::query();

        if ($request->filled('q')) {
            $query->where(function ($sub) use ($request) {
                $sub->where('name', 'like', "%{$request->q}%")
                    ->orWhere('description', 'like', "%{$request->q}%");
            });
        }
        if ($request->filled('category')) {
            $query->where('category_id', $request->category);
        }
        if ($request->filled('price_min')) {
            $query->where('price', '>=', $request->price_min);
        }
        if ($request->filled('price_max')) {
            $query->where('price', '<=', $request->price_max);
        }
        if ($request->filled('country')) {
            $query->where('country', 'like', '%' . $request->country . '%');
        }
        if ($request->filled('state')) {
            $query->where('state', 'like', '%' . $request->state . '%');
        }
        if ($request->filled('city')) {
            $query->where('city', 'like', '%' . $request->city . '%');
        }
        if ($request->filled('wereda')) {
            $query->where('wereda', 'like', '%' . $request->wereda . '%');
        }

        // Always paginate with 6 per page for a 3x2 grid
        $drugs = $query->orderBy('name')->paginate(6);

        $categories = Category::orderBy('name')->get();

        // AJAX request returns only the drug list partial
        if ($request->ajax()) {
            return view('user.partials.drug_list', compact('drugs'))->render();
        }

        // Normal request returns the full page
        return view('user.drugs.index', compact('drugs', 'categories', 'countries', 'states', 'cities', 'weredas'));
    }

    /**
     * Autocomplete endpoint for drug names.
     */
    public function autocomplete(Request $request)
    {
        $term = $request->get('term', '');
        $results = Drug::where('name', 'like', "%{$term}%")
            ->orderBy('name')
            ->limit(10)
            ->pluck('name');
        return response()->json($results);
    }

    /**
     * Show drug details for modal popup.
     */
    public function details($id)
    {
        $drug = Drug::findOrFail($id);
        return view('user.partials.drug_details', compact('drug'));
    }

    /**
     * Show price comparison for all offers of the same drug name (across all sellers).
     */
    public function compare($id)
    {
        $drug = Drug::findOrFail($id);

        // Find all drugs with the same name (case-insensitive), eager load seller info
        $offers = Drug::whereRaw('LOWER(name) = ?', [strtolower($drug->name)])
            ->with('seller')
            ->orderBy('price')
            ->get();

        return view('user.partials.drug_compare', [
            'drug' => $drug,
            'offers' => $offers
        ]);
    }
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Drug;
use App\Models\DrugRating;

class DrugController extends Controller
{
    // ... (other methods)

    public function rate(Request $request)
    {
        $request->validate([
            'drug_id' => 'required|exists:drugs,id',
            'rating' => 'required|integer|min:1|max:5',
        ]);

        $drug = Drug::findOrFail($request->drug_id);
        $user = auth()->user();

        // Save or update user's rating for this drug
        $ratingRecord = DrugRating::updateOrCreate(
            ['user_id' => $user->id, 'drug_id' => $drug->id],
            ['rating' => $request->rating]
        );

        // Recalculate average rating and count
        $avgRating = DrugRating::where('drug_id', $drug->id)->avg('rating');
        $ratingCount = DrugRating::where('drug_id', $drug->id)->count();

        // Save average rating and count in drugs table (optional)
        $drug->rating = round($avgRating, 2);
        $drug->rating_count = $ratingCount;
        $drug->save();

        return response()->json([
            'success' => true,
            'new_rating' => $drug->rating,
            'rating_count' => $drug->rating_count,
        ]);
    }
    public function publicIndex(Request $request)
    {
        // You can add filtering logic here if needed
        $drugs = Drug::paginate(12); // Or your custom query

        return view('user.drugs.public_index', compact('drugs'));
    }

    // ... (other methods)
}

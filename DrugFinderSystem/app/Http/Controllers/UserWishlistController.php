<?php

namespace App\Http\Controllers;

use App\Models\Wishlist;
use Illuminate\Http\Request;

class UserWishlistController extends Controller
{
    public function index()
    {
        $wishlists = Wishlist::with(['drug.seller'])
            ->where('user_id', auth()->id())
            ->get()
            // Filter out wishlist items without a related drug
            ->filter(fn($item) => $item->drug !== null)
            ->values(); // reindex collection

        return view('user.wishlist.index', compact('wishlists'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'drug_id' => 'required|exists:drugs,id',
        ]);
    
        Wishlist::firstOrCreate([
            'user_id' => auth()->id(),
            'drug_id' => $request->drug_id,
        ]);
    
        if ($request->ajax()) {
            return response()->json(['success' => true, 'message' => 'Added to your wishlist!']);
        }
    
        return back()->with('success', 'Added to your wishlist!');
    }
    
    public function destroy(Wishlist $wishlist)
    {
        if ($wishlist->user_id !== auth()->id()) {
            abort(403);
        }
        $wishlist->delete();
        return back()->with('success', 'Removed from wishlist.');
    }

    public function update(Request $request, Wishlist $wishlist)
    {
        if ($wishlist->user_id !== auth()->id()) {
            abort(403);
        }
        $request->validate([
            'prescription_note' => 'nullable|string|max:255',
        ]);
        $wishlist->prescription_note = $request->prescription_note;
        $wishlist->save();
        return back()->with('success', 'Prescription note updated.');
    }
}

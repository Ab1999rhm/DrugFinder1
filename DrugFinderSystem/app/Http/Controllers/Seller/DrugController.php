<?php

namespace App\Http\Controllers\Seller;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Drug;

class DrugController extends Controller
{
    public function index()
    {
        // Fetch all drugs for the current seller, newest first
        $drugs = Drug::where('seller_id', Auth::guard('seller')->id())
            ->orderBy('created_at', 'desc')
            ->get();

        return view('seller.drugs.index', compact('drugs'));
    }

    public function create()
    {
        return view('seller.drugs.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'brand' => 'required|string|max:255',
            'category' => 'required|string|max:255',
            'dosage_form' => 'required|string|max:255',
            'strength' => 'required|string|max:255',
            'quantity' => 'required|integer|min:1',
            'price' => 'required|numeric|min:0',
            'expiry_date' => 'required|date|after:today',
            'description' => 'nullable|string'
        ]);

        $sellerId = Auth::guard('seller')->id();
        if (!$sellerId) {
            abort(403, 'Unauthorized action.');
        }

        Drug::create([
            'seller_id' => $sellerId,
            'name' => $request->name,
            'brand' => $request->brand,
            'category' => $request->category,
            'dosage_form' => $request->dosage_form,
            'strength' => $request->strength,
            'quantity' => $request->quantity,
            'price' => $request->price,
            'expiry_date' => $request->expiry_date,
            'description' => $request->description,
        ]);

        return redirect()->route('seller.drugs.index')->with('success', 'Drug added successfully!');
    }

    public function show(Drug $drug)
    {
        $this->authorizeDrug($drug);
        return view('seller.drugs.show', compact('drug'));
    }

    public function edit(Drug $drug)
    {
        $this->authorizeDrug($drug);
        return view('seller.drugs.edit', compact('drug'));
    }

    public function update(Request $request, Drug $drug)
    {
        $this->authorizeDrug($drug);

        $request->validate([
            'name' => 'required|string|max:255',
            'brand' => 'required|string|max:255',
            'category' => 'required|string|max:255',
            'dosage_form' => 'required|string|max:255',
            'strength' => 'required|string|max:255',
            'quantity' => 'required|integer|min:1',
            'price' => 'required|numeric|min:0',
            'expiry_date' => 'required|date|after:today',
            'description' => 'nullable|string'
        ]);

        $drug->update($request->only([
            'name', 'brand', 'category', 'dosage_form', 'strength', 'quantity', 'price', 'expiry_date', 'description'
        ]));

        return redirect()->route('seller.drugs.index')->with('success', 'Drug updated successfully!');
    }

    public function destroy(Drug $drug)
    {
        $this->authorizeDrug($drug);
        $drug->delete();
        return redirect()->route('seller.drugs.index')->with('success', 'Drug deleted successfully!');
    }

    /**
     * Ensure the seller can only manage their own drugs.
     */
    private function authorizeDrug(Drug $drug): void
    {
        if ($drug->seller_id !== Auth::guard('seller')->id()) {
            abort(403, 'Unauthorized action.');
        }
    }
}

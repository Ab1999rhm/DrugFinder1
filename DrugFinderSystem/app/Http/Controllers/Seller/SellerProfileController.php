<?php

namespace App\Http\Controllers\Seller;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use App\Models\Seller;

class SellerProfileController extends Controller
{
    /**
     * Show the profile edit form.
     */
    public function edit()
    {
        $seller = Seller::find(Auth::guard('seller')->id());
        return view('seller.profile.edit', compact('seller'));
    }

    /**
     * Update the seller profile.
     */
    public function update(Request $request)
    {
        $seller = Seller::find(Auth::guard('seller')->id());

        if (!$seller) {
            return back()->withErrors(['error' => 'Seller not found']);
        }

        // Validate input data
        $request->validate([
            'name' => 'required|string|max:255',
            'phone' => 'nullable|string|max:20',
            'address' => 'nullable|string|max:255',
            'company_name' => 'nullable|string|max:255',
            'website' => 'nullable|url|max:255',
            'profile_image' => 'nullable|image|max:2048',
            'bank_account' => 'nullable|string|max:255',
            'tax_id' => 'nullable|string|max:255',
            'bio' => 'nullable|string|max:1000',
            'date_of_birth' => 'nullable|date',
            'city' => 'nullable|string|max:255',
            'state' => 'nullable|string|max:255',
            'country' => 'nullable|string|max:255',
            'postal_code' => 'nullable|string|max:20',
            'emergency_contact' => 'nullable|string|max:255',
            'latitude' => 'nullable|numeric|between:-90,90',
            'longitude' => 'nullable|numeric|between:-180,180',
        ]);

        // Prepare update data, including latitude and longitude directly from request
        $data = $request->except(['_token', 'profile_image']);

        // Handle profile image upload
        if ($request->hasFile('profile_image')) {
            if ($seller->profile_image && Storage::disk('public')->exists($seller->profile_image)) {
                Storage::disk('public')->delete($seller->profile_image);
            }

            $path = $request->file('profile_image')->store('profile_images', 'public');
            $data['profile_image'] = $path;
        }

        // Update the seller with all data including latitude and longitude
        $seller->update($data);

        return back()->with('success', 'Profile updated successfully!');
    }
}

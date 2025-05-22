<?php

namespace App\Http\Controllers\Seller\Auth;

use App\Http\Controllers\Controller;
use App\Models\Seller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class RegisterController extends Controller
{
    public function showRegistrationForm()
    {
        return view('seller.auth.register');
    }

    public function register(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:sellers',
            'password' => 'required|string|min:8|confirmed',
            'shop_name' => 'required|string|max:255',
            'location_coordinates' => 'required|string|max:255',
            'contact_number' => 'required|string|max:255',
        ]);

        Seller::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'shop_name' => $request->shop_name,
            'location_coordinates' => $request->location_coordinates,
            'contact_number' => $request->contact_number,
        ]);

        return redirect()->route('seller.login')->with('success', 'Registration successful! Please log in.');
    }
}

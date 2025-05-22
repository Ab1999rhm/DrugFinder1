<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Drug;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{


    public function dashboard()
    {
        $user = Auth::user();
        $lastCheck = $user->last_drug_notification_check ?? now()->subYear(); // fallback for new users
        $newDrugsCount = Drug::where('created_at', '>', $lastCheck)->count();

        return view('user.dashboard', compact('newDrugsCount'));
    }

    public function profile()
    {
        // Pass the authenticated user to the view
        return view('user.profile', ['user' => auth()->user()]);
    }
}

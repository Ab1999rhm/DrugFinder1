<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use App\Models\Drug;
use App\Models\User;

class UserNotificationController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        if ($user instanceof User) {
            // Use last_drug_notification_check if set, otherwise default to a year ago
            $lastCheck = $user->last_drug_notification_check ?? now()->subYear();

            // Get all drugs added since last check
            $newDrugs = Drug::where('created_at', '>', $lastCheck)->latest()->get();

            // Update the user's last check timestamp
            $user->last_drug_notification_check = now();
            $user->save();
        } else {
            // Not logged in: show latest 10 drugs (or whatever logic you want)
            $newDrugs = Drug::latest()->take(10)->get();
        }

        return view('user.notifications.index', compact('newDrugs'));
    }
}

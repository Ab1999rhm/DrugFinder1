<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UserReviewController extends Controller
{
    public function index()
    {
        // Fetch reviews related to the logged-in user, for example:
        // $reviews = auth()->user()->reviews()->latest()->get();

        // For now, just return a view:
        return view('user.reviews'); // Make sure this view exists
    }
}

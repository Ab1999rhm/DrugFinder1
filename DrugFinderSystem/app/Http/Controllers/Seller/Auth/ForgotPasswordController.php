<?php

namespace App\Http\Controllers\Seller\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Auth\Passwords\CanResetPassword;
use Illuminate\Support\Facades\Password;

class ForgotPasswordController extends Controller
{
    use CanResetPassword;

    // Use the seller password broker
    public function broker()
    {
        return Password::broker('sellers');
    }

    // Show the seller forgot password form
    public function showLinkRequestForm()
    {
        return view('seller.auth.passwords.email');
    }
}

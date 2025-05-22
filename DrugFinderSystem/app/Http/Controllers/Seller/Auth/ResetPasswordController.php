<?php

namespace App\Http\Controllers\Seller\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Auth\Passwords\CanResetPassword;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Password;

class ResetPasswordController extends Controller
{
    use CanResetPassword;

    protected $redirectTo = '/seller/dashboard';

    public function broker()
    {
        return Password::broker('sellers');
    }

    public function showResetForm(Request $request, $token = null)
    {
        return view('seller.auth.passwords.reset')->with([
            'token' => $token,
            'email' => $request->email,
        ]);
    }
}

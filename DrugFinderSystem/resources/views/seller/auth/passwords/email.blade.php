<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Seller Forgot Password</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css"/>
    <style>
        body { background: linear-gradient(120deg, #36d1c4 0%, #5b86e5 100%); min-height: 100vh; display: flex; align-items: center; justify-content: center; font-family: 'Nunito', Arial, sans-serif;}
        .reset-container { background: #fff; border-radius: 20px; box-shadow: 0 8px 32px rgba(44, 62, 80, 0.16), 0 2px 8px rgba(54, 209, 196, 0.13); padding: 36px 30px; width: 100%; max-width: 370px; }
        .reset-title { text-align: center; color: #36d1c4; font-weight: 700; font-size: 1.7em; margin-bottom: 14px; }
        .reset-desc { text-align: center; color: #6c757d; margin-bottom: 24px; font-size: 1.08em; }
        .reset-form label { display: block; margin-bottom: 6px; font-weight: 600; color: #2a3b4c;}
        .reset-form input { width: 100%; padding: 12px 14px; border: 2px solid #e0e6ed; border-radius: 8px; font-size: 1em; background: #f7fafd; color: #2a3b4c; outline: none; margin-bottom: 18px;}
        .reset-form button { width: 100%; background: linear-gradient(90deg, #36d1c4 0%, #5b86e5 100%); color: #fff; border: none; border-radius: 8px; padding: 12px 0; font-size: 1.13em; font-weight: 700; cursor: pointer; }
        .reset-form button:hover { background: linear-gradient(90deg, #5b86e5 0%, #36d1c4 100%);}
        .reset-success { background: #e0f7fa; color: #009688; border-radius: 8px; padding: 10px 16px; margin-bottom: 18px; font-weight: 600; }
        .reset-error { background: #ffeaea; color: #e53935; border-radius: 8px; padding: 10px 16px; margin-bottom: 18px; font-weight: 600; }
    </style>
</head>
<body>
    <div class="reset-container">
        <div class="reset-title"><i class="fa fa-key"></i> Forgot Password</div>
        <div class="reset-desc">Enter your seller email to receive a reset link.</div>
        @if (session('status'))
            <div class="reset-success">
                <i class="fa fa-check-circle"></i> {{ session('status') }}
            </div>
        @endif
        @if ($errors->any())
            <div class="reset-error">
                <i class="fa fa-exclamation-circle"></i> {{ $errors->first() }}
            </div>
        @endif
        <form method="POST" action="{{ route('seller.password.email') }}" class="reset-form">
            @csrf
            <label for="email"><i class="fa fa-envelope"></i> Email</label>
            <input type="email" name="email" id="email" required autofocus placeholder="you@example.com" value="{{ old('email') }}">
            <button type="submit"><i class="fa fa-paper-plane"></i> Send Reset Link</button>
        </form>
        <div style="margin-top:18px;text-align:center;">
            <a href="{{ route('seller.login') }}" style="color:#5b86e5;text-decoration:none;font-weight:600;"><i class="fa fa-arrow-left"></i> Back to login</a>
        </div>
    </div>
</body>
</html>

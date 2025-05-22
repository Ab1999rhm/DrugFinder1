<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Seller Reset Password</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css"/>
    <style>
        body { background: linear-gradient(120deg, #36d1c4 0%, #5b86e5 100%); min-height: 100vh; display: flex; align-items: center; justify-content: center; font-family: 'Nunito', Arial, sans-serif;}
        .reset-container { background: #fff; border-radius: 20px; box-shadow: 0 8px 32px rgba(44, 62, 80, 0.16), 0 2px 8px rgba(54, 209, 196, 0.13); padding: 36px 30px; width: 100%; max-width: 370px; }
        .reset-title { text-align: center; color: #36d1c4; font-weight: 700; font-size: 1.7em; margin-bottom: 14px; }
        .reset-form label { display: block; margin-bottom: 6px; font-weight: 600; color: #2a3b4c;}
        .reset-form input { width: 100%; padding: 12px 14px; border: 2px solid #e0e6ed; border-radius: 8px; font-size: 1em; background: #f7fafd; color: #2a3b4c; outline: none; margin-bottom: 18px;}
        .reset-form button { width: 100%; background: linear-gradient(90deg, #36d1c4 0%, #5b86e5 100%); color: #fff; border: none; border-radius: 8px; padding: 12px 0; font-size: 1.13em; font-weight: 700; cursor: pointer; }
        .reset-form button:hover { background: linear-gradient(90deg, #5b86e5 0%, #36d1c4 100%);}
        .reset-error { background: #ffeaea; color: #e53935; border-radius: 8px; padding: 10px 16px; margin-bottom: 18px; font-weight: 600; }
    </style>
</head>
<body>
    <div class="reset-container">
        <div class="reset-title"><i class="fa fa-unlock-alt"></i> Reset Password</div>
        @if ($errors->any())
            <div class="reset-error">
                <i class="fa fa-exclamation-circle"></i> {{ $errors->first() }}
            </div>
        @endif
        <form method="POST" action="{{ route('seller.password.update') }}" class="reset-form">
            @csrf
            <input type="hidden" name="token" value="{{ $token }}">
            <label for="email"><i class="fa fa-envelope"></i> Email</label>
            <input type="email" name="email" id="email" required autofocus value="{{ $email ?? old('email') }}">
            <label for="password"><i class="fa fa-lock"></i> New Password</label>
            <input type="password" name="password" id="password" required>
            <label for="password_confirmation"><i class="fa fa-lock"></i> Confirm Password</label>
            <input type="password" name="password_confirmation" id="password_confirmation" required>
            <button type="submit"><i class="fa fa-sync-alt"></i> Reset Password</button>
        </form>
        <div style="margin-top:18px;text-align:center;">
            <a href="{{ route('seller.login') }}" style="color:#5b86e5;text-decoration:none;font-weight:600;"><i class="fa fa-arrow-left"></i> Back to login</a>
        </div>
    </div>
</body>
</html>

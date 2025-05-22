<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Seller Login</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Google Fonts for modern typography -->
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@600;700&display=swap" rel="stylesheet">
    <!-- Font Awesome for icons (optional) -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css"/>
    <style>
        body {
            min-height: 100vh;
            margin: 0;
            background: linear-gradient(120deg, #36d1c4 0%, #5b86e5 100%);
            display: flex;
            align-items: center;
            justify-content: center;
            font-family: 'Nunito', Arial, sans-serif;
        }
        .login-container {
            background: #fff;
            border-radius: 20px;
            box-shadow: 0 8px 32px rgba(44, 62, 80, 0.16), 0 2px 8px rgba(54, 209, 196, 0.13);
            padding: 40px 36px 32px 36px;
            width: 100%;
            max-width: 370px;
            position: relative;
            animation: fadeInUp 0.8s;
        }
        .login-animated-border {
            position: absolute;
            inset: -3px;
            z-index: 0;
            border-radius: 22px;
            background: linear-gradient(120deg, #36d1c4, #5b86e5, #36d1c4, #5b86e5);
            background-size: 400% 400%;
            animation: gradientBorder 4s ease infinite;
            filter: blur(2px);
        }
        @keyframes gradientBorder {
            0% {background-position: 0% 50%;}
            50% {background-position: 100% 50%;}
            100% {background-position: 0% 50%;}
        }
        @keyframes fadeInUp {
            from { opacity: 0; transform: translateY(40px);}
            to { opacity: 1; transform: none;}
        }
        .login-content {
            position: relative;
            z-index: 1;
        }
        .login-title {
            text-align: center;
            color: #36d1c4;
            font-weight: 700;
            font-size: 2em;
            margin-bottom: 12px;
            letter-spacing: 1px;
        }
        .login-desc {
            text-align: center;
            color: #6c757d;
            margin-bottom: 28px;
            font-size: 1.08em;
        }
        .error-messages {
            background: #ffeaea;
            color: #e53935;
            border-left: 4px solid #e53935;
            border-radius: 7px;
            padding: 10px 16px;
            margin-bottom: 18px;
            font-size: 1em;
            animation: fadeIn 0.7s;
        }
        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(18px);}
            to { opacity: 1; transform: none;}
        }
        .login-form label {
            display: block;
            margin-bottom: 6px;
            font-weight: 600;
            color: #2a3b4c;
        }
        .login-form .input-group {
            margin-bottom: 20px;
        }
        .login-form input[type="email"],
        .login-form input[type="password"] {
            width: 100%;
            padding: 12px 14px;
            border: 2px solid #e0e6ed;
            border-radius: 8px;
            font-size: 1em;
            background: #f7fafd;
            color: #2a3b4c;
            outline: none;
            transition: border 0.2s, box-shadow 0.2s;
            box-shadow: 0 1px 2px rgba(54, 209, 196, 0.05);
        }
        .login-form input:focus {
            border-color: #36d1c4;
            box-shadow: 0 0 0 2px #36d1c455;
            background: #fff;
        }
        .login-form button {
            width: 100%;
            background: linear-gradient(90deg, #36d1c4 0%, #5b86e5 100%);
            color: #fff;
            border: none;
            border-radius: 8px;
            padding: 12px 0;
            font-size: 1.13em;
            font-weight: 700;
            margin-top: 8px;
            cursor: pointer;
            box-shadow: 0 2px 8px rgba(54, 209, 196, 0.14);
            transition: background 0.18s, transform 0.11s, box-shadow 0.18s;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 7px;
        }
        .login-form button:hover {
            background: linear-gradient(90deg, #5b86e5 0%, #36d1c4 100%);
            transform: translateY(-2px) scale(1.04);
            box-shadow: 0 6px 18px rgba(91,134,229,0.14);
        }
        .login-form .forgot-link {
            display: block;
            text-align: right;
            margin-top: 8px;
            color:rgb(11, 55, 150);
            text-decoration: none;
            font-size: 0.97em;
            transition: color 0.18s;
        }
        .login-form .forgot-link:hover {
            color: #36d1c4;
            text-decoration: underline;
        }
        .login-form .register-link {
            display: block;
            text-align: center;
            margin-top: 18px;
            color:rgb(64, 13, 181);
            text-decoration: none;
            font-size: 1em;
            font-weight: 600;
            transition: color 0.18s;
        }
        .login-form .register-link:hover {
            color:rgb(11, 79, 224);
            text-decoration: underline;
        }
        @media (max-width: 500px) {
            .login-container { padding: 16px 2px 12px 2px; max-width: 98vw;}
            .login-title { font-size: 1.3em;}
        }
    </style>
</head>
<body>
    <div class="login-container">
        <div class="login-animated-border"></div>
        <div class="login-content">
            <div class="login-title"><i class="fa fa-user-shield"></i> Seller Login</div>
            <div class="login-desc">Welcome back! Please log in to manage your store.</div>
            @if($errors->any())
                <div class="error-messages">
                    <ul style="margin:0; padding-left: 18px;">
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            <form method="POST" action="{{ route('seller.login.submit') }}" class="login-form" autocomplete="off">
                @csrf
                <div class="input-group">
                    <label for="email"><i class="fa fa-envelope"></i> Email</label>
                    <input type="email" name="email" id="email" required autofocus placeholder="you@example.com" value="{{ old('email') }}">
                </div>
                <div class="input-group">
                    <label for="password"><i class="fa fa-lock"></i> Password</label>
                    <input type="password" name="password" id="password" required placeholder="Your password">
                </div>
                <button type="submit">
                    <i class="fa fa-sign-in-alt"></i> Login
                </button>
                <!-- Corrected forgot password link for sellers -->
                <a href="{{ route('seller.password.request') }}" class="forgot-link">Forgot your password?</a>
                <a href="{{ route('seller.register') }}" class="register-link">Don't have an account? Register</a>
            </form>
        </div>
    </div>
</body>
</html>

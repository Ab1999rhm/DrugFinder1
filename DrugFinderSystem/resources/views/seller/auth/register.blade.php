<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Seller Registration</title>
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
        .register-container {
            background: #fff;
            border-radius: 20px;
            box-shadow: 0 8px 32px rgba(44, 62, 80, 0.16), 0 2px 8px rgba(54, 209, 196, 0.13);
            padding: 40px 36px 32px 36px;
            width: 100%;
            max-width: 410px;
            position: relative;
            animation: fadeInUp 0.8s;
        }
        .register-animated-border {
            position: absolute;
            inset: -3px;
            z-index: 0;
            border-radius: 22px;
            background: linear-gradient(120deg,rgb(12, 137, 127),rgb(40, 91, 199), #36d1c4, #5b86e5);
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
        .register-content {
            position: relative;
            z-index: 1;
        }
        .register-title {
            text-align: center;
            color: #36d1c4;
            font-weight: 700;
            font-size: 2em;
            margin-bottom: 12px;
            letter-spacing: 1px;
        }
        .register-desc {
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
        .register-form label {
            display: block;
            margin-bottom: 6px;
            font-weight: 600;
            color:rgb(7, 19, 30);
        }
        .register-form .input-group {
            margin-bottom: 18px;
        }
        .register-form input[type="text"],
        .register-form input[type="email"],
        .register-form input[type="password"] {
            width: 100%;
            padding: 12px 14px;
            border: 2px solid #e0e6ed;
            border-radius: 8px;
            font-size: 1em;
            background: #f7fafd;
            color:rgb(14, 122, 229);
            outline: none;
            transition: border 0.2s, box-shadow 0.2s;
            box-shadow: 0 1px 2px rgba(54, 209, 196, 0.05);
        }
        .register-form input:focus {
            border-color: #36d1c4;
            box-shadow: 0 0 0 2px #36d1c455;
            background: #fff;
        }
        .register-form button {
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
        .register-form button:hover {
            background: linear-gradient(90deg, #5b86e5 0%, #36d1c4 100%);
            transform: translateY(-2px) scale(1.04);
            box-shadow: 0 6px 18px rgba(91,134,229,0.14);
        }
        .register-form .login-link {
            display: block;
            text-align: center;
            margin-top: 18px;
            color:rgb(57, 10, 224);
            text-decoration: none;
            font-size: 1em;
            font-weight: 600;
            transition: color 0.18s;
        }
        .register-form .login-link:hover {
            color: #5b86e5;
            text-decoration: underline;
        }
        @media (max-width: 500px) {
            .register-container { padding: 16px 2px 12px 2px; max-width: 98vw;}
            .register-title { font-size: 1.3em;}
        }
    </style>
</head>
<body>
    <div class="register-container">
        <div class="register-animated-border"></div>
        <div class="register-content">
            <div class="register-title"><i class="fa fa-store"></i> Seller Registration</div>
            <div class="register-desc">Create your seller account to start managing your pharmacy online.</div>
            @if ($errors->any())
                <div class="error-messages">
                    <ul style="margin:0; padding-left: 18px;">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            <form method="POST" action="{{ route('seller.register.submit') }}" class="register-form" autocomplete="off">
                @csrf
                <div class="input-group">
                    <label for="name"><i class="fa fa-user"></i> Name</label>
                    <input type="text" name="name" id="name" placeholder="Your Name" required value="{{ old('name') }}">
                </div>
                <div class="input-group">
                    <label for="email"><i class="fa fa-envelope"></i> Email</label>
                    <input type="email" name="email" id="email" placeholder="you@example.com" required value="{{ old('email') }}">
                </div>
                <div class="input-group">
                    <label for="password"><i class="fa fa-lock"></i> Password</label>
                    <input type="password" name="password" id="password" placeholder="Password" required>
                </div>
                <div class="input-group">
                    <label for="password_confirmation"><i class="fa fa-lock"></i> Confirm Password</label>
                    <input type="password" name="password_confirmation" id="password_confirmation" placeholder="Confirm Password" required>
                </div>
                <div class="input-group">
                    <label for="shop_name"><i class="fa fa-clinic-medical"></i> Shop Name</label>
                    <input type="text" name="shop_name" id="shop_name" placeholder="Pharmacy Name" required value="{{ old('shop_name') }}">
                </div>
                <div class="input-group">
                    <label for="location_coordinates"><i class="fa fa-map-marker-alt"></i> Location Coordinates</label>
                    <input type="text" name="location_coordinates" id="location_coordinates" placeholder="e.g. 9.03, 38.74" required value="{{ old('location_coordinates') }}">
                </div>
                <div class="input-group">
                    <label for="contact_number"><i class="fa fa-phone"></i> Contact Number</label>
                    <input type="text" name="contact_number" id="contact_number" placeholder="Phone Number" required value="{{ old('contact_number') }}">
                </div>
                <button type="submit">
                    <i class="fa fa-user-plus"></i> Register
                </button>
                <a href="{{ route('seller.login') }}" class="login-link">Already have an account? Login</a>
            </form>
        </div>
    </div>
</body>
</html>

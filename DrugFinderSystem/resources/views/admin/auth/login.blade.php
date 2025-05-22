<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Admin Login | MedFinder</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        body { background: linear-gradient(90deg, #36d1c4 0%, #2575fc 100%); min-height:100vh; }
        .login-box {
            max-width: 400px;
            margin: 80px auto;
            background: #fff;
            border-radius: 1.2em;
            box-shadow: 0 8px 32px rgba(54,209,196,0.18);
            padding: 2em 2em 1em 2em;
        }
        .login-title {
            font-weight: bold;
            color: #2575fc;
            margin-bottom: 1.2em;
            text-align: center;
        }
    </style>
</head>
<body>
    <div class="login-box">
        <h3 class="login-title">Admin Login</h3>
        @if(session('error'))
            <div class="alert alert-danger">{{ session('error') }}</div>
        @endif
        <form method="POST" action="{{ route('admin.login.submit') }}">
            @csrf
            <div class="form-group">
                <label>Email address</label>
                <input type="email" name="email" class="form-control" required autofocus value="{{ old('email') }}">
            </div>
            <div class="form-group">
                <label>Password</label>
                <input type="password" name="password" class="form-control" required>
            </div>
            <button type="submit" class="btn btn-primary btn-block">Login</button>
        </form>
    </div>
</body>
</html>

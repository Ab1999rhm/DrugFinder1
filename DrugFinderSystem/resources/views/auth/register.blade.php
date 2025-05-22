@extends('layouts.public_index')

@section('content')
<style>
    /* Set the background image on the body */
    body {
        background-image: url("{{ asset('images/hospital6.jpg') }}");
        background-size: cover;
        /* Cover entire viewport */
        background-position: center;
        /* Center the image */
        background-repeat: no-repeat;
        /* Do not repeat */
        min-height: 100vh;
        margin: 0;
        animation: bgFadeIn 2s ease forwards;
        position: relative;
    }

    /* Overlay to darken the background for better contrast */
    body::before {
        content: "";
        position: fixed;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background: rgba(0, 0, 0, 0.35);
        pointer-events: none;
        z-index: 0;
    }

    /* Fade-in animation for background */
    @keyframes bgFadeIn {
        from {
            opacity: 0;
        }

        to {
            opacity: 1;
        }
    }

    /* Container styling */
    .register-container {
        position: relative;
        /* To be above overlay */
        z-index: 1;
        max-width: 420px;
        margin: 40px auto;
        background: rgba(255, 255, 255, 0.9);
        border-radius: 20px;
        box-shadow: 0 8px 32px rgba(32, 56, 112, 0.2), 0 1.5px 4px rgba(80, 80, 120, 0.08);
        padding: 2.5rem 2rem 2rem 2rem;
        animation: floatUp 1.5s ease forwards;
    }

    /* Floating up animation for container */
    @keyframes floatUp {
        0% {
            opacity: 0;
            transform: translateY(40px);
        }

        100% {
            opacity: 1;
            transform: translateY(0);
        }
    }

    .register-title {
        font-size: 2rem;
        font-weight: 700;
        color: #2575fc;
        text-align: center;
        margin-bottom: 1.5rem;
        letter-spacing: 1px;
        text-shadow: 0 2px 8px rgba(100, 150, 255, 0.06);
    }

    .form-group {
        margin-bottom: 1.2rem;
        position: relative;
        transition: box-shadow 0.3s;
    }

    .form-group label {
        font-weight: 500;
        color: #333;
        margin-bottom: 0.4rem;
        display: block;
        letter-spacing: 0.5px;
    }

    .form-group input {
        width: 100%;
        padding: 0.7rem 1rem;
        border: 1.5px solid #e0e7ff;
        border-radius: 8px;
        background: #f7faff;
        font-size: 1rem;
        outline: none;
        transition: border-color 0.3s, box-shadow 0.3s;
        box-shadow: 0 1px 4px rgba(80, 80, 120, 0.04);
    }

    .form-group input:focus {
        border-color: #2575fc;
        background: #fff;
        box-shadow: 0 2px 8px rgba(37, 117, 252, 0.10);
    }

    .form-group input:invalid {
        border-color: #ff7675;
    }

    .register-btn {
        width: 100%;
        padding: 0.8rem;
        background: linear-gradient(90deg, #6a11cb 0%, #2575fc 100%);
        color: #fff;
        font-size: 1.1rem;
        font-weight: 600;
        border: none;
        border-radius: 8px;
        box-shadow: 0 2px 8px rgba(37, 117, 252, 0.18);
        cursor: pointer;
        transition: background 0.2s, transform 0.08s;
        margin-top: 0.5rem;
    }

    .register-btn:hover,
    .register-btn:focus {
        background: linear-gradient(90deg, #2575fc 0%, #6a11cb 100%);
        transform: translateY(-2px) scale(1.02);
        box-shadow: 0 4px 16px rgba(37, 117, 252, 0.20);
    }

    .register-link {
        display: block;
        text-align: center;
        margin-top: 1.2rem;
        color: #2575fc;
        font-size: 0.97rem;
        text-decoration: none;
        transition: color 0.2s;
    }

    .register-link:hover {
        color: #6a11cb;
        text-decoration: underline;
    }

    .error-message {
        color: #ff7675;
        font-size: 0.95rem;
        margin-bottom: 0.8rem;
        text-align: center;
        animation: shake 0.3s;
    }

    @keyframes shake {
        0% {
            transform: translateX(0);
        }

        20% {
            transform: translateX(-5px);
        }

        40% {
            transform: translateX(5px);
        }

        60% {
            transform: translateX(-5px);
        }

        80% {
            transform: translateX(5px);
        }

        100% {
            transform: translateX(0);
        }
    }
</style>

<div class="register-container">
    <div class="register-title">Create Account</div>
    @if($errors->any())
    <div class="error-message">
        @foreach($errors->all() as $error)
        {{ $error }}<br>
        @endforeach
    </div>
    @endif
    <form method="POST" action="{{ route('user.register.submit') }}" autocomplete="off">
        @csrf
        <div class="form-group">
            <label for="name">Full Name</label>
            <input id="name" type="text" name="name" value="{{ old('name') }}" required autofocus placeholder="e.g. John Doe">
        </div>
        <div class="form-group">
            <label for="email">Email Address</label>
            <input id="email" type="email" name="email" value="{{ old('email') }}" required placeholder="e.g. john@example.com">
        </div>
        <div class="form-group">
            <label for="password">Password</label>
            <input id="password" type="password" name="password" required placeholder="Create a password">
        </div>
        <div class="form-group">
            <label for="password_confirmation">Confirm Password</label>
            <input id="password_confirmation" type="password" name="password_confirmation" required placeholder="Repeat your password">
        </div>
        <button type="submit" class="register-btn">Register</button>
    </form>
    <a href="{{ route('user.login') }}" class="register-link">Already have an account? Log in</a>
</div>
@endsection
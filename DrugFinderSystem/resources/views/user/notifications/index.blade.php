@extends('layouts.users')
@section('content')
<style>
    body {
        background-image: url("{{ asset('images/hospital7.jpg') }}");
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

    .notification-title {
        text-align: center;
        margin-top: 40px;
        margin-bottom: 40px;
        font-weight: 800;
        letter-spacing: 1.5px;
        color: #2d3748;
        text-shadow: 0 2px 12px #b3d8ff;
        font-size: 2.2rem;
        animation: fadeInDown 1s;
    }

    .notification-row {
        display: flex;
        flex-wrap: wrap;
        justify-content: center;
        align-items: stretch;
        animation: fadeIn 1.2s;
    }

    .notification-card {
        min-width: 340px;
        max-width: 440px;
        margin: 22px;
        border-radius: 22px;
        border: 3px solid transparent;
        background: linear-gradient(120deg, #fff 85%, #e3f0ff 100%) padding-box,
            linear-gradient(120deg, #7fbcff, #ff6ec4, #7fbcff) border-box;
        box-shadow: 0 8px 32px 0 rgba(44, 62, 80, 0.17), 0 1.5px 8px #7fbcff44;
        transition: transform 0.22s cubic-bezier(0.4, 0.2, 0.2, 1), box-shadow 0.22s, border-color 0.22s;
        position: relative;
        overflow: hidden;
        animation: glowIn 1.3s;
    }

    .notification-card:hover {
        transform: translateY(-7px) scale(1.035);
        box-shadow: 0 16px 48px 0 #7fbcff66, 0 2px 16px #ff6ec488;
        border-color: #ff6ec4;
        z-index: 2;
    }

    .notification-card::before {
        content: "";
        position: absolute;
        inset: -4px;
        z-index: 0;
        border-radius: 26px;
        background: linear-gradient(120deg, #7fbcff 0%, #ff6ec4 100%);
        filter: blur(18px);
        opacity: 0.14;
        pointer-events: none;
        transition: opacity 0.3s;
    }

    .notification-card:hover::before {
        opacity: 0.28;
    }

    .notification-pill-img {
        margin-right: 20px;
        border-radius: 16px;
        background: linear-gradient(135deg, #e3f0ff 60%, #f9eaff 100%);
        padding: 10px;
        box-shadow: 0 2px 12px #7fbcff33;
        animation: popIn 0.7s;
    }

    .notification-card-title {
        font-size: 1.35rem;
        font-weight: 700;
        color: #2074d4;
        margin-bottom: 4px;
        letter-spacing: 0.5px;
        text-shadow: 0 1px 6px #b3d8ff44;
        animation: fadeInRight 1s;
    }

    .notification-card-fields {
        font-size: 1.07em;
        color: #444;
        margin-bottom: 8px;
        font-weight: 500;
        line-height: 1.6;
        text-align: center;
    }

    .notification-meta {
        font-size: 0.99em;
        color: #7fbcff;
        margin-bottom: 2px;
        font-weight: 600;
    }

    .notification-meta strong {
        color: #ff6ec4;
        font-weight: 700;
    }

    .alert-info {
        background: linear-gradient(90deg, #e3f0ff 60%, #f9eaff 100%);
        border: none;
        color: #2074d4;
        font-weight: 600;
        box-shadow: 0 2px 12px #7fbcff22;
    }

    /* Animations */
    @keyframes fadeIn {
        from {
            opacity: 0;
            transform: translateY(30px);
        }

        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    @keyframes fadeInDown {
        from {
            opacity: 0;
            transform: translateY(-30px);
        }

        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    @keyframes fadeInRight {
        from {
            opacity: 0;
            transform: translateX(30px);
        }

        to {
            opacity: 1;
            transform: translateX(0);
        }
    }

    @keyframes popIn {
        0% {
            transform: scale(0.7);
            opacity: 0;
        }

        80% {
            transform: scale(1.08);
        }

        100% {
            transform: scale(1);
            opacity: 1;
        }
    }

    @keyframes glowIn {
        0% {
            box-shadow: 0 0 0 #fff0;
        }

        100% {
            box-shadow: 0 8px 32px 0 #7fbcff2a, 0 1.5px 8px #ff6ec444;
        }
    }
</style>
<div class="container">
    <h2 class="notification-title">✨ New Drug Notifications ✨</h2>
    @if($newDrugs->count())
    <div class="notification-row">
        @foreach($newDrugs as $drug)
        <div class="card notification-card">
            <div class="card-body d-flex align-items-start">
                <img src="https://img.icons8.com/color/96/pill.png" alt="{{ $drug->name }}" width="64" height="64" class="notification-pill-img" />
                <div>
                    <div class="notification-card-title">{{ $drug->name }}</div>
                    <div class="notification-meta">
                        <span>Added {{ $drug->created_at->diffForHumans() }}</span>
                    </div>
                    <div class="notification-card-fields">
                        <div><strong>Brand:</strong> {{ $drug->brand }}</div>
                        <div><strong>Category:</strong> {{ $drug->category }}</div>
                        <div><strong>Dosage Form:</strong> {{ $drug->dosage_form }}</div>
                        <div><strong>Strength:</strong> {{ $drug->strength }}</div>
                        <div><strong>Quantity:</strong> {{ $drug->quantity }}</div>
                        <div><strong>Price:</strong> {{ $drug->price }}</div>
                        <div><strong>Expiry Date:</strong> {{ \Carbon\Carbon::parse($drug->expiry_date)->format('F d, Y') }}</div>
                        <div><strong>Description:</strong> {{ $drug->description }}</div>
                    </div>
                </div>
            </div>
        </div>
        @endforeach
    </div>
    @else
    <div class="alert alert-info text-center my-5" style="font-size:1.1em;">
        No new drugs have been added since your last visit.
    </div>
    @endif
</div>
@endsection
@extends('layouts.users')

@section('content')
<div class="container py-4">
    <h2 class="mb-4"><i class="fa fa-heart text-danger"></i> My Wishlist</h2>
    @if(session('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    @if($wishlists->count())
    <div class="wishlist-grid">
        @foreach($wishlists as $item)
        <div class="wishlist-card">
            <div>
                <h5 class="drug-name mb-2">
                    {{ optional($item->drug)->name ?? 'Drug not available' }}
                </h5>
                <div class="text-muted mb-1">
                    {{ optional($item->drug)->brand ?? '-' }}
                </div>
                <div>
                    <strong>Seller:</strong>
                    {{ optional($item->drug->seller)->shop_name ?? optional($item->drug->seller)->name ?? 'No seller info' }}
                </div>
                <div>
                    <strong>Price:</strong>
                    <span class="badge badge-pill badge-info">
                        ETB {{ number_format(optional($item->drug)->price ?? 0, 2) }}
                    </span>
                </div>
                <div>
                    <strong>Stock:</strong>
                    <span class="badge badge-pill badge-info">
                        {{ optional($item->drug)->quantity ?? 0 }} available
                    </span>
                </div>
                <div class="mt-2">
                    <form method="POST" action="{{ route('user.wishlist.update', $item) }}" class="d-inline">
                        @csrf @method('PATCH')
                        <input type="text" name="prescription_note" value="{{ $item->prescription_note }}" class="form-control form-control-sm mb-1" placeholder="Prescription note/refill reminder...">
                        <button class="btn btn-sm btn-outline-primary">Save Note</button>
                    </form>
                </div>
            </div>
            <form method="POST" action="{{ route('user.wishlist.destroy', $item) }}">
                @csrf @method('DELETE')
                <button class="btn btn-sm btn-danger mt-2"><i class="fa fa-trash"></i> Remove</button>
            </form>
        </div>
        @endforeach

    </div>
    @else
    <div class="alert alert-info">Your wishlist is empty. Browse drugs and add them to your wishlist!</div>
    @endif
</div>
@endsection



@push('styles')
<style>
    /* ======= All your CSS goes here, inside ONE <style> tag ======= */

    body {
        background-image: url("{{ asset('images/hospital1.jpg') }}");
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

    .container.py-4 {
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
        min-height: 90vh;
    }

    h2 {
        font-size: 2.5rem;
        color: blueviolet;
        text-align: center;
        margin-bottom: 1.5rem;
    }

    .wishlist-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(320px, 1fr));
        gap: 2.5rem 2rem;
        justify-items: center;
        align-items: center;
        width: 100%;
        max-width: 1200px;
        margin: 0 auto;
        padding: 2rem 0;
    }

    @media (max-width: 900px) {
        .wishlist-grid {
            grid-template-columns: repeat(2, 1fr);
        }
    }

    @media (max-width: 600px) {
        .wishlist-grid {
            grid-template-columns: 1fr;
        }
    }

    .wishlist-card {
        background: rgba(255, 255, 255, 0.92);
        border-radius: 22px;
        box-shadow: 0 6px 32px 0 rgba(54, 209, 196, 0.12), 0 2px 8px rgba(91, 134, 229, 0.14);
        border: 2.5px solid transparent;
        padding: 1.8rem 1.4rem 1.4rem 1.4rem;
        min-height: 270px;
        width: 100%;
        max-width: 370px;
        display: flex;
        flex-direction: column;
        justify-content: space-between;
        position: relative;
        transition:
            box-shadow 0.35s cubic-bezier(.23, 1.01, .32, 1),
            border-color 0.28s,
            transform 0.32s cubic-bezier(.23, 1.01, .32, 1),
            filter 0.28s;
        animation: fadeInCard 0.8s;
        overflow: hidden;
    }

    @keyframes fadeInCard {
        from {
            opacity: 0;
            transform: scale(0.96) translateY(40px);
        }

        to {
            opacity: 1;
            transform: none;
        }
    }

    .wishlist-card:hover {
        border-color: #36d1c4;
        box-shadow:
            0 0 28px 4px #36d1c4bb,
            0 20px 64px 0 rgba(54, 209, 196, 0.22),
            0 6px 24px rgba(161, 140, 209, 0.18);
        transform: scale(1.048) rotate(-1deg);
        filter: brightness(1.05) saturate(1.12);
        animation: glowPulse 1.1s;
    }

    @keyframes glowPulse {
        0% {
            box-shadow: 0 0 0 0 #36d1c400;
        }

        60% {
            box-shadow: 0 0 38px 10px #36d1c4aa;
        }

        100% {
            box-shadow: 0 0 28px 4px #36d1c4bb;
        }
    }

    .drug-name {
        color: #2575fc;
        font-weight: 800;
        font-size: 1.18em;
        letter-spacing: 0.5px;
        text-shadow: 0 2px 8px #36d1c433;
    }

    .badge-info {
        background: linear-gradient(90deg, #36d1c4 0%, #a18cd1 100%);
        color: #fff;
        font-weight: 700;
        border-radius: 16px;
        padding: 1px 10px;
        font-size: 1em;
        margin-right: 4px;
        box-shadow: 0 2px 8px #5b86e522;
        border: none;
    }

    .form-control.form-control-sm {
        border-radius: 10px;
        border: 1.5px solid #a18cd1;
        font-size: 1em;
        padding: 7px 12px;
        margin-bottom: 0.5em;
        background: rgba(255, 255, 255, 0.85);
        transition: border-color 0.18s, box-shadow 0.18s;
    }

    .form-control.form-control-sm:focus {
        border-color: #2575fc;
        box-shadow: 0 0 8px #a18cd155;
    }

    .btn-outline-primary {
        border-radius: 8px;
        font-weight: 600;
        font-size: 0.98em;
        border: 1.7px solid #2575fc;
        color: #2575fc;
        background: #fff;
        transition: background 0.18s, color 0.18s, box-shadow 0.18s;
    }

    .btn-outline-primary:hover,
    .btn-outline-primary:focus {
        background: linear-gradient(90deg, #36d1c4 0%, #a18cd1 100%);
        color: #fff;
        border-color: #a18cd1;
        box-shadow: 0 0 12px #a18cd155;
    }

    .btn-danger {
        border-radius: 8px;
        font-weight: 600;
        border: none;
        background: linear-gradient(90deg, #ff5858 0%, #f09819 100%);
        color: #fff;
        box-shadow: 0 2px 8px #ff585833;
        transition: background 0.18s, box-shadow 0.18s, transform 0.15s;
    }

    .btn-danger:hover,
    .btn-danger:focus {
        background: linear-gradient(90deg, #f09819 0%, #ff5858 100%);
        color: #fff;
        transform: scale(1.07);
        box-shadow: 0 4px 18px #ff585855;
    }

    .alert {
        max-width: 500px;
        margin: 1.5rem auto;
        border-radius: 12px;
        font-size: 1.04em;
        box-shadow: 0 2px 10px #36d1c422;
        text-align: center;
    }

    @media (max-width: 400px) {
        .wishlist-card {
            padding: 1.1rem 0.5rem;
        }
    }
</style>
@endpush
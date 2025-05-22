@extends('layouts.users')

@section('content')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css"/>

<style>
/* Container background */
.compare-bg {
    background: linear-gradient(135deg, #e0e7ff 0%, #f7faff 100%);
    padding: 2rem 1rem 3rem;
    border-radius: 16px;
    max-width: 1100px;
    margin: 2rem auto 4rem;
    box-shadow: 0 8px 24px rgba(37, 117, 252, 0.12);
    font-family: 'Poppins', sans-serif;
    color: #2c3e50;
}

/* Title and badges */
.compare-bg > .mb-4 {
    font-weight: 700;
    font-size: 1.6rem;
    color: #2575fc;
    text-shadow: 0 2px 8px #6a11cb22;
    display: flex;
    justify-content: center;
    align-items: center;
    gap: 0.6rem;
    flex-wrap: wrap;
}
.compare-bg .badge {
    font-size: 0.85rem;
    font-weight: 600;
    padding: 0.3em 0.7em;
    border-radius: 12px;
    display: flex;
    align-items: center;
    gap: 0.3rem;
    box-shadow: 0 2px 6px rgba(37,117,252,0.1);
    transition: background-color 0.3s ease;
}
.badge-info {
    background-color: #36a2f5;
    color: #fff;
}
.badge-info i {
    color: #d0e8ff;
}
.badge-primary {
    background-color: #2575fc;
    color: #fff;
}
.badge-primary i {
    color: #b3d1ff;
}
.badge-success {
    background-color: #43cea2;
    color: #fff;
}
.badge-success i {
    color: #c5f3dd;
}

/* Table styles */
.compare-table {
    width: 100%;
    border-collapse: separate;
    border-spacing: 0 0.6rem;
    font-size: 1rem;
    color: #34495e;
    overflow-x: auto;
}
.compare-table thead th {
    background: linear-gradient(90deg, #2575fc, #6a11cb);
    color: #fff;
    font-weight: 700;
    padding: 0.9rem 1.2rem;
    text-align: left;
    border-radius: 12px 12px 0 0;
    user-select: none;
    white-space: nowrap;
}
.compare-table tbody tr {
    background: #fff;
    box-shadow: 0 4px 12px rgb(37 117 252 / 0.1);
    border-radius: 14px;
    transition: transform 0.3s ease, box-shadow 0.3s ease;
    cursor: default;
}
.compare-table tbody tr:hover {
    transform: translateY(-4px);
    box-shadow: 0 10px 30px rgb(37 117 252 / 0.25);
}
.compare-table tbody tr.best-offer {
    border-left: 6px solid #43cea2;
    background: #e6f9f2;
    font-weight: 600;
}
.compare-table tbody tr.best-offer:hover {
    background: #d0f2e6;
}
.compare-table td, .compare-table th {
    padding: 1rem 1.2rem;
    vertical-align: middle;
    white-space: nowrap;
}
.compare-table td.pharmacy-name i,
.compare-table td i {
    margin-right: 0.5rem;
    color: #2575fc;
}

/* Price cell */
.price-cell {
    font-weight: 600;
    color: #2575fc;
    display: flex;
    align-items: center;
    gap: 0.4rem;
}
.price-cell .badge-success {
    font-size: 0.85em;
    padding: 0.25em 0.5em;
    border-radius: 10px;
    box-shadow: 0 2px 8px rgba(67,206,162,0.2);
    animation: pulseBadge 2.5s infinite;
}
@keyframes pulseBadge {
    0%, 100% { box-shadow: 0 2px 8px rgba(67,206,162,0.2); }
    50% { box-shadow: 0 4px 16px rgba(67,206,162,0.4); }
}

/* Rating stars */
.rating-stars i {
    color: #f1c40f;
    margin-right: 2px;
    font-size: 1.1rem;
}
.rating-stars .text-muted {
    font-style: italic;
    color: #95a5a6;
}

/* Order form */
.order-form {
    gap: 0.5em;
    display: flex;
    align-items: center;
}
.order-form input[type="number"] {
    width: 60px;
    padding: 0.25rem 0.5rem;
    font-size: 0.9rem;
    border: 1px solid #ccc;
    border-radius: 6px;
    transition: border-color 0.3s ease;
}
.order-form input[type="number"]:focus {
    border-color: #2575fc;
    outline: none;
    box-shadow: 0 0 6px #2575fc88;
}
.buy-btn {
    background: linear-gradient(90deg, #2575fc, #6a11cb);
    color: white;
    border: none;
    padding: 0.35rem 0.9rem;
    border-radius: 8px;
    font-weight: 600;
    font-size: 0.9rem;
    cursor: pointer;
    display: flex;
    align-items: center;
    gap: 0.4rem;
    transition: background 0.3s ease, box-shadow 0.3s ease;
}
.buy-btn:hover:not(:disabled) {
    background: linear-gradient(90deg, #6a11cb, #2575fc);
    box-shadow: 0 4px 12px rgba(37,117,252,0.5);
}
.buy-btn:disabled {
    background: #a0a0a0;
    cursor: not-allowed;
}
.order-loader i {
    font-size: 1.2rem;
    color: #2575fc;
}

/* Responsive */
@media (max-width: 768px) {
    .compare-bg {
        padding: 1rem 0.5rem 2rem;
        margin: 1rem auto 3rem;
    }
    .compare-table thead th,
    .compare-table tbody td {
        padding: 0.6rem 0.8rem;
        font-size: 0.9rem;
    }
    .order-form input[type="number"] {
        width: 50px;
    }
    .buy-btn {
        font-size: 0.85rem;
        padding: 0.3rem 0.7rem;
    }
}
</style>

<div class="compare-bg">
    <div class="mb-4 text-center">
        <span>
            <i class="fas fa-capsules"></i> {{ $drug->name }}
        </span>
        @if($drug->brand)
            <span class="badge badge-info ml-2"><i class="fas fa-copyright"></i> {{ $drug->brand }}</span>
        @endif
        @if($drug->strength)
            <span class="badge badge-primary ml-2"><i class="fas fa-vial"></i> {{ $drug->strength }}</span>
        @endif
        @if($drug->dosage_form)
            <span class="badge badge-success ml-2"><i class="fas fa-pills"></i> {{ $drug->dosage_form }}</span>
        @endif
    </div>
    <table class="table table-striped table-hover table-bordered shadow-sm compare-table">
        <thead>
            <tr>
                <th><i class="fas fa-store"></i> Pharmacy</th>
                <th><i class="fas fa-map-marker-alt"></i> Location</th>
                <th><i class="fas fa-cubes"></i> Quantity</th>
                <th><i class="fas fa-money-bill-wave"></i> Price</th>
                <th><i class="fas fa-star"></i> Rating</th>
                <th>Order</th>
            </tr>
        </thead>
        <tbody>
            @forelse($offers as $offer)
            <tr @if($loop->first) class="best-offer" @endif>
                <td class="pharmacy-name">
                    <i class="fas fa-hospital-symbol"></i>
                    {{ $offer->seller->shop_name ?? $offer->seller->name ?? 'N/A' }}
                </td>
                <td>
                    <i class="fas fa-map-marker-alt"></i>
                    {{ $offer->seller->address ?? $offer->seller->city ?? 'N/A' }}
                </td>
                <td>
                    <i class="fas fa-cubes"></i>
                    {{ $offer->quantity }}
                </td>
                <td class="price-cell">
                    <i class="fas fa-dollar-sign"></i>
                    {{ number_format($offer->price,2) }}
                    @if($loop->first)
                        <span class="badge badge-success ml-1"><i class="fas fa-trophy"></i> Best Price</span>
                    @endif
                </td>
                <td class="rating-stars">
                    @for($i=0; $i<round($offer->rating ?? 0); $i++)
                        <i class="fas fa-star"></i>
                    @endfor
                    @if(($offer->rating ?? 0) == 0)
                        <span class="text-muted">No ratings</span>
                    @endif
                </td>
                <td>
                    <form class="order-form" style="gap:0.5em;">
                        <input type="number" name="quantity" min="1" max="{{ $offer->quantity }}" value="1"
                               class="form-control form-control-sm" title="Select quantity" required>
                        <button type="submit" class="buy-btn" data-drug-id="{{ $offer->id }}">
                            <i class="fas fa-cart-plus"></i> Buy
                        </button>
                        <span class="order-loader" style="display:none;">
                            <i class="fas fa-spinner fa-spin"></i>
                        </span>
                    </form>
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="6" class="text-center text-muted" style="background:rgba(255,255,255,0.85)">
                    <i class="fas fa-exclamation-triangle"></i> No offers found for this drug.
                </td>
            </tr>
            @endforelse
        </tbody>
    </table>
</div>

<script>
document.addEventListener('DOMContentLoaded', function () {
    document.querySelectorAll('.order-form').forEach(function(form) {
        form.addEventListener('submit', function(e) {
            e.preventDefault();
            let btn = form.querySelector('.buy-btn');
            let loader = form.querySelector('.order-loader');
            let quantity = form.querySelector('input[name="quantity"]').value;
            let drugId = btn.getAttribute('data-drug-id');
            btn.disabled = true;
            loader.style.display = 'inline-block';

            fetch('/user/orders', {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}',
                    'Content-Type': 'application/json'
                },
                body: JSON.stringify({ drug_id: drugId, quantity: quantity })
            })
            .then(response => response.json())
            .then(data => {
                btn.disabled = false;
                loader.style.display = 'none';
                if(data.success) {
                    btn.innerHTML = '<i class="fas fa-check"></i> Ordered!';
                    btn.classList.add('btn-success');
                    setTimeout(() => {
                        btn.innerHTML = '<i class="fas fa-cart-plus"></i> Buy';
                        btn.classList.remove('btn-success');
                    }, 2000);
                } else {
                    alert('Could not place order: ' + (data.message || 'Unknown error'));
                }
            })
            .catch(() => {
                btn.disabled = false;
                loader.style.display = 'none';
                alert('Something went wrong. Please try again.');
            });
        });
    });
});
</script>
@endsection

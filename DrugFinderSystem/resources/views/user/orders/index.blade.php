@extends('layouts.users')

@section('content')
<div class="container py-4">
    <h2 class="mb-4 text-primary fw-bold text-center">Your Order History</h2>
    <div class="card shadow-sm rounded-4 border-0 glass-card">
        <div class="card-body p-0 glass-card-body">
            <div class="table-responsive">
                <table class="table order-history-table mb-0">
                    <thead>
                        <tr>
                            <th>Order ID</th>
                            <th>Pharmacy Name</th>
                            <th>Items</th>
                            <th>Total</th>
                            <th>Status</th>
                            <th>Date</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($orders as $order)
                        <tr class="fade-slide-in">
                            <td data-label="Order ID">#{{ $order->id }}</td>
                            <td data-label="Pharmacy Name">{{ optional($order->seller)->shop_name ?? 'N/A' }}</td>
                            <td data-label="Items">
                                @foreach ($order->items as $item)
                                <div class="order-item">
                                    {{ optional($item->drug)->name ?? 'Unknown Drug' }} 
                                    <span class="text-muted">(x{{ $item->quantity }})</span> 
                                    @ <span class="text-primary fw-semibold">${{ number_format($item->price, 2) }}</span>
                                </div>
                                @endforeach
                            </td>
                            <td data-label="Total" class="fw-semibold text-primary">${{ number_format($order->total, 2) }}</td>
                            <td data-label="Status">
                                <span class="badge status-badge status-{{ strtolower($order->status) }}">
                                    {{ ucfirst($order->status) }}
                                </span>
                            </td>
                            <td data-label="Date">{{ $order->created_at->format('d M Y, H:i') }}</td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="6" class="text-center text-muted py-4">
                                No orders found
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            {{-- Custom simple Previous / Next pagination --}}
            <div class="pagination-wrapper px-3 py-3 d-flex justify-content-center">
                @if ($orders->onFirstPage())
                <span class="page-link disabled">Previous</span>
                @else
                <a href="{{ $orders->previousPageUrl() }}" class="page-link">Previous</a>
                @endif

                <span class="page-info mx-3">Page {{ $orders->currentPage() }} of {{ $orders->lastPage() }}</span>

                @if ($orders->hasMorePages())
                <a href="{{ $orders->nextPageUrl() }}" class="page-link">Next</a>
                @else
                <span class="page-link disabled">Next</span>
                @endif
            </div>
        </div>
    </div>
</div>


<style>
    body {
        background-image: url("{{ asset('images/hospital4.jpg') }}");
        background-size: cover;
        background-position: center;
        background-repeat: no-repeat;
        min-height: 100vh;
        margin: 0;
        animation: bgFadeIn 2s ease forwards;
        position: relative;
    }

    @keyframes bgFadeIn {
        from {
            opacity: 0;
        }

        to {
            opacity: 1;
        }
    }

    /* Glassmorphism card effect */
    .glass-card,
    .glass-card-body {
        background: rgba(255, 255, 255, 0.06) !important;
        box-shadow: 0 8px 32px 0 rgba(31, 38, 135, 0.15);
        backdrop-filter: blur(6px);
        -webkit-backdrop-filter: blur(6px);
        border-radius: 20px;
        border: 1px solid rgba(255, 255, 255, 0.18);
    }

    /* Container max width */
    .container.py-4 {
        max-width: 1100px;
    }

    /* Typography */
    h2.text-primary {
        color: #2575fc;
        letter-spacing: 0.05em;
        text-shadow: 0 2px 8px rgba(100, 150, 255, 0.06);
    }

    /* Table base */
    .order-history-table {
        width: 100%;
        border-collapse: separate;
        border-spacing: 0 12px;
        font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        font-size: 0.97rem;
        color: rgb(2, 10, 19);
        background: transparent;
    }

    /* Table header */
    .order-history-table thead tr {
        background-color: rgba(13, 244, 159, 0.97);
        border-radius: 12px;
        box-shadow: inset 0 -2px 5px rgba(0, 0, 0, 0.05);
        backdrop-filter: blur(2px);
        -webkit-backdrop-filter: blur(2px);
    }

    .order-history-table thead th {
        padding: 12px 18px;
        font-weight: 700;
        color: #2575fc;
        text-align: left;
        user-select: none;
        border: none;
        letter-spacing: 0.03em;
        background: transparent;
    }

    /* Table body rows */
    .order-history-table tbody tr {
        background-color: rgb(255, 255, 255);
        border-radius: 12px;
        box-shadow: 0 4px 14px rgba(37, 117, 252, 0.10);
        transition: transform 0.4s cubic-bezier(0.4, 0, 0.2, 1), box-shadow 0.4s, background 0.4s;
        cursor: default;
        border: none;
        padding: 0;
        backdrop-filter: blur(2px);
        -webkit-backdrop-filter: blur(2px);
    }

    /* Animation: fade + slide up on row load */
    .fade-slide-in {
        animation: fadeSlideUp 0.7s cubic-bezier(0.4, 0, 0.2, 1) forwards;
        opacity: 0;
        transform: translateY(24px);
    }

    @keyframes fadeSlideUp {
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    /* Hover effect on rows */
    .order-history-table tbody tr:hover {
        transform: translateY(-6px) scale(1.01);
        background-color: rgb(8, 152, 242);
        box-shadow: 0 12px 36px rgba(37, 117, 252, 0.18);
    }

    /* Table cells */
    .order-history-table tbody td {
        padding: 12px 18px;
        vertical-align: middle;
        border: none;
        line-height: 1.3;
        background: transparent;
    }

    /* Items inside cell */
    .order-item {
        margin-bottom: 4px;
        font-weight: 500;
    }

    /* Status badges */
    .status-badge {
        padding: 7px 16px;
        font-size: 0.85rem;
        font-weight: 600;
        border-radius: 20px;
        display: inline-block;
        transition: background-color 0.3s, color 0.3s;
        user-select: none;
        white-space: nowrap;
        box-shadow: 0 1px 4px rgb(7, 82, 212);
    }

    .status-completed {
        background-color: #d4edda;
        color: #155724;
    }

    .status-cancelled {
        background-color: #f8d7da;
        color: #721c24;
    }

    .status-pending {
        background-color: #cce5ff;
        color: #004085;
    }

    /* Responsive adjustments */
    @media (max-width: 768px) {
        .order-history-table thead {
            display: none;
        }

        .order-history-table tbody tr {
            display: block;
            margin-bottom: 18px;
            box-shadow: 0 6px 18px rgba(37, 117, 252, 0.1);
            border-radius: 12px;
            padding: 18px 20px;
            background-color: rgba(255, 255, 255, 0.45);
        }

        .order-history-table tbody td {
            display: flex;
            justify-content: space-between;
            padding: 8px 0;
            border-bottom: 1px solid #eee;
            font-size: 0.95rem;
        }

        .order-history-table tbody td:last-child {
            border-bottom: none;
        }

        .order-history-table tbody td::before {
            content: attr(data-label);
            font-weight: 700;
            color: #2575fc;
            flex-basis: 40%;
            text-transform: uppercase;
            letter-spacing: 0.05em;
        }
    }

    /* Pagination wrapper */
    .pagination-wrapper {
        font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    }

    .pagination-wrapper .page-link {
        display: inline-block;
        padding: 8px 20px;
        margin: 0 6px;
        font-size: 1rem;
        font-weight: 600;
        color: #2575fc;
        border: 2px solid #2575fc;
        border-radius: 10px;
        text-decoration: none;
        user-select: none;
        background: rgba(255, 255, 255, 0.25);
        backdrop-filter: blur(2px);
        -webkit-backdrop-filter: blur(2px);
        transition: background-color 0.3s, color 0.3s, transform 0.2s;
        cursor: pointer;
        min-width: 90px;
        text-align: center;
    }

    .pagination-wrapper .page-link:hover:not(.disabled),
    .pagination-wrapper .page-link:focus:not(.disabled) {
        background-color: #2575fc;
        color: #fff;
        transform: scale(1.1);
        outline: none;
    }

    .pagination-wrapper .page-link.disabled {
        border-color: #ccc;
        color: #ccc;
        background: rgba(255, 255, 255, 0.15);
        cursor: not-allowed;
        transform: none;
    }

    .pagination-wrapper .page-info {
        font-weight: 600;
        font-size: 1rem;
        color: #555;
        align-self: center;
    }
</style>
@endsection
@extends('layouts.admin')

@section('content')
<div class="container mt-4">
    <h2 class="text-center mb-4">Orders Management</h2>
    <table class="table table-bordered table-hover">
        <thead>
            <tr>
                <th>ID</th>
                <th>User</th>
                <th>Seller</th>
                <th>Ordered Drugs</th>
                <th>Status</th>
                <th>Total</th>
                <th>Ordered At</th>
            </tr>
        </thead>
        <tbody>
            @foreach($orders as $order)
                <tr>
                    <td>{{ $order->id }}</td>
                    <td>{{ $order->user->name ?? '-' }}</td>
                    <td>{{ $order->seller->name ?? '-' }}</td>
                    <td>
                        @if($order->items->count())
                            <ul class="mb-0 ps-3">
                                @foreach($order->items as $item)
                                    <li>
                                        {{ $item->drug->name ?? '-' }} (Qty: {{ $item->quantity }})
                                    </li>
                                @endforeach
                            </ul>
                        @else
                            -
                        @endif
                    </td>
                    <td>{{ $order->status ?? '-' }}</td>
                    <td>{{ $order->total ?? '-' }}</td>
                    <td>{{ $order->created_at->format('Y-m-d') }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <!-- Pagination Buttons -->
    <div class="d-flex justify-content-center mt-3">
        @if ($orders->onFirstPage())
            <button class="btn btn-secondary me-2" disabled>Previous</button>
        @else
            <a href="{{ $orders->previousPageUrl() }}" class="btn btn-primary me-2">Previous</a>
        @endif

        @if ($orders->hasMorePages())
            <a href="{{ $orders->nextPageUrl() }}" class="btn btn-primary">Next</a>
        @else
            <button class="btn btn-secondary" disabled>Next</button>
        @endif
    </div>
</div>
@endsection

<style>
    h2 {
        text-align: center;
    }
</style>

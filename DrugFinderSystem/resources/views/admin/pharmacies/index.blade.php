<!-- File: resources/views/admin/pharmacies/index.blade.php -->

@extends('layouts.admin')

@section('content')
<div class="container mt-4">
    <h2>Pharmacies Management</h2>
    <table class="table table-bordered table-hover mt-3">
        <thead>
            <tr>
                <th>ID</th>
                <th>Pharmacy Name</th>
                <th>Email</th>
                <th>Registered At</th>
            </tr>
        </thead>
        <tbody>
            @forelse($pharmacies as $pharmacy)
                <tr>
                    <td>{{ $shop_id->id }}</td>
                    <td>{{ $shop_name->company_name ?? $pharmacy->company_name ?? '-' }}</td>
                    <td>{{ $email->email }}</td>
                    <td>{{ $pharmacy->created_at->format('Y-m-d') }}</td>
                </tr>
            @empty
                <tr>
                    <td colspan="4" class="text-center">No pharmacies found.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
    {{ $pharmacies->links() }}
</div>
@endsection

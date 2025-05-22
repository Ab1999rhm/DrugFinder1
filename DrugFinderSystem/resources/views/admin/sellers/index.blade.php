@extends('layouts.admin')
@section('content')
<div class="container mt-4">
    <h2>Sellers Management</h2>
    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif
    <table class="table table-bordered table-hover mt-3">
        <thead>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Email</th>
                <th>Status</th>
                <th>Registered At</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($sellers as $seller)
                <tr>
                    <td>{{ $seller->id }}</td>
                    <td>{{ $seller->name }}</td>
                    <td>{{ $seller->email }}</td>
                    <td>
                        @if($seller->status === 'approved')
                            <span class="badge badge-success">Approved</span>
                        @else
                            <span class="badge badge-secondary">Pending</span>
                        @endif
                    </td>
                    <td>{{ $seller->created_at->format('Y-m-d') }}</td>
                    <td>
                        @if($seller->status !== 'approved')
                            <form action="{{ route('admin.sellers.approve', $seller->id) }}" method="POST" style="display:inline-block;">
                                @csrf
                                @method('PATCH')
                                <button class="btn btn-sm btn-success" onclick="return confirm('Approve this seller?')">Approve</button>
                            </form>
                        @endif
                        <a href="{{ route('admin.sellers.edit', $seller->id) }}" class="btn btn-sm btn-warning">Edit</a>
                        <form action="{{ route('admin.sellers.delete', $seller->id) }}" method="POST" style="display:inline-block;" onsubmit="return confirm('Delete this seller?');">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-sm btn-danger">Delete</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
    {{ $sellers->links() }}
</div>
@endsection
<style>
    h2{
        text-align: center;
    }
</style>
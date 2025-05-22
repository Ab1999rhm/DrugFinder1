@extends('layouts.admin')

@section('content')
<div class="container mt-4">
    <h2>Users Management</h2>

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
            @foreach($users as $user)
                <tr>
                    <td>{{ $user->id }}</td>
                    <td>{{ $user->name }}</td>
                    <td>{{ $user->email }}</td>
                    <td>
                        @if($user->status === 'approved')
                            <span class="badge badge-success">Approved</span>
                        @else
                            <span class="badge badge-secondary">Pending</span>
                        @endif
                    </td>
                    <td>{{ $user->created_at->format('Y-m-d') }}</td>
                    <td>
                        <!-- @if($user->status !== 'approved')
                            <form action="{{ route('admin.users.approve', $user->id) }}" method="POST" style="display:inline-block;">
                                @csrf
                                @method('PATCH')
                                <button class="btn btn-sm btn-success" onclick="return confirm('Approve this user?')">Approve</button>
                            </form>
                        @endif -->
                        <form action="{{ route('admin.users.delete', $user->id) }}" method="POST" style="display:inline-block;" onsubmit="return confirm('Are you sure you want to remove this user?');">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-sm btn-danger">Remove</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
    {{ $users->links() }}
</div>
@endsection
<style>
    h2{
        text-align: center;
    }
</style>
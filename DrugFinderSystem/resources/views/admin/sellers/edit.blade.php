@extends('layouts.admin')
@section('content')
<div class="container mt-4">
    <h2>Edit Seller: {{ $seller->name }}</h2>
    <form action="{{ route('admin.sellers.update', $seller->id) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="form-group">
            <label>Name</label>
            <input type="text" name="name" value="{{ old('name', $seller->name) }}" class="form-control" required>
        </div>
        <div class="form-group">
            <label>Email</label>
            <input type="email" name="email" value="{{ old('email', $seller->email) }}" class="form-control" required>
        </div>
        <!-- Add other fields as needed -->
        <button type="submit" class="btn btn-primary">Update Seller</button>
        <a href="{{ route('admin.sellers') }}" class="btn btn-secondary">Cancel</a>
    </form>
</div>
@endsection

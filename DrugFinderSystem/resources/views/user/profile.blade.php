@extends('layouts.app')

@section('content')
<div class="container py-4">
    <h2>Your Profile</h2>
    <p><strong>Name:</strong> {{ $user->name }}</p>
    <p><strong>Email:</strong> {{ $user->email }}</p>
    <!-- Add more user info here -->
</div>
@endsection

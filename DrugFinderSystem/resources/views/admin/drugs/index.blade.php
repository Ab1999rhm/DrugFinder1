@extends('layouts.admin')

@section('content')
<div class="container mt-4">
    <h2>Drugs Management</h2>

    {{-- Success message --}}
    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <div class="table-responsive mt-3">
        <table class="table table-bordered table-hover">
            <thead class="thead-dark">
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Manufacturer</th>
                    <th>Created At</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($drugs as $drug)
                    <tr>
                        <td>{{ $drug->id }}</td>
                        <td>{{ $drug->name }}</td>
                        <td>{{ $drug->brand ?? '-' }}</td>
                        <td>{{ $drug->created_at->format('Y-m-d') }}</td>
                        <td>
                            {{-- Delete form --}}
                            <form action="{{ route('admin.drugs.delete', $drug->id) }}" method="POST" style="display:inline-block;" onsubmit="return confirm('Are you sure you want to delete this drug?');">
                                @csrf
                                @method('DELETE')
                                <button class="btn btn-sm btn-danger" type="submit">Delete</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <div class="d-flex justify-content-center mt-3">
        {{-- Pagination with Previous and Next buttons --}}
        {{ $drugs->links('pagination::simple-bootstrap-4') }}
    </div>
</div>
@endsection
<style>
    h2{
        text-align: center;
    }
</style>
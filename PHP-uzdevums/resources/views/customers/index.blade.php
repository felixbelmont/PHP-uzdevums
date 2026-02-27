@extends('layouts.app')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-3">
    <h1>Customers</h1>
    <a href="{{ route('customers.create') }}" class="btn btn-primary">New Customer</a>
</div>

<table class="table table-striped">
    <thead>
        <tr><th>Name</th><th>Email</th><th>Phone</th><th>Actions</th></tr>
    </thead>
    <tbody>
    @foreach($customers as $c)
        <tr>
            <td>{{ $c->name }}</td>
            <td>{{ $c->email }}</td>
            <td>{{ $c->phone }}</td>
            <td>
                <a class="btn btn-sm btn-outline-secondary" href="{{ route('customers.edit', $c) }}">Edit</a>

                <form action="{{ route('customers.destroy', $c) }}" method="POST" style="display:inline">
                    @csrf
                    @method('DELETE')
                    @can('delete', $c)
                    <button class="btn btn-sm btn-danger" onclick="return confirm('Delete this customer?')">Delete</button>
                    @endcan
                </form>
            </td>
        </tr>
    @endforeach
    </tbody>
</table>

<div class="mt-3">
    <div>
        {{ $customers->links('pagination::bootstrap-5') }}
    </div>
</div>
@endsection
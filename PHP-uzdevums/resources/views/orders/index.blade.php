@extends('layouts.app')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-3">
    <h1>Orders</h1>
    <a href="{{ route('orders.create') }}" class="btn btn-primary">New Order</a>
</div>

<form method="GET" class="row g-2 mb-3">
  <div class="col-auto">
    <select name="status" class="form-select">
      <option value="">All statuses</option>
      <option value="pending" {{ request('status')==='pending' ? 'selected' : '' }}>pending</option>
      <option value="processing" {{ request('status')==='processing' ? 'selected' : '' }}>processing</option>
      <option value="done" {{ request('status')==='done' ? 'selected' : '' }}>done</option>
      <option value="canceled" {{ request('status')==='canceled' ? 'selected' : '' }}>canceled</option>
    </select>
  </div>
  <div class="col-auto">
    <select name="customer_id" class="form-select">
      <option value="">All customers</option>
      @foreach(\App\Models\Customer::all() as $cust)
        <option value="{{ $cust->id }}" {{ request('customer_id') == $cust->id ? 'selected' : '' }}>
          {{ $cust->name }}
        </option>
      @endforeach
    </select>
  </div>
  <div class="col-auto">
    <button class="btn btn-outline-secondary">Filter</button>
    <a href="{{ route('orders.index') }}" class="btn btn-outline-light">Reset</a>
  </div>
</form>

<table class="table table-striped">
  <thead>
    <tr><th>#</th><th>Customer</th><th>Status</th><th>Total</th><th>Created</th><th>Actions</th></tr>
  </thead>
  <tbody>
    @foreach($orders as $order)
    <tr>
      <td>{{ $order->id }}</td>
      <td>{{ $order->customer->name ?? '—' }}</td>
      <td>{{ $order->status }}</td>
      <td>{{ $order->total }}</td>
      <td>{{ $order->created_at->format('Y-m-d') }}</td>
      <td>
        <a class="btn btn-sm btn-outline-secondary" href="{{ route('orders.show', $order) }}">View</a>
        @can('update', $order)
          <a class="btn btn-sm btn-secondary" href="{{ route('orders.edit', $order) }}">Edit</a>
        @endcan

        @can('delete', $order)
        <form action="{{ route('orders.destroy', $order) }}" method="POST" style="display:inline">
            @csrf
            @method('DELETE')
            <button class="btn btn-sm btn-danger" onclick="return confirm('Delete order?')">Delete</button>
        </form>
        @endcan
      </td>
    </tr>
    @endforeach
  </tbody>
</table>

<div class="mt-3">
    <div>
        {{ $orders->links('pagination::bootstrap-5') }}
    </div>
</div>
@endsection
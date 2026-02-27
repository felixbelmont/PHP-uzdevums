@extends('layouts.app')

@section('content')
<h1>Order #{{ $order->id }}</h1>

<div class="card mb-3">
  <div class="card-body">
    <p><strong>Customer:</strong> {{ $order->customer->name ?? '—' }}</p>
    <p><strong>Status:</strong> {{ $order->status }}</p>
    <p><strong>Total:</strong> {{ $order->total }}</p>
    <p><strong>Notes:</strong><br>{{ $order->notes }}</p>
    <p><strong>Created:</strong> {{ $order->created_at }}</p>
  </div>
</div>

<a href="{{ route('orders.index') }}" class="btn btn-secondary">Back</a>
@can('update', $order)
  <a href="{{ route('orders.edit', $order) }}" class="btn btn-primary">Edit</a>
@endcan
@endsection
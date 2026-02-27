@php $isEdit = isset($order); @endphp

<form method="POST" action="{{ $isEdit ? route('orders.update', $order) : route('orders.store') }}">
    @csrf
    @if($isEdit) @method('PUT') @endif

    <div class="mb-3">
        <label class="form-label">Customer</label>
        <select name="customer_id" class="form-select" required>
            <option value="">Select customer</option>
            @foreach($customers as $cust)
                <option value="{{ $cust->id }}"
                    {{ (old('customer_id', $order->customer_id ?? '') == $cust->id) ? 'selected' : '' }}>
                    {{ $cust->name }} ({{ $cust->email }})
                </option>
            @endforeach
        </select>
        @error('customer_id') <div class="text-danger small">{{ $message }}</div> @enderror
    </div>

    <div class="mb-3">
        <label class="form-label">Status</label>
        <select name="status" class="form-select" required>
            @php $status = old('status', $order->status ?? 'pending'); @endphp
            <option {{ $status === 'pending' ? 'selected' : '' }} value="pending">pending</option>
            <option {{ $status === 'processing' ? 'selected' : '' }} value="processing">processing</option>
            <option {{ $status === 'done' ? 'selected' : '' }} value="done">done</option>
            <option {{ $status === 'canceled' ? 'selected' : '' }} value="canceled">canceled</option>
        </select>
        @error('status') <div class="text-danger small">{{ $message }}</div> @enderror
    </div>

    <div class="mb-3">
        <label class="form-label">Total</label>
        <input name="total" type="number" step="0.01" class="form-control" value="{{ old('total', $order->total ?? '') }}" required>
        @error('total') <div class="text-danger small">{{ $message }}</div> @enderror
    </div>

    <div class="mb-3">
        <label class="form-label">Notes</label>
        <textarea name="notes" class="form-control">{{ old('notes', $order->notes ?? '') }}</textarea>
        @error('notes') <div class="text-danger small">{{ $message }}</div> @enderror
    </div>

    <button class="btn btn-primary">{{ $isEdit ? 'Update Order' : 'Create Order' }}</button>
    <a href="{{ route('orders.index') }}" class="btn btn-secondary">Cancel</a>
</form>
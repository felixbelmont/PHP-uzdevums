@php $isEdit = isset($customer); @endphp

<form method="POST" action="{{ $isEdit ? route('customers.update', $customer) : route('customers.store') }}">
    @csrf
    @if($isEdit) @method('PUT') @endif

    <div class="mb-3">
        <label class="form-label">Name</label>
        <input name="name" class="form-control" value="{{ old('name', $customer->name ?? '') }}" required>
        @error('name') <div class="text-danger small">{{ $message }}</div> @enderror
    </div>

    <div class="mb-3">
        <label class="form-label">Email</label>
        <input name="email" type="email" class="form-control" value="{{ old('email', $customer->email ?? '') }}" required>
        @error('email') <div class="text-danger small">{{ $message }}</div> @enderror
    </div>

    <div class="mb-3">
        <label class="form-label">Phone</label>
        <input name="phone" class="form-control" value="{{ old('phone', $customer->phone ?? '') }}">
        @error('phone') <div class="text-danger small">{{ $message }}</div> @enderror
    </div>

    <div class="mb-3">
        <label class="form-label">Address</label>
        <textarea name="address" class="form-control">{{ old('address', $customer->address ?? '') }}</textarea>
        @error('address') <div class="text-danger small">{{ $message }}</div> @enderror
    </div>

    <button class="btn btn-primary">{{ $isEdit ? 'Update' : 'Create' }}</button>
    <a href="{{ route('customers.index') }}" class="btn btn-secondary">Cancel</a>
</form>
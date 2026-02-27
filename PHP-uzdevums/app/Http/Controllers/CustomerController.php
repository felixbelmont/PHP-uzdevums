<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Customer;
use App\Http\Resources\CustomerResource;
use App\Http\Requests\UpdateCustomerRequest;
use App\Http\Requests\StoreCustomerRequest;

class CustomerController extends Controller
{
    public function index()
    {
        $this->authorize('viewAny', Customer::class);

        $customers = Customer::orderBy('created_at', 'desc')->paginate(15);

        return view('customers.index', compact('customers'));
    }

    public function create()
    {
        $this->authorize('create', Customer::class);

        return view('customers.create');
    }

    public function store(StoreCustomerRequest $request)
    {
        $this->authorize('create', Customer::class);

        Customer::create($request->validated());

        return redirect()->route('customers.index')->with('success', 'Customer created.');
    }

    public function show(Customer $customer)
    {
        $this->authorize('view', $customer);

        return view('customers.show', compact('customer'));
    }

    public function edit(Customer $customer)
    {
        $this->authorize('update', $customer);

        return view('customers.edit', compact('customer'));
    }

    public function update(UpdateCustomerRequest $request, Customer $customer)
    {
        $this->authorize('update', $customer);

        $customer->update($request->validated());

        return redirect()->route('customers.index')->with('success', 'Customer updated.');
    }

    public function destroy(Customer $customer)
    {
        $this->authorize('delete', $customer);

        $customer->delete();

        return redirect()->route('customers.index')->with('success', 'Customer deleted.');
    }
}
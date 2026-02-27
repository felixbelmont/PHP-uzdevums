<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Customer;
use App\Http\Resources\CustomerResource;

class CustomerController extends Controller
{
    public function index()
    {
        return CustomerResource::collection(Customer::with('orders')->paginate(15));
    }

    public function show($id)
    {
        $customer = Customer::with('orders')->findOrFail($id);
        return new CustomerResource($customer);
    }
}

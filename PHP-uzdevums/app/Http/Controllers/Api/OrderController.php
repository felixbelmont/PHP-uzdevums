<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Http\Resources\OrderResource;
use App\Http\Requests\StoreOrderRequest;
use Illuminate\Http\Response;

class OrderController extends Controller
{
    public function index()
    {
        $orders = Order::with('customer')->paginate(15);
        return OrderResource::collection($orders);
    }

    public function store(StoreOrderRequest $request)
    {
        $data = $request->validated();
        $data['user_id'] = auth()->id();

        $order = Order::create($data);

        return (new OrderResource($order->load('customer')))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }
}
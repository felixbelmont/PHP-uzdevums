<?php

use App\Http\Controllers\Api\CustomerController as ApiCustomerController;
use App\Http\Controllers\Api\OrderController as ApiOrderController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

Route::post('/sanctum/token', function (Request $request) {
    $request->validate([
        'email' => 'required|email',
        'password' => 'required',
        'device_name' => 'required',
    ]);

    $user = User::where('email', $request->email)->first();

    if (! $user || ! Hash::check($request->password, $user->password)) {
        return response()->json(['message' => 'Invalid credentials'], 401);
    }

    $token = $user->createToken($request->device_name)->plainTextToken;

    return response()->json(['token' => $token]);
});

Route::middleware('auth:sanctum')->group(function () {
    Route::get('/customers', [ApiCustomerController::class, 'index']);
    Route::get('/customers/{id}/orders', [ApiCustomerController::class, 'show']);
    Route::post('/orders', [ApiOrderController::class, 'store']);
    Route::get('/orders', [ApiOrderController::class, 'index']);
});
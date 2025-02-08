<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\OrderController;
use App\Models\Order;
use App\Services\DiscountService;

Route::get('/orders', [OrderController::class, 'index']);
Route::post('/orders', [OrderController::class, 'store']);
Route::get('/orders/{order}', function ($orderId) {
    $order = Order::findOrFail($orderId);
    $discountedPrice = DiscountService::applyDiscounts($order);
    return response()->json(['status' => true, 'data' => $discountedPrice ]);
});

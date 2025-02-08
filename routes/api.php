<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\OrderController;
use App\Models\Order;
use App\Services\DiscountService;

Route::get('/orders', [OrderController::class, 'index']);


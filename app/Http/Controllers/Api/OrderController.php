<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class OrderController extends Controller
{
    public function index()
    {
        return response()->json(Order::with('customer','items.product')->get());
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'customer_id' => 'required|exists:customers,id',
            'items' => 'required|array',
            'items.*.product_id' => 'required|exists:products,id',
            'items.*.quantity' => 'required|integer|min:1',
        ]);
        if ($validator->fails()) {
            return response()->json(['status' => false,'messages' => $validator->errors()]);
        }

        $totalPrice = 0;
        foreach ($request->items as $item) {
            $product = Product::find($item['product_id']);

            if ($product->stock < $item['quantity']) {
                return response()->json(['status' => false, 'message' => 'Stok yetersiz'], 400);
            }

            $totalPrice += $product->price * $item['quantity'];
            $product->stock -= $item['quantity'];
            $product->save();
        }

        $order = Order::create([
            'customer_id' => $request->customer_id,
            'total' => $totalPrice,
        ]);

        foreach ($request->items as $item) {
            $price = Product::find($item['product_id'])->price;
            OrderItem::create([
                'order_id' => $order->id,
                'product_id' => $item['product_id'],
                'quantity' => $item['quantity'],
                'unit_price' => $price,
                'total' => $item['quantity'] * $price
            ]);
        }

        return response()->json($order->load('items.product'));
    }
}

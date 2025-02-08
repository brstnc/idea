<?php
namespace App\Services;

use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Product;

class DiscountService
{
    public static function applyDiscounts(Order $order)
    {
        $totalPrice = $order->total;
        $discount = 0;

        // 1000 TL üzeri %10 indirim
        if ($totalPrice >= 1000) {
            $discount += $totalPrice * 0.10;
        }
        // Kategori ID = 2 olan ürünlerden 6 alındığında 1 ücretsiz
        $category2Products = $order->items->filter(function ($item) {
            return $item->product->category == 2;
        });

        foreach ($category2Products as $item) {
            if ($item->quantity >= 6) {
                $discount += $item->product->price;
            }
        }

        // Kategori ID = 1 olan ürünlerden 2+ alındığında en ucuz olan %20 indirimli
        $category1Products = $order->items->filter(function ($item) {
            return $item->product->category == 1;
        });

        if ($category1Products->count() >= 2) {
            $cheapestProduct = $category1Products->sortBy('unit_price')->first();
            $discount += $cheapestProduct->unit_price * 0.20;
        }

        return ['total_price' => $totalPrice, 'discount' => $discount, 'discounted_price' => $totalPrice - $discount] ;
    }
}

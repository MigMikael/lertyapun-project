<?php
namespace App\Traits;

use App\Models\Product;
use Illuminate\Support\Facades\Log;

trait PriceTrait
{
    public function getDiscountPrice(Product $product)
    {
        $discount_price = $product->price;
        foreach($product->promotions as $promotion) {
            if ($promotion->name == 'ลด 10%') {
                $discount_price = floatval($product->price) * 0.9;
            }

            if ($promotion->name == 'ลด 20%') {
                $discount_price = floatval($product->price) * 0.8;
            }

            if ($promotion->name == 'ลด 30%') {
                $discount_price = floatval($product->price) * 0.7;
            }
            // Log::info($discount_price);
        }
        return $discount_price;
    }
}

<?php
namespace App\Traits;

use App\Models\Product;
use Illuminate\Support\Facades\Log;

trait PriceTrait
{
    public function getDiscountPrice(Product $product)
    {
        $basePrice = $product->units['0']['pricePerUnit'];
        $discount_price = $basePrice;
        // Log::info($discount_price);
        foreach($product->promotions as $promotion) {
            if ($promotion->name == 'ลด 5%') {
                $discount_price = floatval($basePrice) * 0.95;
            }

            if ($promotion->name == 'ลด 10%') {
                $discount_price = floatval($basePrice) * 0.9;
            }

            if ($promotion->name == 'ลด 20%') {
                $discount_price = floatval($basePrice) * 0.8;
            }

            if ($promotion->name == 'ลด 30%') {
                $discount_price = floatval($basePrice) * 0.7;
            }
            // Log::info($discount_price);
        }
        return $discount_price;
    }

    public function getDiscountPriceByUnit(Product $product, $pricePerUnit)
    {
        foreach($product->promotions as $promotion) {
            if ($promotion->name == 'ลด 5%') {
                $discount_price = floatval($pricePerUnit) * 0.95;
            }

            if ($promotion->name == 'ลด 10%') {
                $discount_price = floatval($pricePerUnit) * 0.9;
            }

            if ($promotion->name == 'ลด 20%') {
                $discount_price = floatval($pricePerUnit) * 0.8;
            }

            if ($promotion->name == 'ลด 30%') {
                $discount_price = floatval($pricePerUnit) * 0.7;
            }
            // Log::info($discount_price);
        }
        return $discount_price;
    }
}

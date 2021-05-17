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
            // if ($promotion->name == 'ลด 5%') {
            //     $discount_price = floatval($basePrice) * 0.95;
            // }

            // if ($promotion->name == 'ลด 10%') {
            //     $discount_price = floatval($basePrice) * 0.9;
            // }

            // if ($promotion->name == 'ลด 20%') {
            //     $discount_price = floatval($basePrice) * 0.8;
            // }

            // if ($promotion->name == 'ลด 30%') {
            //     $discount_price = floatval($basePrice) * 0.7;
            // }

            if ($promotion->type == 'percent') {
                $discount_percent = floatval($promotion->name) / 100;
                $discount_rate = 1 - $discount_percent;
                $discount_price = floatval($basePrice) * $discount_rate;
            } else if ($promotion->type == 'discount') {
                $discount_price = floatval($basePrice) - floatval($promotion->name);
            }
            // Log::info($discount_price);
        }
        return $discount_price;
    }

    public function getDiscountPriceByUnit(Product $product, $pricePerUnit)
    {
        $discount_price = $pricePerUnit;
        foreach($product->promotions as $promotion) {
            // if ($promotion->name == 'ลด 5%') {
            //     $discount_price = floatval($pricePerUnit) * 0.95;
            // }

            // if ($promotion->name == 'ลด 10%') {
            //     $discount_price = floatval($pricePerUnit) * 0.9;
            // }

            // if ($promotion->name == 'ลด 20%') {
            //     $discount_price = floatval($pricePerUnit) * 0.8;
            // }

            // if ($promotion->name == 'ลด 30%') {
            //     $discount_price = floatval($pricePerUnit) * 0.7;
            // }
            if ($promotion->type == 'percent') {
                $discount_percent = floatval($promotion->name) / 100;
                $discount_rate = 1 - $discount_percent;
                $discount_price = floatval($pricePerUnit) * $discount_rate;
            } else if ($promotion->type == 'discount') {
                $discount_price = floatval($pricePerUnit) - floatval($promotion->name);
            }

            // Log::info($discount_price);
        }
        return $discount_price;
    }
}

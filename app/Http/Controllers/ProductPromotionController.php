<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\ProductPromotion;
use App\Models\Promotion;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class ProductPromotionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, $promotion_slug)
    {
        $promotion = Promotion::where('slug', $promotion_slug)->first();
        $data = $request->all();
        Log::info($data);

        if ($data['productPromotions'] != "") {
            $newProducts = json_decode($data['productPromotions'], True);
            foreach($newProducts as $newProduct) {
                $product = Product::where('slug', $newProduct['value'])->first();
                $productPromotion = [
                    'product_id' => $product->id,
                    'promotion_id' => $promotion->id
                ];
                ProductPromotion::firstOrCreate($productPromotion);
            }
        }
        return redirect()->back();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\ProductPromotion  $productPromotion
     * @return \Illuminate\Http\Response
     */
    public function show(ProductPromotion $productPromotion)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\ProductPromotion  $productPromotion
     * @return \Illuminate\Http\Response
     */
    public function edit(ProductPromotion $productPromotion)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\ProductPromotion  $productPromotion
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, ProductPromotion $productPromotion)
    {
        //
    }

    public function destroy($promotion_slug, $product_slug)
    {
        $promotion = Promotion::where('slug', $promotion_slug)->first();
        $product = Product::where('slug', $product_slug)->first();

        ProductPromotion::where('promotion_id', $promotion->id)
            ->where('product_id', $product->id)
            ->delete();
        return redirect()->back();
    }
}

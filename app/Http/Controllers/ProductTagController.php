<?php

namespace App\Http\Controllers;

use App\Models\ProductTag;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Tag;

class ProductTagController extends Controller
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
    public function store(Request $request, $tag_slug)
    {
        $tag = Tag::where('slug', $tag_slug)->first();
        $data = $request->all();

        if ($data['productTags'] != "") {
            $newProducts = json_decode($data['productTags'], True);
            foreach($newProducts as $newProduct) {
                $product = Product::where('slug', $newProduct['value'])->first();
                $productTag = [
                    'product_id' => $product->id,
                    'tag_id' => $tag->id
                ];
                ProductTag::create($productTag);
            }
        }
        return redirect()->back();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\ProductTag  $productTag
     * @return \Illuminate\Http\Response
     */
    public function show(ProductTag $productTag)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\ProductTag  $productTag
     * @return \Illuminate\Http\Response
     */
    public function edit(ProductTag $productTag)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\ProductTag  $productTag
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, ProductTag $productTag)
    {
        //
    }

    public function destroy($tag_slug, $product_slug)
    {
        $tag = Tag::where('slug', $tag_slug)->first();
        $product = Product::where('slug', $product_slug)->first();

        ProductTag::where('tag_id', $tag->id)
            ->where('product_id', $product->id)
            ->delete();
        return redirect()->back();
    }
}

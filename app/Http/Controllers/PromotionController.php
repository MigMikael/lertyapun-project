<?php

namespace App\Http\Controllers;

use App\Models\Promotion;
use Illuminate\Http\Request;
use App\Helpers\StringGenerator;
use App\Models\Product;
use Illuminate\Support\Facades\Log;


class PromotionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $page = 10;
        $sort = $request->query('sort');
        if($sort == 'name_asc') {
            $promotions = Promotion::orderBy('name', 'ASC')->paginate($page);
        } else if($sort == 'name_desc') {
            $promotions = Promotion::orderBy('name', 'DESC')->paginate($page);
        } else {
            $promotions = Promotion::orderBy('updated_at', 'DESC')->paginate($page);
        }
        return view('admin.promotion.index', ['promotions' => $promotions]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.promotion.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $newPromotion = $request->all();
        $newPromotion['slug'] = (new StringGenerator())->generateSlug();

        $newPromotion = Promotion::create($newPromotion);
        return redirect()->action([PromotionController::class, 'index']);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Promotion  $promotion
     * @return \Illuminate\Http\Response
     */
    public function show(Promotion $promotion)
    {
        $products = $promotion->products()->get();
        $productIds = $products->pluck('id');
        Log::info($productIds);
        $allProducts = Product::whereNotIn('id', $productIds)->pluck('name', 'slug');
        return view('admin.promotion.show', [
            'promotion' => $promotion,
            'products' => $products,
            'allProducts' => $allProducts,
        ]);
        // return $promotion;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Promotion  $promotion
     * @return \Illuminate\Http\Response
     */
    public function edit(Promotion $promotion)
    {
        return view('admin.promotion.edit', ['promotion' => $promotion]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Promotion  $promotion
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Promotion $promotion)
    {
        $newPromotion = $request->all();
        $promotion->update($newPromotion);
        return redirect()->action([PromotionController::class, 'index']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Promotion  $promotion
     * @return \Illuminate\Http\Response
     */
    public function destroy(Promotion $promotion)
    {
        $promotion->delete();
        return redirect()->action([PromotionController::class, 'index']);
    }
}

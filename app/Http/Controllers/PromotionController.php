<?php

namespace App\Http\Controllers;

use App\Models\Promotion;
use Illuminate\Http\Request;
use App\Helpers\StringGenerator;
use App\Models\Product;
use Illuminate\Support\Facades\Log;
use App\Traits\ValidateTrait;
use App\Models\ProductPromotion;


class PromotionController extends Controller
{
    use ValidateTrait;
    public $promotionType = [
        'discount' => 'บาท (THB)',
        //'percent' => 'เปอร์เซ็นต์ (%)'
    ];
    /**
     * Display a listing of the resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $page = 10;
        $query = $request->query('query');

        $promotions = Promotion::where("name", "like", "%".$query."%")
        ->orderBy('created_at', 'DESC')
        ->paginate($page);

        $promotions->appends(['query' => $query]);
        return view('admin.promotion.index', [
            'promotions' => $promotions,
            'search' => $query,
        ]);
    }

    /**
     * Search a listing of the resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function search(Request $request)
    {
        $request = $request->all();
        $query = $request['query'];
        return redirect("admin/promotions?query=".$query);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.promotion.create', [
            'type' => $this->promotionType,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validateCreatePromotion($request);
        $newPromotion = $request->all();
        $newPromotion['slug'] = (new StringGenerator())->generateSlug();
        $newPromotion = Promotion::create($newPromotion);
        return redirect()
            ->action([PromotionController::class, 'index'])
            ->with('success', 'Create Success');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Promotion  $promotion
     * @return \Illuminate\Http\Response
     */
    public function show(Promotion $promotion)
    {
        $ProductPromotions = ProductPromotion::All();
        $productIds = $ProductPromotions->pluck('product_id');
        $products = $promotion->products()->get();
        //$productIds = $products->pluck('id');
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
        return view('admin.promotion.edit', [
            'promotion' => $promotion,
            'type' => $this->promotionType,
        ]);
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
        return redirect()
            ->action([PromotionController::class, 'index'])
            ->with('success', 'Edit Success');
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
        return redirect()->back()->with('success', 'Delete Success');
            //->action([PromotionController::class, 'index'])
            //->with('success', 'Delete Success');
    }
}

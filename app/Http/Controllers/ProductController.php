<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use App\Helpers\StringGenerator;
use App\Models\Category;
use App\Models\Tag;
use App\Models\CategoryProduct;
use App\Models\ProductTag;
use App\Traits\ImageTrait;
use Illuminate\Support\Facades\Log;

class ProductController extends Controller
{
    use ImageTrait;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $products = Product::orderBy('updated_at', 'DESC')
            ->with('image')
            ->paginate(5);
        return view('admin.product.index', ['products' => $products]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.product.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $newProduct = $request->all();
        $newProduct['slug'] = (new StringGenerator())->generateSlug();

        if($request->hasFile('product_image')) {
            $file = $request->file('product_image');
            $product_image = $this->storeImage($file, "");
            $newProduct['image_id'] = $product_image->id;
        }

        $newProduct = Product::create($newProduct);
        return redirect()->action([ProductController::class, 'index']);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function show(Product $product)
    {
        $categories = Category::all()->pluck('name', 'slug');
        $productCategories = $product->categories()->pluck('name');

        $tags = Tag::all()->pluck('name', 'slug');
        $productTags = $product->tags()->pluck('name');

        // return $categories->toJson();
        return view('admin.product.show', [
            'product' => $product,
            'categories' => $categories,
            'productCategories' => $productCategories,
            'promotions' => $tags,
            'productPromotions' => $productTags,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function edit(Product $product)
    {
        return view('admin.product.edit', ['product' => $product]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Product $product)
    {
        $newProduct = $request->all();
        if($request->hasFile('product_image')) {
            $file = $request->file('product_image');
            $product_image = $this->storeImage($file, "");
            $newProduct['image_id'] = $product_image->id;
        }

        $product->update($newProduct);
        return redirect()->action([ProductController::class, 'index']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product $product)
    {
        $product->delete();
        return redirect()->action([ProductController::class, 'index']);
    }

    /**
     * Store new product category
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function addCategory(Request $request)
    {
        $data = $request->all();
        $product = Product::where('slug', $data['product_id'])->first();

        if ($data['categoryTag'] != "") {
            CategoryProduct::where('product_id', $product->id)->delete();

            $newCategories = json_decode($data['categoryTag'], True);
            foreach($newCategories as $newCategory) {
                $category = Category::where('slug', $newCategory['value'])->first();
                $categoryProduct = [
                    'product_id' => $product->id,
                    'category_id' => $category->id
                ];
                CategoryProduct::create($categoryProduct);
            }
        }

        return redirect("admin/products/".$product->slug);
    }

    /**
     * Store new product category
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function addTag(Request $request)
    {
        $data = $request->all();
        $product = Product::where('slug', $data['product_id'])->first();

        if ($data['promotionTag'] != "") {
            ProductTag::where('product_id', $product->id)->delete();

            $newPromotions = json_decode($data['promotionTag'], True);
            foreach($newPromotions as $newPromotion) {
                $tag = Tag::where('slug', $newPromotion['value'])->first();
                $productTag = [
                    'product_id' => $product->id,
                    'tag_id' => $tag->id
                ];
                ProductTag::create($productTag);
            }
        }

        return redirect()->back();
    }
}

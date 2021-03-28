<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use App\Helpers\StringGenerator;
use App\Models\Category;
use App\Models\Tag;
use App\Models\CategoryProduct;
use App\Models\ProductPromotion;
use App\Models\ProductTag;
use App\Models\ProductImage;
use App\Models\ProductUnit;
use App\Models\Promotion;
use App\Traits\ImageTrait;
use Illuminate\Support\Facades\Log;

class ProductController extends Controller
{
    use ImageTrait;
    public $productStatus = [
        'active' => 'Active',
        'suspend' => 'Suspend',
        'inactive' => 'Inactive',
    ];

    public $productStatusTH = [
        'active' => 'กำลังใช้งาน',
        'suspend' => 'ระงับการใช้งาน',
        'inactive' => 'ไม่ได้ใช้งาน',
    ];
    /**
     * Display a listing of the resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $page = 6;
        $sort = $request->query('sort');
        $query = $request->query('query');

        if($sort == 'name_asc') {
            $products = Product::where("name", "like", "%".$query."%")
                ->orderBy('name', 'ASC')
                ->with('image')
                ->paginate($page);
        } else if($sort == 'name_desc') {
            $products = Product::where("name", "like", "%".$query."%")
                ->orderBy('name', 'DESC')
                ->with('image')
                ->paginate($page);
        } else if($sort == 'price_asc') {
            $products = Product::where("name", "like", "%".$query."%")
                ->orderBy('price', 'ASC')
                ->with('image')
                ->paginate($page);
        } else if($sort == 'price_desc') {
            $products = Product::where("name", "like", "%".$query."%")
                ->orderBy('price', 'DESC')
                ->with('image')
                ->paginate($page);
        } else if($sort == 'quantity_asc') {
            $products = Product::where("name", "like", "%".$query."%")
                ->orderBy('quantity', 'ASC')
                ->with('image')
                ->paginate($page);
        } else if($sort == 'quantity_desc') {
            $products = Product::where("name", "like", "%".$query."%")
                ->orderBy('quantity', 'DESC')
                ->with('image')
                ->paginate($page);
        } else {
            $products = Product::where("name", "like", "%".$query."%")
                ->orderBy('updated_at', 'DESC')
                ->with('image')
                ->paginate($page);
        }
        $products->appends(['query' => $query]);
        $products->appends(['sort' => $sort]);
        return view('admin.product.index', [
            'products' => $products,
            'search' => $query,
        ]);
        // return $products;
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
        return redirect("admin/products?query=".$query);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.product.create', [
            'status' => $this->productStatusTH,
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
        $data = $request->all();

        $newProduct = [
            'slug' => (new StringGenerator())->generateSlug(),
            'name' => $data['name'],
            'description' => $data['description'],
            'weight' => $data['weight'],
            'status' => $data['status'],
            'quantity' => $data['quantity'],
        ];

        if($request->hasFile('product_image')) {
            $file = $request->file('product_image');
            $product_image = $this->storeImage($file, "");
            $newProduct['image_id'] = $product_image->id;
        }

        $product = Product::create($newProduct);

        if (count($data['unitName']) != count($data['pricePerUnit']) ||
        count($data['unitName']) != count($data['quantityPerUnit'])) {
            return redirect()
                ->action([ProductController::class, 'index'])
                ->with('fail', 'Create Fail');
        }

        for ($i=0; $i < count($data['unitName']); $i++) {
            $newProductUnit = [
                'product_id' => $product->id,
                'unitName' => $data['unitName'][$i],
                'pricePerUnit' => $data['pricePerUnit'][$i],
                'quantityPerUnit' => $data['quantityPerUnit'][$i],
            ];
            ProductUnit::create($newProductUnit);
        }


        if ($request->hasFile('additional_image')) {
            $limit = 5;
            $files = $request->file('additional_image');
            foreach ($files as $index => $file) {
                if ($index == $limit) {
                    break;
                }
                $image = $this->storeImage($file, "");
                $product_image = [
                    'product_id' => $product->id,
                    'image_id' => $image->id
                ];
               ProductImage::create($product_image);
           }
        }

        return redirect()
            ->action([ProductController::class, 'index'])
            ->with('success', 'Create Success');
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

        $promotions = Promotion::all()->pluck('name', 'slug');
        $productPromotions = $product->promotions()->pluck('name');

        $productImages = $product->detailImages()->get();

        // return $productImages;
        return view('admin.product.show', [
            'product' => $product,
            'categories' => $categories,
            'productCategories' => $productCategories,
            'promotions' => $promotions,
            'productPromotions' => $productPromotions,
            'tags' => $tags,
            'productTags' => $productTags,
            'status' => $this->productStatusTH,
            'productImages' => $productImages,
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
        $productImages = $product->detailImages()->get();

        return view('admin.product.edit', [
            'product' => $product,
            'status' => $this->productStatusTH,
            'productImages' => $productImages,
        ]);
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
        $data = $request->all();

        $newProduct = [
            'name' => $data['name'],
            'description' => $data['description'],
            'weight' => $data['weight'],
            'status' => $data['status'],
            'quantity' => $data['quantity'],
        ];

        if($request->hasFile('product_image')) {
            $file = $request->file('product_image');
            $product_image = $this->storeImage($file, "");
            $newProduct['image_id'] = $product_image->id;
        }

        $product->update($newProduct);

        if (count($data['unitName']) != count($data['pricePerUnit']) ||
        count($data['unitName']) != count($data['quantityPerUnit'])) {
            return redirect()
                ->action([ProductController::class, 'index'])
                ->with('fail', 'Create Fail');
        }

        ProductUnit::where('product_id', $product->id)->delete();
        for ($i=0; $i < count($data['unitName']); $i++) {
            $newProductUnit = [
                'product_id' => $product->id,
                'unitName' => $data['unitName'][$i],
                'pricePerUnit' => $data['pricePerUnit'][$i],
                'quantityPerUnit' => $data['quantityPerUnit'][$i]
            ];
            ProductUnit::create($newProductUnit);
        }

        if ($request->hasFile('additional_image')) {
            ProductImage::where('product_id', '=', $product->id)->delete();

            $limit = 5;
            $files = $request->file('additional_image');
            foreach ($files as $index => $file) {
                if ($index == $limit) {
                    break;
                }
                $image = $this->storeImage($file, "");
                $product_image = [
                    'product_id' => $product->id,
                    'image_id' => $image->id
                ];
                ProductImage::create($product_image);
            }
         }

        return redirect()
            ->action([ProductController::class, 'index'])
            ->with('success', 'Edit Success');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function changeStatus(Request $request, Product $product)
    {
        $newStatus = $request->get('status');
        $product->status = $newStatus;
        $product->save();

        return redirect()->back();
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
        return redirect()
            ->action([ProductController::class, 'index'])
            ->with('success', 'Delete Success');
    }

    /**
     * Store new product category
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function addPromotion(Request $request)
    {
        $data = $request->all();
        $product = Product::where('slug', $data['product_id'])->first();

        if ($data['promotionTag'] != "") {
            ProductPromotion::where('product_id', $product->id)->delete();

            $newPromotions = json_decode($data['promotionTag'], True);
            foreach($newPromotions as $newPromotion) {
                $promotion = Promotion::where('slug', $newPromotion['value'])->first();
                $productPromotion = [
                    'product_id' => $product->id,
                    'promotion_id' => $promotion->id
                ];
                ProductPromotion::create($productPromotion);
            }
        }

        return redirect()->back();
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

        return redirect()->back();
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

        if ($data['tagTag'] != "") {
            ProductTag::where('product_id', $product->id)->delete();

            $newPromotions = json_decode($data['tagTag'], True);
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

    /**
     * Display a listing of the resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function indexCustomerProduct(Request $request)
    {
        $page = 6;
        $query = "";
        $category = [];
        $category_slug = $request->query('category');
        $query = $request->query('query');

        if ($category_slug != "") {
            $category = Category::where('slug', $category_slug)->first();
            $products = $category->products()
                ->where('status', 'active')
                ->orderBy('updated_at', 'DESC')
                ->paginate($page);
        } else if ($query != "") {
            $products = Product::where('name', 'like', '%'.$query.'%')
                ->where('status', 'active')
                ->paginate($page)
                ->appends(['search' => $query]);
        } else {
            $products = Product::where('status', 'active')
                ->orderBy('updated_at', 'DESC')
                ->with('image')
                ->paginate($page);
        }

        $categories = Category::all()->pluck('name', 'slug');
        return view('customer.index', [
            'products' => $products,
            'categories' => $categories,
            'currentCategory' => $category,
            'search' => $query,
        ]);
    }

    public function searchCustomerProduct(Request $request)
    {
        $request = $request->all();
        $query = $request['query'];
        return redirect("customer/products?query=".$query);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function showCustomerProduct(Product $product)
    {
        $product = Product::where('slug', $product->slug)
            ->where('status', 'active')
            ->with('tags')
            ->first();

        $productImages = $product->detailImages()->get();

        return view('customer.show', [
            'product' => $product,
            'productImages' => $productImages,
        ]);
    }

    /**
     * Display a listing of the resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function indexCustomerPromotion(Request $request)
    {
        $products = Product::has('promotions')
            ->where('status', 'active')
            ->with('promotions')
            ->paginate(6);
        return view('customer.promotion', [
            'products' => $products
        ]);
    }

    /**
     * Display a listing of the resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function indexCustomerService(Request $request)
    {

    }
}

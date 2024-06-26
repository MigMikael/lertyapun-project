<?php

namespace App\Http\Controllers;

use App\Models\Tag;
use App\Models\Image;
use App\Models\Product;
use App\Models\Category;
use App\Models\Promotion;
use App\Models\ProductTag;
use App\Traits\ImageTrait;
use App\Models\ProductUnit;
use App\Models\ProductImage;
use Illuminate\Http\Request;
use App\Traits\ValidateTrait;
use App\Models\CategoryProduct;
use App\Helpers\StringGenerator;
use App\Models\ProductPromotion;
use Illuminate\Support\Facades\Log;

class ProductController extends Controller
{
    use ImageTrait;
    use ValidateTrait;
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

    public $productAmountStatus = [
        'all' => 'ทั้งหมด',
        'has' => 'มีสินค้า',
        'empty' => 'สินค้าหมด',
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
        $search = $request->query('query');
        $statusAmountSearch = $request->query('statusAmountSearch');
        $productStatusSearch = $request->query('productStatusSearch');

        if ($statusAmountSearch == "all") {
            $products = Product::where("status", "active")
                ->where(function ($query) use ($search) {
                    $query->where('name', 'like', '%' . $search . '%')
                        ->orWhere('keyword_search', "like", "%" . $search . "%")
                        ->orWhere('barcode', "like", "%" . $search . "%")
                        ->orderBy('created_at', 'DESC')
                        ->with('image');
                })->paginate($page);
        } else if ($statusAmountSearch == "has") {
            $products = Product::where("status", "active")
                ->where(function ($query) use ($search) {
                    $query->where('name', 'like', '%' . $search . '%')
                        ->orWhere('keyword_search', "like", "%" . $search . "%")
                        ->orWhere('barcode', "like", "%" . $search . "%")
                        ->orderBy('created_at', 'DESC')
                        ->with('image');
                })->where("products.quantity", ">", 0)->paginate($page);
        } else if ($statusAmountSearch == "empty") {
            $products = Product::where("status", "active")
                ->where(function ($query) use ($search) {
                    $query->where('name', 'like', '%' . $search . '%')
                        ->orWhere('keyword_search', "like", "%" . $search . "%")
                        ->orWhere('barcode', "like", "%" . $search . "%")
                        ->orderBy('created_at', 'DESC')
                        ->with('image');
                })->where("products.quantity", "<=", 0)->paginate($page);
        } else {
            $products = Product::where("status", "active")
                ->where(function ($query) use ($search) {
                    $query->where('name', 'like', '%' . $search . '%')
                        ->orWhere('keyword_search', "like", "%" . $search . "%")
                        ->orWhere('barcode', "like", "%" . $search . "%")
                        ->orderBy('created_at', 'DESC')
                        ->with('image');
                })->paginate($page);
        }

        if ($productStatusSearch != "" && $productStatusSearch != "active") {
            $products = Product::where("status", $productStatusSearch)
                ->where(function ($query) use ($search) {
                    $query->where('name', 'like', '%' . $search . '%')
                        ->orWhere('keyword_search', "like", "%" . $search . "%")
                        ->orWhere('barcode', "like", "%" . $search . "%")
                        ->orderBy('created_at', 'DESC')
                        ->with('image');
                })->paginate($page);
        }

        $products->appends(['query' => $search]);
        $products->appends(['statusAmountSearch' => $statusAmountSearch]);
        $products->appends(['productStatusSearch' => $productStatusSearch]);
        return view('admin.product.index', [
            'products' => $products,
            'search' => $search,
            'statusAmountSearch' => $statusAmountSearch,
            'productAmountStatus' => $this->productAmountStatus,
            'productStatusSearch' => $productStatusSearch,
            'productStatusTH' => $this->productStatusTH
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
        $statusAmountSearch = $request['statusAmountSearch'];
        $productStatusSearch = $request['productStatusSearch'];
        return redirect("admin/products?query=" . $query . "&statusAmountSearch=" . $statusAmountSearch . "&productStatusSearch=" . $productStatusSearch);
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
        $this->validateCreateProduct($request);

        $data = $request->all();

        $newProduct = [
            'slug' => '',
            'name' => $data['name'],
            'description' => $data['description'],
            'weight' => $data['weight'],
            'status' => $data['status'],
            'quantity' => $data['quantity'],
            'keyword_search' => $data['keyword_search'],
            'barcode' => $data['barcode'],
            'company_name' => $data['company_name'],
            'cost' => $data['cost']
        ];

        if ($request->hasFile('product_image')) {
            $file = $request->file('product_image');
            $product_image = $this->storeImage($file, "");
            $newProduct['image_id'] = $product_image->id;
        }

        $product = Product::create($newProduct);

        $productSlug = sprintf("%04d", $product->id);
        $product->slug = 'P-' . $productSlug;
        $product->save();

        if (
            count($data['unitName']) != count($data['pricePerUnit']) ||
            count($data['unitName']) != count($data['quantityPerUnit'])
        ) {
            return redirect()
                ->action([ProductController::class, 'index'])
                ->with('fail', 'Create Fail');
        }

        for ($i = 0; $i < count($data['unitName']); $i++) {
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
        $productPromotions = $product->promotions()->pluck('slug');

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
        $this->validateUpdateProduct($request);

        $data = $request->all();

        $newProduct = [
            'name' => $data['name'],
            'description' => $data['description'],
            'weight' => $data['weight'],
            'status' => $data['status'],
            'quantity' => $data['quantity'],
            'keyword_search' => $data['keyword_search'],
            'barcode' => $data['barcode'],
            'company_name' => $data['company_name'],
            'cost' => $data['cost']
        ];

        if ($request->hasFile('product_image')) {
            if (!is_null($product->image_id)) {
                $old_product_image = Image::Where('id', '=', $product->image_id)->first();
                $this->deleteImage($old_product_image, "");
            }

            $file = $request->file('product_image');
            $product_image = $this->storeImage($file, "");
            $newProduct['image_id'] = $product_image->id;
        }

        $product->update($newProduct);

        if (
            count($data['unitName']) != count($data['pricePerUnit']) ||
            count($data['unitName']) != count($data['quantityPerUnit'])
        ) {
            return redirect()
                ->action([ProductController::class, 'index'])
                ->with('fail', 'Create Fail');
        }

        ProductUnit::where('product_id', $product->id)->delete();
        for ($i = 0; $i < count($data['unitName']); $i++) {
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
        //$product->delete();
        $query_product = Product::where('slug', $product->slug)
            ->update(['status' => 'inactive']);
        return redirect()->back()->with('success', 'Delete Success');
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

        if ($data['promotionTag'] != null || $data['promotionTag'] != '') {
            ProductPromotion::where('product_id', $product->id)->delete();

            $newPromotion = $data['promotionTag'];
            $promotion = Promotion::where('slug', $newPromotion)->first();
            $productPromotion = [
                'product_id' => $product->id,
                'promotion_id' => $promotion->id
            ];

            ProductPromotion::create($productPromotion);

            //$newPromotions = json_decode($data['promotionTag'], True);
            /*
            foreach($newPromotions as $newPromotion) {
                //$promotion = Promotion::where('slug', $newPromotion['value'])->first();
                $promotion = Promotion::where('slug', $newPromotion)->first();
                $productPromotion = [
                    'product_id' => $product->id,
                    'promotion_id' => $promotion->id
                ];
                ProductPromotion::create($productPromotion);
            }
            */
        } else {
            ProductPromotion::where('product_id', $product->id)->delete();
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
            foreach ($newCategories as $newCategory) {
                $category = Category::where('slug', $newCategory['value'])->first();
                $categoryProduct = [
                    'product_id' => $product->id,
                    'category_id' => $category->id
                ];
                CategoryProduct::create($categoryProduct);
            }
        } else {
            CategoryProduct::where('product_id', $product->id)->delete();
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
            foreach ($newPromotions as $newPromotion) {
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

    public function indexCustomerProductAll(Request $request)
    {
        $page = 20;
        $query = "";
        $category = [];
        $category_slug = $request->query('category');
        $search = $request->query('query');

        if ($category_slug != "") {
            if ($category_slug == "all") {
                $products = Product::where('status', 'active')
                    ->where(function ($query) use ($search) {
                        $query->where('name', 'like', '%' . $search . '%')
                            ->orWhere('keyword_search', "like", "%" . $search . "%")
                            ->orderBy('updated_at', 'DESC');
                    })->paginate($page);
            } else {
                if ($search != "") {
                    $category = [];
                    $category_slug = "";
                    $products = Product::where('status', 'active')
                        ->where(function ($query) use ($search) {
                            $query->where('name', 'like', '%' . $search . '%')
                                ->orWhere('keyword_search', "like", "%" . $search . "%")
                                ->orderBy('updated_at', 'DESC');
                        })->where('status', 'active')->paginate($page);
                } else {
                    if (!is_string($category_slug)) {
                        $category_slug = "all";
                    }
                    $products = Product::where('status', 'active')
                        ->where(function ($query) use ($search) {
                            $query->where('name', 'like', '%' . $search . '%')
                                ->orWhere('keyword_search', "like", "%" . $search . "%")
                                ->orderBy('updated_at', 'DESC');
                        })->paginate($page);
                }
            }
        } else {
            if ($search != "") {
                $category = [];
                $category_slug = "";
                $products = Product::where('status', 'active')
                    ->where(function ($query) use ($search) {
                        $query->where('name', 'like', '%' . $search . '%')
                            ->orWhere('keyword_search', "like", "%" . $search . "%")
                            ->orderBy('updated_at', 'DESC');
                    })->where('status', 'active')->paginate($page);
            } else {
                $category_slug = "all";
                $products = Product::where('status', 'active')
                    ->where(function ($query) use ($search) {
                        $query->where('name', 'like', '%' . $search . '%')
                            ->orWhere('keyword_search', "like", "%" . $search . "%")
                            ->orderBy('updated_at', 'DESC');
                    })->paginate($page);
            }
        }

        $categories = Category::all()->pluck('name', 'slug');
        return view('customer.index', [
            'products' => $products,
            'categories' => $categories,
            'currentCategory' => $category,
            'currentCategorySlug' => $category_slug,
            'search' => $search,
        ]);
    }

    /**
     * Display a listing of the resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function indexCustomerProduct(Request $request)
    {
        $page = 20;
        $query = "";
        $category = [];
        $category_slug = $request->query('category');
        $search = $request->query('query');

        if ($category_slug != "") {
            if ($category_slug == "all") {
                $products = Product::where('status', 'active')
                    ->where(function ($query) use ($search) {
                        $query->where('name', 'like', '%' . $search . '%')
                            ->orWhere('keyword_search', "like", "%" . $search . "%")
                            ->orderBy('updated_at', 'DESC');
                    })->paginate($page);
            } else {
                if ($search != "") {
                    $category = [];
                    $category_slug = "";
                    $products = Product::where('status', 'active')
                        ->where(function ($query) use ($search) {
                            $query->where('name', 'like', '%' . $search . '%')
                                ->orWhere('keyword_search', "like", "%" . $search . "%")
                                ->orderBy('updated_at', 'DESC');
                        })->where('status', 'active')->paginate($page);
                } else {
                    if (!is_string($category_slug)) {
                        $category_slug = "WGNVqKwiy10h19nVDG2wZxucDNMupVcf12FQBQZK";
                    }
                    $category = Category::where('slug', $category_slug)->first();
                    $products = $category->products()
                        ->where(function ($query) use ($search) {
                            $query->where('name', 'like', '%' . $search . '%')
                                ->orWhere('keyword_search', "like", "%" . $search . "%")
                                ->orderBy('updated_at', 'DESC');
                        })->where('status', 'active')->paginate($page);
                }
            }
        } else {
            if ($search != "") {
                $category = [];
                $category_slug = "";
                $products = Product::where('status', 'active')
                    ->where(function ($query) use ($search) {
                        $query->where('name', 'like', '%' . $search . '%')
                            ->orWhere('keyword_search', "like", "%" . $search . "%")
                            ->orderBy('updated_at', 'DESC');
                    })->where('status', 'active')->paginate($page);
            } else {
                $category_slug = "WGNVqKwiy10h19nVDG2wZxucDNMupVcf12FQBQZK";
                $category = Category::where('slug', $category_slug)->first();
                $products = $category->products()
                    ->where(function ($query) use ($search) {
                        $query->where('name', 'like', '%' . $search . '%')
                            ->orWhere('keyword_search', "like", "%" . $search . "%")
                            ->orderBy('updated_at', 'DESC');
                    })->where('status', 'active')->paginate($page);
            }
        }

        $categories = Category::all()->pluck('name', 'slug');
        return view('customer.index', [
            'products' => $products,
            'categories' => $categories,
            'currentCategory' => $category,
            'currentCategorySlug' => $category_slug,
            'search' => $search,
        ]);
    }

    public function searchCustomerProduct(Request $request)
    {
        $request = $request->all();
        $query = $request['query'];

        if (isset($request['category'])) {
            $category = $request['category'];
        } else {
            $category = "";
        }

        return redirect("customer/products?query=" . $query . "&category=" . $category);
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

        //$productImages = $product->detailImages()->get();

        $productType = $product->categories()->pluck('category_id');
        $productCategories = $product->categories()->pluck('category_id');
        $categoryProducts = CategoryProduct::whereIn('category_id', $productCategories)->pluck('product_id');
        if (count($categoryProducts) == 0) {
            $similarProducts = Product::where('id', '!=', $product->id)
            ->where('status', 'active')
            ->where('quantity', '>', 0)
            ->inRandomOrder()->take(3)->get();
        } else if (count($categoryProducts) > 1) {
            $similarProducts = Product::where('id', '!=', $product->id)
            ->where('status', 'active')
            ->where('quantity', '>', 0)
            ->inRandomOrder()->take(3)->get();
        } else {
            $similarProducts = Product::where('id', '!=', $product->id)
            ->where('status', 'active')
            ->where('quantity', '>', 0)
            ->whereIn('id', $categoryProducts)->take(3)->get();
        }

        if (count($product->categories()->pluck('category_id')) == 0) {
            $productCategoryId = [''];
            $productCategoryText = ['อื่นๆ'];
        } else {
            $productCategoryId = $product->categories()->pluck('slug');
            $productCategoryText = $product->categories()->pluck('name');
        }
        $productNameText = $product->name;

        return view('customer.show', [
            'product' => $product,
            //'productImages' => $productImages,
            'similarProducts' => $similarProducts,
            'productNameText' => $productNameText,
            'productCategoryText' => $productCategoryText,
            'productCategoryId' => $productCategoryId
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
            ->paginate(20);
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

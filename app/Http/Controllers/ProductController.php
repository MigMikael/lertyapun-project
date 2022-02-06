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
use App\Traits\ValidateTrait;
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
        $sort = $request->query('sort');
        $query = $request->query('query');
        $statusAmountSearch = $request->query('statusAmountSearch');
        $productStatusSearch = $request->query('productStatusSearch');

        if ($sort == 'name_asc') {
            if ($statusAmountSearch == "all") {
                $products = Product::where("name", "like", "%".$query."%")
                ->where('status', 'active')
                ->orderBy('name', 'ASC')
                ->with('image')
                ->paginate($page);
            }
            else if ($statusAmountSearch == "has") {
                $products = Product::where("name", "like", "%".$query."%")
                ->where('status', 'active')
                ->where("products.quantity", ">", 0)
                ->orderBy('name', 'ASC')
                ->with('image')
                ->paginate($page);
            }
            else if ($statusAmountSearch == "empty") {
                $products = Product::where("name", "like", "%".$query."%")
                ->where('status', 'active')
                ->where("products.quantity", "<=", 0)
                ->orderBy('name', 'ASC')
                ->with('image')
                ->paginate($page);
            }
            else {
                $products = Product::where("name", "like", "%".$query."%")
                ->where('status', 'active')
                ->orderBy('name', 'ASC')
                ->with('image')
                ->paginate($page);
            }
        } else if ($sort == 'name_desc') {
            if ($statusAmountSearch == "all") {
                $products = Product::where("name", "like", "%".$query."%")
                ->where('status', 'active')
                ->orderBy('name', 'DESC')
                ->with('image')
                ->paginate($page);
            }
            else if ($statusAmountSearch == "has") {
                $products = Product::where("name", "like", "%".$query."%")
                ->where('status', 'active')
                ->where("products.quantity", ">", 0)
                ->orderBy('name', 'DESC')
                ->with('image')
                ->paginate($page);
            }
            else if ($statusAmountSearch == "empty") {
                $products = Product::where("name", "like", "%".$query."%")
                ->where('status', 'active')
                ->where("products.quantity", "<=", 0)
                ->orderBy('name', 'DESC')
                ->with('image')
                ->paginate($page);
            }
            else {
                $products = Product::where("name", "like", "%".$query."%")
                ->where('status', 'active')
                ->orderBy('name', 'DESC')
                ->with('image')
                ->paginate($page);
            }
        } else if ($sort == 'price_asc') {
            if ($statusAmountSearch == "all") {
                $products = Product::where("name", "like", "%".$query."%")
                ->where('status', 'active')
                ->orderBy('price', 'ASC')
                ->with('image')
                ->paginate($page);
            }
            else if ($statusAmountSearch == "has") {
                $products = Product::where("name", "like", "%".$query."%")
                ->where('status', 'active')
                ->where("products.quantity", ">", 0)
                ->orderBy('price', 'ASC')
                ->with('image')
                ->paginate($page);
            }
            else if ($statusAmountSearch == "empty") {
                $products = Product::where("name", "like", "%".$query."%")
                ->where('status', 'active')
                ->where("products.quantity", "<=", 0)
                ->orderBy('price', 'ASC')
                ->with('image')
                ->paginate($page);
            }
            else {
                $products = Product::where("name", "like", "%".$query."%")
                ->where('status', 'active')
                ->orderBy('price', 'ASC')
                ->with('image')
                ->paginate($page);
            }
        } else if ($sort == 'price_desc') {
            if ($statusAmountSearch == "all") {
                $products = Product::where("name", "like", "%".$query."%")
                ->where('status', 'active')
                ->orderBy('price', 'DESC')
                ->with('image')
                ->paginate($page);
            }
            else if ($statusAmountSearch == "has") {
                $products = Product::where("name", "like", "%".$query."%")
                ->where('status', 'active')
                ->where("products.quantity", ">", 0)
                ->orderBy('price', 'DESC')
                ->with('image')
                ->paginate($page);
            }
            else if ($statusAmountSearch == "empty") {
                $products = Product::where("name", "like", "%".$query."%")
                ->where('status', 'active')
                ->where("products.quantity", "<=", 0)
                ->orderBy('price', 'DESC')
                ->with('image')
                ->paginate($page);
            }
            else {
                $products = Product::where("name", "like", "%".$query."%")
                ->where('status', 'active')
                ->orderBy('price', 'DESC')
                ->with('image')
                ->paginate($page);
            }
        } else if ($sort == 'quantity_asc') {
            if ($statusAmountSearch == "all") {
                $products = Product::where("name", "like", "%".$query."%")
                ->where('status', 'active')
                ->orderBy('quantity', 'ASC')
                ->with('image')
                ->paginate($page);
            }
            else if ($statusAmountSearch == "has") {
                $products = Product::where("name", "like", "%".$query."%")
                ->where('status', 'active')
                ->where("products.quantity", ">", 0)
                ->orderBy('quantity', 'ASC')
                ->with('image')
                ->paginate($page);
            }
            else if ($statusAmountSearch == "empty") {
                $products = Product::where("name", "like", "%".$query."%")
                ->where('status', 'active')
                ->where("products.quantity", "<=", 0)
                ->orderBy('quantity', 'ASC')
                ->with('image')
                ->paginate($page);
            }
            else {
                $products = Product::where("name", "like", "%".$query."%")
                ->where('status', 'active')
                ->orderBy('quantity', 'ASC')
                ->with('image')
                ->paginate($page);
            }
        } else if ($sort == 'quantity_desc') {
            if ($statusAmountSearch == "all") {
                $products = Product::where("name", "like", "%".$query."%")
                ->where('status', 'active')
                ->orderBy('quantity', 'DESC')
                ->with('image')
                ->paginate($page);
            }
            else if ($statusAmountSearch == "has") {
                $products = Product::where("name", "like", "%".$query."%")
                ->where('status', 'active')
                ->where("products.quantity", ">", 0)
                ->orderBy('quantity', 'DESC')
                ->with('image')
                ->paginate($page);
            }
            else if ($statusAmountSearch == "empty") {
                $products = Product::where("name", "like", "%".$query."%")
                ->where('status', 'active')
                ->where("products.quantity", "<=", 0)
                ->orderBy('quantity', 'DESC')
                ->with('image')
                ->paginate($page);
            }
            else {
                $products = Product::where("name", "like", "%".$query."%")
                ->where('status', 'active')
                ->orderBy('quantity', 'DESC')
                ->with('image')
                ->paginate($page);
            }
        } else {
            if ($statusAmountSearch == "all") {
                $products = Product::where("name", "like", "%".$query."%")
                ->where('status', 'active')
                ->orderBy('updated_at', 'DESC')
                ->with('image')
                ->paginate($page);
            }
            else if ($statusAmountSearch == "has") {
                $products = Product::where("name", "like", "%".$query."%")
                ->where('status', 'active')
                ->where("products.quantity", ">", 0)
                ->orderBy('updated_at', 'DESC')
                ->with('image')
                ->paginate($page);
            }
            else if ($statusAmountSearch == "empty") {
                $products = Product::where("name", "like", "%".$query."%")
                ->where('status', 'active')
                ->where("products.quantity", "<=", 0)
                ->orderBy('updated_at', 'DESC')
                ->with('image')
                ->paginate($page);
            }
            else {
                $products = Product::where("name", "like", "%".$query."%")
                ->where('status', 'active')
                ->orderBy('updated_at', 'DESC')
                ->with('image')
                ->paginate($page);
            }
        }

        if ($productStatusSearch != "" && $productStatusSearch != "active") {
            $products = Product::where("name", "like", "%".$query."%")
                ->where('status', $productStatusSearch)
                ->orderBy('updated_at', 'DESC')
                ->with('image')
                ->paginate($page);
        }

        $products->appends(['query' => $query]);
        $products->appends(['sort' => $sort]);
        $products->appends(['statusAmountSearch' => $statusAmountSearch]);
        $products->appends(['productStatusSearch' => $productStatusSearch]);
        return view('admin.product.index', [
            'products' => $products,
            'search' => $query,
            'statusAmountSearch' => $statusAmountSearch,
            'productAmountStatus' => $this->productAmountStatus,
            'productStatusSearch' => $productStatusSearch,
            'productStatusTH' => $this->productStatusTH
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
        $statusAmountSearch = $request['statusAmountSearch'];
        $productStatusSearch = $request['productStatusSearch'];
        return redirect("admin/products?query=".$query."&statusAmountSearch=".$statusAmountSearch."&productStatusSearch=".$productStatusSearch);
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
            'company_name' => $data['company_name'],
            'cost' => $data['cost']
            /*'expired_startdate' => $data['expired_startdate'],
            'expired_enddate' => $data['expired_enddate'],*/
            //'expired_date' => $data['expired_date'],
        ];

        if($request->hasFile('product_image')) {
            $file = $request->file('product_image');
            $product_image = $this->storeImage($file, "");
            $newProduct['image_id'] = $product_image->id;
        }

        $product = Product::create($newProduct);

        $productSlug = sprintf("%04d", $product->id);
        $product->slug = 'P-'.$productSlug;
        $product->save();

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
        //$productPromotions = $product->promotions()->pluck('name');
        $productPromotions = $product->promotions()->pluck('slug');
        //dd($productPromotions);
        //dd($productPromotions->toArray());

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
            'company_name' => $data['company_name'],
            'cost' => $data['cost']
             /*'expired_startdate' => $data['expired_startdate'],
            'expired_enddate' => $data['expired_enddate'],*/
            //'expired_date' => $data['expired_date'],
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
        //$product->delete();
        $query_product = Product::where('slug', $product->slug)
                        ->update(['status' => 'inactive']);
        return redirect()->back()->with('success', 'Delete Success');
            //->action([ProductController::class, 'index'])
            //->with('success', 'Delete Success');
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
        //dd($data['promotionTag']);
        if ($data['promotionTag'] != null || $data['promotionTag'] != '') {
            ProductPromotion::where('product_id', $product->id)->delete();

            $newPromotion = $data['promotionTag'];
            //dd($newPromotion);
            $promotion = Promotion::where('slug', $newPromotion)->first();
            //dd($promotion);
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
        }
        else {
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
            foreach($newCategories as $newCategory) {
                $category = Category::where('slug', $newCategory['value'])->first();
                $categoryProduct = [
                    'product_id' => $product->id,
                    'category_id' => $category->id
                ];
                CategoryProduct::create($categoryProduct);
            }
        }
        else{
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
        $page = 40;
        $query = "";
        $category = [];
        $category_slug = $request->query('category');
        $search = $request->query('query');

        if ($category_slug != "") {
            $category = Category::where('slug', $category_slug)->first();
            $products = $category->products()
            ->where(function ($query) use ($search) {
                $query->where('name', 'like', '%'.$search.'%')
                    ->orWhere('keyword_search', "like", "%".$search."%")
                    ->where('status', 'active')
                    ->orderBy('updated_at', 'DESC');
            })->where('status', 'active')->paginate($page);  
        }
        else {
            $products = Product::where('status', 'active')
            ->where(function ($query) use ($search) {
                $query->where('name', 'like', '%'.$search.'%')
                    ->orWhere('keyword_search', "like", "%".$search."%")
                    ->orderBy('updated_at', 'DESC');
            })->paginate($page);  
            //$products = Product::where('name', 'like', '%'.$search.'%')
            //->orWhere('keyword_search', "like", "%".$search."%")
            //->where('status', 'active')
            //->orderBy('updated_at', 'DESC')
            //->paginate($page);
        }
        /*
        if ($category_slug != "") {
            $category = Category::where('slug', $category_slug)->first();
            $products = $category->products()
                ->where('status', 'active')
                //->where('category_id', $category->category_id)
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
        */

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
        }
        else {
            $category = "";
        }

        return redirect("customer/products?query=".$query."&category=".$category);
        //return redirect("customer/products?query=".$query);
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

        $productType = $product->categories()->pluck('category_id');
        $productCategories = $product->categories()->pluck('category_id');
        //$productCategories = $product->categories()->pluck('id');
        $categoryProducts = CategoryProduct::whereIn('category_id', $productCategories)->pluck('product_id');
        if (count($categoryProducts) == 0)
        {
            $similarProducts = Product::where('id', '!=', $product->id)->inRandomOrder()->take(3)->get();
        }
        else if (count($categoryProducts) > 1) {
            $similarProducts = Product::where('id', '!=', $product->id)->inRandomOrder()->take(3)->get();
        }
        else {
            $similarProducts = Product::where('id', '!=', $product->id)->whereIn('id', $categoryProducts)->take(3)->get();
        }

        if (count($product->categories()->pluck('category_id')) == 0) {
            $productCategoryId = [''];
            $productCategoryText = ['อื่นๆ'];
        }
        else {
            $productCategoryId = $product->categories()->pluck('slug');
            $productCategoryText = $product->categories()->pluck('name');
        }
        $productNameText = $product->name;

        return view('customer.show', [
            'product' => $product,
            'productImages' => $productImages,
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
            ->paginate(40);
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

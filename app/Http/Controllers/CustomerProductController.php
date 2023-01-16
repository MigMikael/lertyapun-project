<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Customer;
use App\Models\CustomerProduct;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use App\Traits\PriceTrait;
use App\Models\DaliveryService;

class CustomerProductController extends Controller
{
    use PriceTrait;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $authCustomer = auth()->guard('customer')->user();

        $customer = Customer::where('slug', $authCustomer->slug)
            ->with('cart')
            ->first();

        $sumTotalPrice = 0;
        $sumTotalDiscount = 0;
        $sumFinalPrice = 0;
        foreach($customer->cart as $product) {
            $discountPrice = $this->getDiscountPrice($product);
            Log::info($discountPrice);
            $basePrice = $product->units['0']['pricePerUnit'];
            if ($discountPrice < $basePrice) {
                $product['has_discount'] = true;
            } else {
                $product['has_discount'] = false;
            }
            $product['discount_price'] = $discountPrice;

            $totalPrice = $basePrice * $product->pivot->quantity;
            $product['total_price'] = $totalPrice;
            $sumTotalPrice += $totalPrice;

            $discount = ($basePrice - $discountPrice) * $product->pivot->quantity;
            $sumTotalDiscount += $discount;

            $finalPrice = $totalPrice - $discount;
            $sumFinalPrice += $finalPrice;
        }
        $customer['totalPrice'] = $sumTotalPrice;
        $customer['totalDiscount'] = $sumTotalDiscount;
        $customer['finalPrice'] = $sumFinalPrice;

        $deliveryServices = DaliveryService::where('status', 'show')->get();

        // return $customer;
        return view('customer.cart', [
            'customer' => $customer,
            'deliveryServices' => $deliveryServices
        ]);
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
    public function store(Request $request)
    {
        $data = $request->all();

        $customer = Customer::where('slug', $data['customer_id'])->first();
        $product = Product::where('slug', $data['product_id'])->first();
        $quantity = 1;
        if ($request->has('quantity')) {
            $quantity = intval($request['quantity']);
        }
        if($quantity > $product->quantity) {
            return response()->json(['errors' => 'จำนวนสินค้าเกินกว่าในสต็อก กรุณารีเฟรชหน้าใหม่อีกครั้ง'], 422);
        }
        $unitName = "";
        if ($request->has('unit')) {
            $unitName = $data['unit'];
        } else {
            $unitName = $product->units['0']['unitName'];
        }

        $customerProductCheck = [
            'customer_id' => $customer->id,
            'product_id' => $product->id,
        ];
        $customerProduct = [
            'customer_id' => $customer->id,
            'product_id' => $product->id,
            'quantity' => $quantity,
            'unitName' => $unitName
        ];
        CustomerProduct::firstOrCreate($customerProductCheck, $customerProduct);

        $productCount = CustomerProduct::where('customer_id', $customer->id)->count();
        return response()->json(['productCount' => $productCount], 200);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\CustomerProduct  $customerProduct
     * @return \Illuminate\Http\Response
     */
    public function show(CustomerProduct $customerProduct)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\CustomerProduct  $customerProduct
     * @return \Illuminate\Http\Response
     */
    public function edit(CustomerProduct $customerProduct)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\CustomerProduct  $customerProduct
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, CustomerProduct $customerProduct)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function updateCartQuantity(Request $request, Product $product)
    {
        $authCustomer = auth()->guard('customer')->user();
        $customer = Customer::where('slug', $authCustomer->slug)->first();
        $data = $request->all();
        $quantity = $data["quantity"];

        Log::info($quantity);

        if ($quantity <= $product->quantity) {
            $customerProduct = CustomerProduct::where('customer_id', $customer->id)
                ->where('product_id', $product->id)
                ->first();
            $customerProduct->update(['quantity' => $data["quantity"]]);
        }
        return "update quantity success";
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product $product)
    {
        $authCustomer = auth()->guard('customer')->user();
        $customer = Customer::where('slug', $authCustomer->slug)->first();

        $customerProduct = CustomerProduct::where('customer_id', $customer->id)
            ->where('product_id', $product->id)
            ->first();

        $customerProduct->delete();

        return redirect()->back();
    }

    public function productCount()
    {
        $authCustomer = auth()->guard('customer')->user();
        $customer = Customer::where('slug', $authCustomer->slug)->first();

        $productCount = 555;
        if ($customer != null) {
            $productCount = CustomerProduct::where('customer_id', $customer->id)->count();
        }

        return response()->json(['productCount' => $productCount], 200);
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Customer;
use App\Models\CustomerProduct;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class CustomerProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $customer = Customer::where('slug', 'QoUXlBE9kpTtmqy8oTRkIdvKKrOoQdXxAzTE99yr')
            ->with('cart')
            ->first();

        $sumTotalPrice = 0;
        foreach($customer->cart as $product) {
            $totalPrice = $product->price * $product->pivot->quantity;
            $product['totalPrice'] = $totalPrice;

            $sumTotalPrice += $totalPrice;
        }
        $customer['totalPrice'] = $sumTotalPrice;

        // return $customer;
        return view('customer.cart', [
            'customer' => $customer
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
        $customerProductCheck = [
            'customer_id' => $customer->id,
            'product_id' => $product->id,
        ];
        $customerProduct = [
            'customer_id' => $customer->id,
            'product_id' => $product->id,
            'quantity' => 1,
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
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product $product)
    {
        $customer = Customer::where('slug', 'QoUXlBE9kpTtmqy8oTRkIdvKKrOoQdXxAzTE99yr')->first();

        $customerProduct = CustomerProduct::where('customer_id', $customer->id)
            ->where('product_id', $product->id)
            ->first();

        $customerProduct->delete();

        return redirect()->back();
    }

    public function productCount()
    {
        $customer = Customer::where('slug', 'QoUXlBE9kpTtmqy8oTRkIdvKKrOoQdXxAzTE99yr')->first();
        $productCount = CustomerProduct::where('customer_id', $customer->id)->count();

        return response()->json(['productCount' => $productCount], 200);
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;
use App\Traits\ImageTrait;
use App\Traits\PriceTrait;
use App\Helpers\StringGenerator;
use App\Models\Product;
use App\Models\Customer;
use App\Models\OrderDetail;
use Illuminate\Support\Facades\Log;

class OrderController extends Controller
{
    use PriceTrait;
    use ImageTrait;
    public $orderStatus = [
        'pending' => 'Pending',
        'success' => 'Success',
        'cancle' => 'Cancle',
    ];

    public $paymentStatus = [
        'pending' => 'Pending',
        'success' => 'Success',
        'cancle' => 'Cancle',
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
        if($sort == 'name_asc') {
            $orders = Order::join('customers', 'orders.customer_id', '=', 'customers.id')
                ->orderBy('first_name', 'ASC')
                ->paginate($page);
        } else if($sort == 'name_desc') {
            $orders = Order::join('customers', 'orders.customer_id', '=', 'customers.id')
                ->orderBy('first_name', 'DESC')
                ->paginate($page);
        } else {
            $orders = Order::orderBy('updated_at', 'DESC')
                ->with('customer')
                ->paginate($page);
        }
        // return $orders;
        return view('admin.order.index', ['orders' => $orders]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.order.create', [
            'paymentStatus' => $this->paymentStatus,
            'orderStatus' => $this->orderStatus,
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
        $newOrder = $request->all();
        $newOrder['slug'] = (new StringGenerator())->generateSlug();
        $newOrder['payment_method'] = 'direct transfer';

        if($request->hasFile('slip_image')) {
            $file = $request->file('slip_image');
            $slip_image = $this->storeImage($file, "");
            $newOrder['slip_image_id'] = $slip_image->id;
        }

        $newOrder = Order::create($newOrder);
        return redirect()->action([OrderController::class, 'index']);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function show(Order $order)
    {
        $order->with('customer');
        return view('admin.order.show', [
            'order' => $order,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function edit(Order $order)
    {
        return view('admin.order.edit', [
            'order' => $order,
            'paymentStatus' => $this->paymentStatus,
            'orderStatus' => $this->orderStatus,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Order $order)
    {
        $newOrder = $request->all();

        if($request->hasFile('slip_image')) {
            $file = $request->file('slip_image');
            $slip_image = $this->storeImage($file, "");
            $newOrder['slip_image_id'] = $slip_image->id;
        }

        $order->update($newOrder);
        return redirect()->action([OrderController::class, 'index']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function destroy(Order $order)
    {
        $order->delete();
        return redirect()->action([OrderController::class, 'index']);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function storeOrder(Request $request)
    {
        $product_slug = $request->get('product_slug');
        $product_quantity = $request->get('product_quantity');

        $sumTotalPrice = 0;
        $sumTotalDiscount = 0;
        $sumFinalPrice = 0;
        $newOrderDetails = [];
        for ($i=0; $i < count($product_slug); $i++) {
            $slug = $product_slug[$i];
            $quantity = $product_quantity[$i];

            $product = Product::where('slug', $slug)->first();
            if($quantity > $product->quantity) {
                return "fail";
            }
            $totalPrice = $product->price * $quantity;
            $sumTotalPrice += $totalPrice;

            $discountPrice = $this->getDiscountPrice($product);
            $discount = ($product->price - $discountPrice) * $quantity;
            $sumTotalDiscount += $discount;

            $finalPrice = $totalPrice - $discount;
            $sumFinalPrice += $finalPrice;

            $newOrderDetail = [
                'order_id' => 0,
                'product_id' => $product->id,
                'sale_quantity' => $quantity,
                'order_price' => $finalPrice,
            ];
            array_push($newOrderDetails, $newOrderDetail);
        }

        $authCustomer = auth()->guard('customer')->user();
        $customer = Customer::where('slug', $authCustomer->slug)->first();

        $newOrder = [
            'slug' => (new StringGenerator())->generateSlug(),
            'total_amount' => $sumFinalPrice,
            'status' => 'pending',
            'order_date' => \Carbon\Carbon::now(),
            'payment_method' => 'direct transfer',
            'payment_status' => 'pending',
            'customer_id' => $customer->id,
        ];

        $order = Order::create($newOrder);
        foreach($newOrderDetails as $newOrderDetail) {
            $newOrderDetail['order_id'] = $order->id;
            OrderDetail::create($newOrderDetail);

            // $product = Product::where('id', $newOrderDetail['product_id'])->first();
            // $product
        }

        return "ok";
    }
}

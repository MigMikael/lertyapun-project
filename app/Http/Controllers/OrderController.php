<?php

namespace App\Http\Controllers;

use App\Models\BankAccount;
use App\Models\Order;
use Illuminate\Http\Request;
use App\Traits\ImageTrait;
use App\Traits\PriceTrait;
use App\Helpers\StringGenerator;
use App\Models\Product;
use App\Models\Customer;
use App\Models\CustomerProduct;
use App\Models\OrderDetail;
use App\Models\ProductUnit;
use Illuminate\Support\Facades\Log;
use Carbon\Carbon;

class OrderController extends Controller
{
    use PriceTrait;
    use ImageTrait;
    public $orderStatus = [
        'pending' => 'Pending', // รอแอดมินอนุมัติ
        'packing' => 'Packing', // กำลังจัดของ
        'payment' => 'WaitingPayment', // รอลูกค้ายืนยันการจ่ายเงิน
        'credit' => 'Credit', // สำเร็จแต่ยังไม่จ่ายตัง
        'success' => 'Success', // สำเร็จ
        'cancle' => 'Cancel', // ยกเลิก
    ];

    public $orderStatusTH = [
        '' => 'ทั้งหมด',
        'pending' => 'รอการอนุมัติ', // รอแอดมินอนุมัติ
        'packing' => 'กำลังจัดสินค้า', // กำลังจัดของ
        'payment' => 'รอการชำระเงิน', // รอลูกค้ายืนยันการจ่ายเงิน
        'credit' => 'เครดิต', // สำเร็จแต่ยังไม่จ่ายตัง
        'success' => 'สำเร็จ', // สำเร็จ
        'cancle' => 'ยกเลิก', // ยกเลิก
    ];

    public $orderApproveOption = [
        'payment' => 'อนุมัติคำสั่งซื้อ', // รอลูกค้ายืนยันการจ่ายเงิน
        'credit' => 'เครดิต', // สำเร็จแต่ยังไม่จ่ายตัง
        'cancle' => 'ยกเลิก', // ยกเลิก
    ];

    public $paymentApproveOption = [
        'success' => 'ยืนยันเงินเข้า', // สำเร็จ
        'cancle' => 'ยกเลิก', // ยกเลิก
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
        $search = $request->query('query');
        $status = $request->query('status');

        if($sort == 'order_date_asc') {
            $orders = Order::join('customers', 'orders.customer_id', '=', 'customers.id')
                ->select('orders.*','orders.slug as order_slug','customers.slug as customer_slug', 'orders.status as order_status', 'customers.*')
                /*->where("first_name", "like", "%".$query."%")
                ->orWhere("last_name", "like", "%".$query."%")*/
                //->Where("orders.slug", "like", "%".$query."%")
                ->where(function ($query) use ($search) {
                    $query->where('customers.first_name', 'like', '%'.$search.'%')
                        ->orWhere('customers.last_name', "like", "%".$search."%")
                        ->orWhere('customers.store_name', "like", "%".$search."%");
                })->where("orders.status", "like", "%".$status."%")->orderBy('orders.created_at', 'ASC')->paginate($page);
                //->Where("orders.status", "like", "%".$status."%")
                //->orderBy('first_name', 'ASC')
        } else if($sort == 'order_date_desc') {
            $orders = Order::join('customers', 'orders.customer_id', '=', 'customers.id')
                ->select('orders.*','orders.slug as order_slug','customers.slug as customer_slug', 'orders.status as order_status', 'customers.*')
                ->where(function ($query) use ($search) {
                    $query->where('customers.first_name', 'like', '%'.$search.'%')
                        ->orWhere('customers.last_name', "like", "%".$search."%")
                        ->orWhere('customers.store_name', "like", "%".$search."%");
                })->where("orders.status", "like", "%".$status."%")->orderBy('orders.created_at', 'DESC')->paginate($page);
                //->where("first_name", "like", "%".$query."%")
                //->orWhere("last_name", "like", "%".$query."%")
                //->Where("orders.slug", "like", "%".$query."%")
                //->Where("orders.status", "like", "%".$status."%")
                //->orderBy('first_name', 'DESC')
                //->paginate($page);
        } else {
            $orders = Order::join('customers', 'orders.customer_id', '=', 'customers.id')
                ->select('orders.*','orders.slug as order_slug','customers.slug as customer_slug', 'orders.status as order_status', 'customers.*')
                ->where(function ($query) use ($search) {
                    $query->where('customers.first_name', 'like', '%'.$search.'%')
                        ->orWhere('customers.last_name', "like", "%".$search."%")
                        ->orWhere('customers.store_name', "like", "%".$search."%");
                })->where("orders.status", "like", "%".$status."%")->orderBy('orders.created_at', 'DESC')->paginate($page);
                /*->where("first_name", "like", "%".$query."%")
                ->orWhere("last_name", "like", "%".$query."%")*/
                //->Where("orders.slug", "like", "%".$query."%")
                //->Where("orders.status", "like", "%".$status."%")
                //->orderBy('orders.updated_at', 'DESC')
                //->paginate($page);
        }
        $orders->appends(['query' => $search]);
        $orders->appends(['sort' => $sort]);
        $orders->appends(['status' => $status]);
        return view('admin.order.index', [
            'orders' => $orders,
            'search' => $search,
            'status' => $status,
            'orderStatus' => $this->orderStatusTH
        ]);
        // return $orders;
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
        $status = $request['status'];
        return redirect("admin/orders?query=".$query."&status=".$status);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.order.create', [
            'orderStatus' => $this->orderStatusTH,
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

        /*$dt = new DateTime;
        $newOrderId = 'ORD-'.$dt->format('Ymd').sprintf("%06d", $order->id);*/
        $stringGenerator = new StringGenerator('0123456789');
        $newOrder['slug'] = $stringGenerator->generate(12);
        // $newOrder['slug'] = $newOrderId;
        $newOrder['payment_method'] = 'direct transfer';

        if($request->hasFile('slip_image')) {
            $file = $request->file('slip_image');
            $slip_image = $this->storeImage($file, "");
            $newOrder['slip_image_id'] = $slip_image->id;
        }

        $newOrder = Order::create($newOrder);
        return redirect()
            ->action([OrderController::class, 'index'])
            ->with('success', 'Create Success');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function show(Order $order)
    {
        $order->products;
        $order->customer->addresses;

        $sum_cost = 0;

        foreach ($order->products as $product)
        {
            $product_test = Product::where("slug", $product->slug)->get();
            $sum_cost += ($product_test[0]->cost * $product->pivot->sale_quantity);
        }

        // return $order;
        return view('admin.order.show', [
            'order' => $order,
            'status' => $this->orderStatusTH,
            'orderApproveOption' => $this->orderApproveOption,
            'paymentApproveOption' => $this->paymentApproveOption,
            'sum_cost' => $sum_cost
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
            'orderStatus' => $this->orderStatusTH,
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
        return redirect()
            ->action([OrderController::class, 'index'])
            ->with('success', 'Edit Success');
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
        return redirect()->back()->with('success', 'Delete Success');
            //->action([OrderController::class, 'index'])
            //->with('success', 'Delete Success');
    }

    /**
     * Display a listing of the resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function indexOrder(Request $request)
    {
        $query = $request->query('query');

        $authCustomer = auth()->guard('customer')->user();
        $customer = Customer::where('slug', $authCustomer->slug)->first();

        $orders = Order::where('customer_id', $customer->id)
            ->where("slug", "like", "%".$query."%")
            ->orderBy('orders.updated_at', 'DESC')
            ->get();
        // return $orders;
        return view('customer.order', [
            'orders' => $orders,
            'customer' => $customer,
            'orderSearch' => $query,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function storeOrder(Request $request)
    {
        $authCustomer = auth()->guard('customer')->user();
        $customer = Customer::where('slug', $authCustomer->slug)->first();
        if ($customer == null) {
            return response()->json(['errors' => 'กรุณาล็อกอินใหม่อีกครั้ง'], 422);
        }

        if (!$request->has('product_slug') || !$request->has('product_quantity')) {
            return response()->json(['errors' => 'กรุณาลองใหม่อีกครั้ง'], 422);
        }

        if ($customer->addresses->first() == null) {
            return response()->json(['errors' => 'กรุณากรอกที่อยู่ก่อนทำการสั่งซื้อ', 'redirect' => url('customer/address')], 422);
        }

        $product_slug = $request->get('product_slug');
        $product_quantity = $request->get('product_quantity');
        $units = $request->get('unit');

        $sumWeight = 0;
        $sumTotalPrice = 0;
        $sumTotalDiscount = 0;
        $sumFinalPrice = 0;
        $newOrderDetails = [];

        for ($i=0; $i < count($product_slug); $i++) {
            $slug = $product_slug[$i];
            $quantity = $product_quantity[$i];
            $unit = $units[$i];

            $product = Product::where('slug', $slug)->first();
            $productUnit = ProductUnit::where('product_id', $product->id)
                ->where('unitName', $unit)->first();

            $baseQuantity = $quantity * $productUnit->quantityPerUnit;

            /*if($baseQuantity > $product->quantity) {
                return response()->json(['errors' => 'จำนวนสินค้าเกินกว่าในสต็อก กรุณารีเฟรชหน้าใหม่อีกครั้ง'], 422);
            }
            */

            if($quantity <= 0) {
                return response()->json(['errors' => 'พบรายการสินค้าหมด กดปุ่ม Refresh หน้าจอ แล้วตรวจสอบรายการสินค้าอีกครั้ง'], 422);
            }

            $sumWeight += $this->calculateOrderWeight($product, $baseQuantity);

            $totalPrice = $productUnit->pricePerUnit * $quantity;
            $sumTotalPrice += $totalPrice;

            $discountPrice = $this->getDiscountPriceByUnit($product, $productUnit->pricePerUnit);
            $discount = ($productUnit->pricePerUnit - $discountPrice) * $quantity;
            $sumTotalDiscount += $discount;

            $finalPrice = $totalPrice - $discount;
            $sumFinalPrice += $finalPrice;

            if ($quantity > 0) {
                $newOrderDetail = [
                    'order_id' => 0,
                    'product_id' => $product->id,
                    'sale_quantity' => $quantity,
                    'sale_unit' => $productUnit->unitName,
                    'quantityPerUnit' => $productUnit->quantityPerUnit,
                    'order_price' => $finalPrice,
                ];
                array_push($newOrderDetails, $newOrderDetail);
            }
        }

        if (count($newOrderDetails) > 100) {
            return response()->json(['errors' => 'รายการสินค้าไม่สามารถเกิน 100 รายการ'], 422);
        }

        if ($sumFinalPrice < 1000) {
            return response()->json(['errors' => '*ยอดสั่งสินค้าขั้นต่ำ 1,000 บาท'], 422);
        }

        // $shipmentPrice = $this->calculateShipmentPrice($sumWeight);
        $shipmentMethod = $request->get('shipment_method');

        /*$stringGenerator = new StringGenerator('0123456789');*/
        $stringGenerator = new StringGenerator('ABCDEFGHIFKLMNOPQRSTUVWXYZ0123456789');
        $newOrder = [
            'slug' => '',
            /*'slug' => $stringGenerator->generate(12),*/
            'total_amount' => $sumFinalPrice,
            'status' => 'pending',
            'order_date' => Carbon::now(),
            'payment_method' => 'direct transfer',
            'customer_id' => $customer->id,
            'weight' => $sumWeight,
            // 'shipment_price' => $shipmentPrice,
            'shipment_method' => $shipmentMethod,
        ];

        $order = Order::create($newOrder);

        $dt = Carbon::now()->format('ymd');
        //$orderSlug = 'ORD-'.$dt.$stringGenerator->generate(5);
        $orderSlug = $dt.$stringGenerator->generate(5);
        $order->slug = $orderSlug;
        $order->save();

        foreach($newOrderDetails as $newOrderDetail) {
            $newOrderDetail['order_id'] = $order->id;
            OrderDetail::create($newOrderDetail);

            // update quantity
            // $product = Product::where('id', $newOrderDetail['product_id'])->first();
            // $product->quantity = $product->quantity - ($newOrderDetail['sale_quantity'] * $newOrderDetail['quantityPerUnit']);
            // $product->save();
        }
        CustomerProduct::where('customer_id', $customer->id)->delete();

        return response()->json(['status' => 'order success'], 200);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function showOrder(Order $order)
    {
        $order->products;
        // return $order;
        $banks = BankAccount::where('status', 'show')->get();

        return view('customer.orderDetail', [
            'order' => $order,
            'customer' => $order->customer,
            'banks' => $banks,
        ]);
    }

    /**
     * Search a listing of the resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function searchOrder(Request $request)
    {
        $request = $request->all();
        $query = $request['query'];
        return redirect("customer/order?query=".$query);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function addSlipToOrder(Request $request, Order $order)
    {
        if($request->hasFile('slip_image')) {
            $file = $request->file('slip_image');
            $image_record = $this->storeImage($file, "");
            $order['slip_image_id'] = $image_record->id;
            $order['payment_date'] = \Carbon\Carbon::now();
            $order->save();
        }

        return redirect()->back();
    }

    /**
     * Update resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function updateStatus(Request $request, Order $order)
    {
        $status = $request->get('status');
        $order['status'] = $status;

        $newShipmentPrice = $request->get('shipment_price');
        $oldShipmentPrice = $order['shipment_price'];

        if ($newShipmentPrice != $oldShipmentPrice) {
            // update new shipment price
            $order['shipment_price'] = $newShipmentPrice;

            // update total amount
            $totalAmount = $order['total_amount'];
            $newTototalAmount = $totalAmount - $oldShipmentPrice;
            $newTototalAmount = $newTototalAmount + $newShipmentPrice;
            $order['total_amount'] = $newTototalAmount;
        }

        $order->save();

        if ($order->status == 'success' || $order->status == 'credit') {
            // update quantity
            foreach($order->orderDetails as $orderDetail) {
                $product = Product::where('id', $orderDetail->product_id)->first();
                $product->quantity = $product->quantity - ($orderDetail->sale_quantity * $orderDetail->quantityPerUnit);
                $product->save();
            }
        }

        return redirect()->back();
    }

    /**
     * Update resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function updateShipmentPrice(Request $request, Order $order, $price)
    {
        $shipmentPrice = $this->calculateShipmentPrice($order->weight);

        if ($price == 'price') {
            $order->shipment_price = $shipmentPrice;
            $order->total_amount = $order->total_amount + $shipmentPrice;
        } else if ($price == 'free') {
            $order->shipment_price = 0;
            $order->total_amount = $order->total_amount - $shipmentPrice;
        }
        $order->save();

        return redirect()->back();
    }

    private function calculateOrderWeight(Product $product, $quantity)
    {
        return $product->weight * $quantity;
    }

    private function calculateShipmentPrice($weight)
    {
        $shipmentRate = config('constants.shipmentRate');

        $weightKg = $weight / 1000;
        $weightFloor = floor($weightKg);

        $shipmentPrice = 0;
        if ($weightFloor < 0) {
            $shipmentPrice = 0;
        }
        else if($weightFloor <= 100 && $weightFloor >= 0) {
            $shipmentPrice = $shipmentRate[$weightFloor];
        }
        else {
            $shipmentPrice = end($shipmentRate);
        }

        return $shipmentPrice;
    }
}

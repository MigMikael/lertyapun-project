<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;
use App\Traits\ImageTrait;
use App\Helpers\StringGenerator;

class OrderController extends Controller
{
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
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $orders = Order::orderBy('updated_at', 'DESC')
            ->with('customer')
            ->paginate(5);
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
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Customer;
use App\Models\Order;

class AdminController extends Controller
{
    public function dashboard()
    {
        $customerActive = Customer::where('status', 'active')->count();
        $customerPending = Customer::where('status', 'pending')->count();
        $customerSuspend = Customer::where('status', 'suspend')->count();
        $orderPending = Order::where('status', 'pending')->count();
        $orderPayment = Order::where('status', 'payment')->count();
        $orderSuccess = Order::where('status', 'success')->count();
        $orderCancel = Order::where('status', 'cancle')->count();
        return view('admin.dashboard', [
            'customerActive' => $customerActive,
            'customerPending' => $customerPending,
            'customerSuspend' => $customerSuspend,
            'orderPending' => $orderPending,
            'orderPayment' => $orderPayment,
            'orderSuccess' => $orderSuccess,
            'orderCancel' => $orderCancel,
        ]);
    }
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Customer;
use App\Models\Order;

class AdminController extends Controller
{
    public function dashboard()
    {
        $customerPending = Customer::where('status', 'pending')->count();
        $orderPending = Order::where('status', 'pending')->count();
        $orderPayment = Order::where('status', 'payment')->count();
        return view('admin.dashboard', [
            'customerPending' => $customerPending,
            'orderPending' => $orderPending,
            'orderPayment' => $orderPayment,
        ]);
    }
}

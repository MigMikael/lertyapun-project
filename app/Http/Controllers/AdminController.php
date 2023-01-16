<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use App\Models\Order;
use App\Models\Customer;
use Illuminate\Http\Request;
use App\Helpers\StringGenerator;
use Illuminate\Support\Facades\Hash;

class AdminController extends Controller
{
    public function dashboard()
    {
        $customerActive = Customer::where('status', 'active')->count();
        $customerPending = Customer::where('status', 'pending')->count();
        $customerSuspend = Customer::where('status', 'suspend')->count();
        $orderPending = Order::where('status', 'pending')->count();
        $orderPayment = Order::where('status', 'payment')->count();
        $orderCredit = Order::where('status', 'credit')->count();
        $orderSuccess = Order::where('status', 'success')->count();
        $orderCancel = Order::where('status', 'cancle')->count();
        return view('admin.dashboard', [
            'customerActive' => $customerActive,
            'customerPending' => $customerPending,
            'customerSuspend' => $customerSuspend,
            'orderPending' => $orderPending,
            'orderPayment' => $orderPayment,
            'orderCredit' => $orderCredit,
            'orderSuccess' => $orderSuccess,
            'orderCancel' => $orderCancel,
        ]);
    }

    public function index(Request $request)
    {
        $page = 10;

        $query = $request->query('query');

        $super_admins = Admin::where("name", "like", "%".$query."%")
        ->orWhere("email", "like", "%".$query."%")
        ->orderBy('name', 'DESC')
        ->paginate($page);

        $super_admins->appends(['query' => $query]);

        return view('admin.super_admin.index', [
            'super_admins' => $super_admins,
            'search' => $query,
        ]);
    }

    public function search(Request $request)
    {
        $request = $request->all();
        $query = $request['query'];
        return redirect("admin/super_admins?query=".$query);
    }

    public function create()
    {
        return view('admin.super_admin.create');
    }

    public function store(Request $request)
    {
        $newAdmin = $request->all();
        $newAdmin['slug'] = (new StringGenerator())->generateSlug();

        $password = $request->get('password');
        if ($password) {
            $newAdmin['password'] = Hash::make($password);
        }

        $super_admin = Admin::create($newAdmin);

        return redirect()
            ->action([AdminController::class, 'index'])
            ->with('success', 'Create Success');
    }

    public function edit(Admin $super_admin)
    {
        return view('admin.super_admin.edit', [
            'super_admin' => $super_admin,
        ]);
    }

    public function update(Request $request, Admin $super_admin)
    {
        $updateAdmin = $request->all();

        $new_password = $request->get('password');
        if ($new_password) {
            $updateAdmin['password'] = Hash::make($new_password);
        } else {
            $updateAdmin = $request->except('password');
        }

        $super_admin->update($updateAdmin);

        return redirect()
        ->action([AdminController::class, 'index'])
        ->with('success', 'Edit Success');
    }

}

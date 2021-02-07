<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Helpers\StringGenerator;
use Illuminate\Http\Request;
use App\Traits\ImageTrait;
use Illuminate\Support\Facades\Hash;

class CustomerController extends Controller
{
    use ImageTrait;
    public $customerStatus = [
        'active' => 'Active',
        'pending' => 'Pending',
        'suspend' => 'Suspend',
        'inactive' => 'Inactive',
    ];
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $customers = Customer::orderBy('updated_at', 'DESC')
            ->with('proofImage')
            ->paginate(5);
        return view('admin.customer.index', ['customers' => $customers]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.customer.create', ['status' => $this->customerStatus]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $newCustomer = $request->all();
        $newCustomer['slug'] = (new StringGenerator())->generateSlug();
        $newCustomer['password'] = Hash::make($request->password);

        if($request->hasFile('proof_image')) {
            $file = $request->file('proof_image');
            $proof_image = $this->storeImage($file, "");
            $newCustomer['proof_image_id'] = $proof_image->id;
        }

        $newCustomer = Customer::create($newCustomer);
        return redirect()->action([CustomerController::class, 'index']);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Customer  $customer
     * @return \Illuminate\Http\Response
     */
    public function show(Customer $customer)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Customer  $customer
     * @return \Illuminate\Http\Response
     */
    public function edit(Customer $customer)
    {
        return view('admin.customer.edit', ['customer' => $customer, 'status' => $this->customerStatus]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Customer  $customer
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Customer $customer)
    {
        $newCustomer = $request->all();
        $newCustomer['password'] = Hash::make($request->password);

        if($request->hasFile('proof_image')) {
            $file = $request->file('proof_image');
            $proof_image = $this->storeImage($file, "");
            $newCustomer['proof_image_id'] = $proof_image->id;
        }

        $customer->update($newCustomer);
        return redirect()->action([CustomerController::class, 'index']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Customer  $customer
     * @return \Illuminate\Http\Response
     */
    public function destroy(Customer $customer)
    {
        $customer->delete();
        return redirect()->action([CustomerController::class, 'index']);
    }
}

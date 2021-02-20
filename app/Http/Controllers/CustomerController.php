<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Models\Product;
use App\Helpers\StringGenerator;
use App\Models\Address;
use App\Models\CustomerProduct;
use Illuminate\Http\Request;
use App\Traits\ImageTrait;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;

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
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $page = 10;
        $sort = $request->query('sort');
        if($sort == 'name_asc') {
            $customers = Customer::orderBy('first_name', 'ASC')
                ->paginate($page);
        } else if($sort == 'name_desc') {
            $customers = Customer::orderBy('first_name', 'DESC')
                ->paginate($page);
        } else {
            $customers = Customer::orderBy('updated_at', 'DESC')
                ->paginate($page);
        }
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

        if($request->hasFile('avatar_image')) {
            $file = $request->file('avatar_image');
            $image_record = $this->storeImage($file, "");
            $newCustomer['avatar_image'] = $image_record->id;
        }

        if($request->hasFile('citizen_card_image')) {
            $file = $request->file('citizen_card_image');
            $image_record = $this->storeImage($file, "");
            $newCustomer['citizen_card_image'] = $image_record->id;
        }

        if($request->hasFile('drug_store_approve_image')) {
            $file = $request->file('drug_store_approve_image');
            $image_record = $this->storeImage($file, "");
            $newCustomer['drug_store_approve_image'] = $image_record->id;
        }

        if($request->hasFile('medical_license_image')) {
            $file = $request->file('medical_license_image');
            $image_record = $this->storeImage($file, "");
            $newCustomer['medical_license_image'] = $image_record->id;
        }

        if($request->hasFile('commercial_register_image')) {
            $file = $request->file('commercial_register_image');
            $image_record = $this->storeImage($file, "");
            $newCustomer['commercial_register_image'] = $image_record->id;
        }

        if($request->hasFile('juristic_person_image')) {
            $file = $request->file('juristic_person_image');
            $image_record = $this->storeImage($file, "");
            $newCustomer['juristic_person_image'] = $image_record->id;
        }

        if($request->hasFile('vat_register_cert_image')) {
            $file = $request->file('vat_register_cert_image');
            $image_record = $this->storeImage($file, "");
            $newCustomer['vat_register_cert_image'] = $image_record->id;
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
        // $customer = Customer::where('slug', $customer->slug)->first();
        return view('admin.customer.show', [
            'customer' => $customer,
            'status' => $this->customerStatus,
        ]);
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

        if($request->hasFile('avatar_image')) {
            $file = $request->file('avatar_image');
            $image_record = $this->storeImage($file, "");
            $newCustomer['avatar_image'] = $image_record->id;
        }

        if($request->hasFile('citizen_card_image')) {
            $file = $request->file('citizen_card_image');
            $image_record = $this->storeImage($file, "");
            $newCustomer['citizen_card_image'] = $image_record->id;
        }

        if($request->hasFile('drug_store_approve_image')) {
            $file = $request->file('drug_store_approve_image');
            $image_record = $this->storeImage($file, "");
            $newCustomer['drug_store_approve_image'] = $image_record->id;
        }

        if($request->hasFile('medical_license_image')) {
            $file = $request->file('medical_license_image');
            $image_record = $this->storeImage($file, "");
            $newCustomer['medical_license_image'] = $image_record->id;
        }

        if($request->hasFile('commercial_register_image')) {
            $file = $request->file('commercial_register_image');
            $image_record = $this->storeImage($file, "");
            $newCustomer['commercial_register_image'] = $image_record->id;
        }

        if($request->hasFile('juristic_person_image')) {
            $file = $request->file('juristic_person_image');
            $image_record = $this->storeImage($file, "");
            $newCustomer['juristic_person_image'] = $image_record->id;
        }

        if($request->hasFile('vat_register_cert_image')) {
            $file = $request->file('vat_register_cert_image');
            $image_record = $this->storeImage($file, "");
            $newCustomer['vat_register_cert_image'] = $image_record->id;
        }

        $customer->update($newCustomer);
        return redirect()->action([CustomerController::class, 'index']);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Customer  $customer
     * @return \Illuminate\Http\Response
     */
    public function updateStatus(Request $request, Customer $customer)
    {
        $status = $request->get('status');
        $remark = $request->get('remark');

        $customer['status'] = $status;
        $customer['remark'] = $remark;
        $customer->save();

        return redirect()->back();
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

    public function showProfile()
    {
        $authCustomer = auth()->guard('customer')->user();
        if ($authCustomer) {
            $customer = Customer::where('slug', $authCustomer->slug)->first();
            return view('customer.profile', [
                'customer' => $customer
            ]);
        } else {
            return redirect('login');
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function updateProfile(Request $request)
    {
        $newCustomer = $request->all();
        $authCustomer = auth()->guard('customer')->user();

        if ($authCustomer) {
            $customer = Customer::where('slug', $authCustomer->slug)->first();

            if($request->hasFile('avatar_image')) {
                $file = $request->file('avatar_image');
                $image_record = $this->storeImage($file, "");
                $newCustomer['avatar_image'] = $image_record->id;
            }

            $customer->update($newCustomer);
            return redirect('customer/profile');
        }
    }

    public function showAddress()
    {
        $authCustomer = auth()->guard('customer')->user();
        if ($authCustomer) {
            $customer = Customer::where('slug', $authCustomer->slug)->first();
            $address = $customer->addresses->first();

            return view('customer.address', [
                'customer' => $customer,
                'address' => $address,
            ]);
        } else {
            return redirect('login');
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function updateAddress(Request $request)
    {
        $newAddress = $request->all();
        $authCustomer = auth()->guard('customer')->user();

        if ($authCustomer) {
            $customer = Customer::where('slug', $authCustomer->slug)->first();
            $newAddress['customer_id'] = $customer->id;

            Address::where('customer_id', $customer->id)->delete();
            Address::create($newAddress);

            return redirect('customer/address');
        }
    }

    public function showPassword()
    {
        $authCustomer = auth()->guard('customer')->user();
        if ($authCustomer) {
            $customer = Customer::where('slug', $authCustomer->slug)->first();
            return view('customer.password', [
                'customer' => $customer
            ]);
        } else {
            return redirect('login');
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function updatePassword(Request $request)
    {
        $current_password = $request->get('current_password');
        $new_password = $request->get('new_password');
        $confirm_new_password = $request->get('confirm_new_password');

        $authCustomer = auth()->guard('customer')->user();
        if (Hash::check($current_password, $authCustomer->password)) {
            if ($new_password == $confirm_new_password) {
                $customer = Customer::where('slug', $authCustomer->slug)->first();
                $updateCustomer = ['password' => $new_password];
                $customer->update($updateCustomer);

                Log::info('Change Password Success');
                return redirect('customer/profile');
            } else {
                return redirect()->back();
            }
        } else {
            return redirect()->back();
        }
    }
}

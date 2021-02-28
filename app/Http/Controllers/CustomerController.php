<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Models\Product;
use App\Helpers\StringGenerator;
use App\Models\Address;
use App\Models\CustomerProduct;
use Illuminate\Http\Request;
use App\Traits\ImageTrait;
use App\Traits\ValidateTrait;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;

class CustomerController extends Controller
{
    use ValidateTrait;
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
        return redirect()
            ->action([CustomerController::class, 'index'])
            ->with('success', 'Create Success');
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
        if($request->has('password')) {
            $newCustomer['password'] = Hash::make($request->password);
        }

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
        return redirect()
            ->action([CustomerController::class, 'index'])
            ->with('success', 'Edit Success');
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
        return redirect()
            ->action([CustomerController::class, 'index'])
            ->with('success', 'Delete Success');
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
        $this->validateCustomerProfile($request);

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
            return redirect('customer/profile')->with('success', 'Edit Success');
        } else {
            return redirect('login');
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
        $this->validateCustomerAddress($request);

        $newAddress = $request->all();
        $authCustomer = auth()->guard('customer')->user();

        if ($authCustomer) {
            $customer = Customer::where('slug', $authCustomer->slug)->first();
            $newAddress['customer_id'] = $customer->id;

            Address::where('customer_id', $customer->id)->delete();
            Address::create($newAddress);

            return redirect('customer/address')->with('success', 'Edit Success');
        } else {
            return redirect('login');
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
        $this->validateCustomerPassword($request);

        $current_password = $request->get('current_password');
        $new_password = $request->get('new_password');
        $confirm_new_password = $request->get('confirm_new_password');

        $authCustomer = auth()->guard('customer')->user();
        if (Hash::check($current_password, $authCustomer->password)) {
            if ($new_password == $confirm_new_password) {
                $customer = Customer::where('slug', $authCustomer->slug)->first();
                $updateCustomer = ['password' => $new_password];
                $customer->update($updateCustomer);

                return redirect('customer/profile')->with('success', 'Edit Success');
            } else {
                return redirect()->back();
            }
        } else {
            return redirect()->back();
        }
    }

    public function showDocument()
    {
        $authCustomer = auth()->guard('customer')->user();
        if ($authCustomer) {
            $customer = Customer::where('slug', $authCustomer->slug)->first();
            return view('customer.document', [
                'customer' => $customer,
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
    public function updateDocument(Request $request)
    {
        $this->validateCustomerDocument($request);

        $authCustomer = auth()->guard('customer')->user();
        if ($authCustomer) {
            $customer = Customer::where('slug', $authCustomer->slug)->first();

            if($request->hasFile('avatar_image')) {
                $file = $request->file('avatar_image');
                $image_record = $this->storeImage($file, "");
                $customer->avatar_image = $image_record->id;
            }

            if($request->hasFile('citizen_card_image')) {
                $file = $request->file('citizen_card_image');
                $image_record = $this->storeImage($file, "");
                $customer->citizen_card_image = $image_record->id;
            }

            if($request->hasFile('drug_store_approve_image')) {
                $file = $request->file('drug_store_approve_image');
                $image_record = $this->storeImage($file, "");
                $customer->drug_store_approve_image = $image_record->id;
            }

            if($request->hasFile('medical_license_image')) {
                $file = $request->file('medical_license_image');
                $image_record = $this->storeImage($file, "");
                $customer->medical_license_image = $image_record->id;
            }

            if($request->hasFile('commercial_register_image')) {
                $file = $request->file('commercial_register_image');
                $image_record = $this->storeImage($file, "");
                $customer->commercial_register_image = $image_record->id;
            }

            if($request->hasFile('juristic_person_image')) {
                $file = $request->file('juristic_person_image');
                $image_record = $this->storeImage($file, "");
                $customer->juristic_person_image = $image_record->id;
            }

            if($request->hasFile('vat_register_cert_image')) {
                $file = $request->file('vat_register_cert_image');
                $image_record = $this->storeImage($file, "");
                $customer->vat_register_cert_image = $image_record->id;
            }

            $customer->save();
            return redirect('customer/document')->with('success', 'Edit Success');
        } else {
            return redirect('login');
        }
    }
}

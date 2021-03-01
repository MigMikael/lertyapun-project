<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use Illuminate\Http\Request;
use App\Helpers\StringGenerator;
use Illuminate\Support\Facades\Hash;
use App\Traits\ImageTrait;
use App\Traits\ValidateTrait;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;

class GuestController extends Controller
{
    use ValidateTrait;
    use ImageTrait;

    public function index()
    {
        return view('welcome');
    }

    public function showRegisterForm()
    {
        if(auth()->guard('customer')->check()) {
            return redirect('customer/products');
        }
        return view('customer.register');
    }

    public function register(Request $request)
    {
        $this->validateGuestRegister($request);

        $newCustomer = $request->all();
        $newCustomer['status'] = 'pending';
        $newCustomer['slug'] = (new StringGenerator())->generateSlug();
        $newCustomer['password'] = Hash::make($request->password);

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
        Auth::guard('customer')->login($newCustomer);

        return redirect('customer/pending/'.$newCustomer->slug);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Customer  $customer
     * @return \Illuminate\Http\Response
     */
    public function registerPending(Customer $customer)
    {
        if ($customer->status == 'active') {
            return redirect('customer/products');
        }
        return view('customer.pending', [ 'customer' => $customer ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Customer  $customer
     * @return \Illuminate\Http\Response
     */
    public function registerUpdate(Request $request, Customer $customer)
    {
        $this->validateGuestUpdateRegister($request);

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
        return redirect('customer/pending/'.$customer->slug)
            ->with('success', 'Edit Success');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Customer  $customer
     * @return \Illuminate\Http\Response
     */
    public function registerEdit(Customer $customer)
    {
        if ($customer->status == 'active') {
            return redirect('customer/products');
        }
        return view('customer.register', [ 'customer' => $customer ]);
    }

    public function showLoginForm()
    {
        return view('customer.login');
    }

    public function login(Request $request)
    {
        $email = $request->get('email');
        $password = $request->get('password');

        if (Auth::guard('customer')->attempt(['email' => $email, 'password' => $password])) {
            return redirect('customer/products');
        }
        else if (Auth::guard('admin')->attempt(['email' => $email, 'password' => $password])) {
            return redirect('admin/dashboard');
        }
        else {
            return redirect('login')->with('fail', 'username หรือ password ไม่ถูกต้อง');
        }
    }

    /**
     * Log the user out of the application.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function customerLogout(Request $request)
    {
        Auth::guard('customer')->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/');
    }

    /**
     * Log the user out of the application.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function adminLogout(Request $request)
    {
        Auth::guard('admin')->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/');
    }
}

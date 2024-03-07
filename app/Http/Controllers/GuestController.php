<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Models\Address;
use Illuminate\Http\Request;
use App\Helpers\StringGenerator;
use App\Models\DeliveryReport;
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

    public function about()
    {
        return view('customer.about');
    }

    public function contact()
    {
        return view('customer.contact');
    }

    public function termOfUse()
    {
        return view('customer.term');
    }

    public function privacyPolicy()
    {
        return view('customer.privacy');
    }

    public function showRegisterForm(Request $request)
    {
        $email = $request->get('email');
        if(auth()->guard('customer')->check()) {
            return redirect('customer/products');
        }
        return view('customer.register', [
            'preloadEmail' => $email
        ]);
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

        $authCustomer = auth()->guard('customer')->user();

        $newCustomerAddress = [
            'slug' => '',
            'detail' => $request['detail'],
            'subDistrict' => $request['subDistrict'],
            'district' => $request['district'],
            'province' => $request['province'],
            'zipcode' => $request['zipcode'],
        ];

        if ($authCustomer) {
            $customer = Customer::where('slug', $authCustomer->slug)->first();
            $newCustomerAddress['customer_id'] = $customer->id;

            Address::where('customer_id', $customer->id)->delete();
            Address::create($newCustomerAddress);
        }

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

        return view('customer.pending', [
            'customer' => $customer,
        ]);
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

        $newCustomer = [];
        if($request->password != '') {
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
        $newRemark = "\n(แก้ไขล่าสุด วันที่ " . (\Carbon\Carbon::parse(\Carbon\Carbon::now())->format('d/m/Y')) . " เวลา " . (\Carbon\Carbon::parse(\Carbon\Carbon::now())->format('H:i:s')) . " น.)\n";
        //$newCustomer['remark'] = $customer->remark . $newRemark;
        $newCustomer['remark'] = $newRemark;

        $customer->update($newCustomer);

        $authCustomer = auth()->guard('customer')->user();

        $newCustomerAddress = [
            'slug' => '',
            'detail' => $request['detail'],
            'subDistrict' => $request['subDistrict'],
            'district' => $request['district'],
            'province' => $request['province'],
            'zipcode' => $request['zipcode'],
        ];

        if ($authCustomer) {
            $customer = Customer::where('slug', $authCustomer->slug)->first();
            $newCustomerAddress['customer_id'] = $customer->id;

            Address::where('customer_id', $customer->id)->delete();
            Address::create($newCustomerAddress);
        }

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
        if ($customer->status != 'pending') {
            return redirect('customer/products');
        }

        $address = $customer->addresses->first();

        return view('customer.register', [ 'customer' => $customer, 'address' => $address ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Customer  $customer
     * @return \Illuminate\Http\Response
     */
    public function passwordEdit(Customer $customer)
    {
        if ($customer->status != 'inactive') {
            return redirect('customer/products');
        }
        return view('customer.resetPassword', [ 'customer' => $customer ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Customer  $customer
     * @return \Illuminate\Http\Response
     */
    public function passwordUpdate(Request $request, Customer $customer)
    {
        $this->validateCustomerResetPassword($request);

        $newCustomer = [];
        if($request->password != '') {
            $newCustomer['password'] = Hash::make($request->password);
            $newCustomer['status'] = 'active';
        }

        $customer->update($newCustomer);
        return redirect('login')->with('success', 'รีเซ็ตรหัสผ่านสำเร็จ กรุณาล็อกอินอีกครั้งด้วยรหัสผ่านใหม่');
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

    public function deliveryReport(Request $request) {
        $filterStartDate = $request->get('filter_start_date');
        $filterEndDate = $request->get('filter_end_date');
        $filterSearch = $request->get('filter_search');

        $deliveryReportFilter = DeliveryReport::orderBy('created_at', 'DESC');

        if (!$request->get('filter_start_date') && !$request->get('filter_end_date')) {
            $filterStartDate = date("Y-m-d");
            $filterEndDate = date("Y-m-d");
            $deliveryReportFilter->whereDate('delivery_date', '>=', $filterStartDate)
            ->whereDate('delivery_date', '<=', $filterEndDate);
        }

        if ($request->get('filter_start_date') && $request->get('filter_end_date')) {
            $deliveryReportFilter->whereDate('delivery_date', '>=', $filterStartDate)
            ->whereDate('delivery_date', '<=', $filterEndDate);
        }

        if ($request->get('filter_search')) {
            $deliveryReportFilter->where("customer_name", "like", "%".$filterSearch."%");
        }

        $deliveryReports = $deliveryReportFilter->get();

        return view('delivery-report',
        compact('deliveryReports', 'filterStartDate', 'filterEndDate', 'filterSearch'));
    }
}

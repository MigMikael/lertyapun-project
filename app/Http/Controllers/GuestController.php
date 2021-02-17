<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use Illuminate\Http\Request;
use App\Helpers\StringGenerator;
use Illuminate\Support\Facades\Hash;
use App\Traits\ImageTrait;

class GuestController extends Controller
{
    use ImageTrait;

    public function index()
    {
        return view('welcome');
    }

    public function create()
    {
        return view('customer.register');
    }

    public function store(Request $request)
    {
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
        return redirect()->action([ProductController::class, 'indexCustomerProduct']);
    }
}

<?php
namespace App\Traits;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

trait ValidateTrait
{
    public function validateCustomerProfile(Request $request)
    {
        $request->validate([
            'first_name' => 'required|max:255',
            'last_name' => 'required|max:255',
            'email' => 'required|email|max:255',
            'phone' => 'required|string|min:10|max:12|regex:/[0-9]{9}/',
            'avatar_image' => 'nullable|image',
        ]);
    }

    public function validateCustomerDocument(Request $request)
    {
        $request->validate([
            'citizen_card_image' => 'nullable|image',
            'drug_store_approve_image' => 'nullable|image',
            'medical_license_image' => 'nullable|image',

            'commercial_register_image' => 'nullable|image',
            'juristic_person_image' => 'nullable|image',
            'vat_register_cert_image' => 'nullable|image',
        ]);
    }

    public function validateCustomerAddress(Request $request)
    {
        $request->validate([
            'detail' => 'required|max:255',
            'subDistrict' => 'required|max:255',
            'district' => 'required|max:255',
            'province' => 'required|max:255',
            'zipcode' => 'required|max:5|min:5',
        ]);
    }

    public function validateCustomerPassword(Request $request)
    {
        $request->validate([
            'current_password' => 'required|min:8|max:255',
            'new_password' => 'required|different:current_password|min:8|max:255',
            'confirm_new_password' => 'required|same:new_password|min:8|max:255',
        ]);
    }

    public function validateGuestRegister(Request $request)
    {
        $request->validate([
            'first_name' => 'required|max:255',
            'last_name' => 'required|max:255',
            'email' => 'required|unique:customers,email|email|max:255',
            'phone' => 'required|string|min:10|max:12|regex:/[0-9]{9}/',
            'password' => 'required|min:8|max:255',
            'confirm_password' => 'required|same:password|min:8|max:255',
            'citizen_card_id' => 'required|max:255',
            'drug_store_id' => 'required|max:255',

            'remark' => 'nullable|max:255',
            'status' => 'nullable|max:255',

            'citizen_card_image' => 'image',
            'drug_store_approve_image' => 'image',
            'medical_license_image' => 'image',

            'commercial_register_image' => 'nullable|image',
            'juristic_person_image' => 'nullable|image',
            'vat_register_cert_image' => 'nullable|image',
        ]);
    }

    public function validateGuestUpdateRegister(Request $request)
    {
        $request->validate([
            'first_name' => 'required|max:255',
            'last_name' => 'required|max:255',
            'email' => 'required|email|max:255',
            'phone' => 'required|string|min:10|max:12|regex:/[0-9]{9}/',
            'old_password' => 'required|min:8|max:255',
            'password' => 'nullable|different:old_password|min:8|max:255',
            'confirm_password' => 'nullable|same:password|min:8|max:255',
            'citizen_card_id' => 'required|max:255',
            'drug_store_id' => 'required|max:255',

            'citizen_card_image' => 'nullable|image',
            'drug_store_approve_image' => 'nullable|image',
            'medical_license_image' => 'nullable|image',

            'commercial_register_image' => 'nullable|image',
            'juristic_person_image' => 'nullable|image',
            'vat_register_cert_image' => 'nullable|image',
        ]);
    }

    public function validateCustomerResetPassword(Request $request)
    {
        $request->validate([
            'password' => 'min:8|max:255',
            'confirm_password' => 'same:password|min:8|max:255',
        ]);
    }

    public function validateCreatePromotion(Request $request)
    {
        $request->validate([
            'name' => 'required|max:255',
        ]);
    }

    public function validateCreateCategory(Request $request)
    {
        $request->validate([
            'name' => 'required|max:255',
        ]);
    }

    public function validateCreateProduct(Request $request)
    {
        $request->validate([
            'name' => 'required|max:255',
            'description' => 'nullable|max:255',
            'weight' => 'required|numeric',
            'product_image' => 'required|image',
            'status' => 'required|max:255',
            'point' => 'nullable|numeric',
            'quantity' => 'required|numeric',
            'expired_startdate' => 'nullable|date',
            'expired_enddate' => 'nullable|date',
        ]);
    }

    public function validateUpdateProduct(Request $request)
    {
        $request->validate([
            'name' => 'required|max:255',
            'description' => 'nullable|max:255',
            'weight' => 'required|numeric',
            'product_image' => 'image',
            'status' => 'required|max:255',
            'point' => 'nullable|numeric',
            'quantity' => 'required|numeric',
            'expired_startdate' => 'nullable|date',
            'expired_enddate' => 'nullable|date',
        ]);
    }
}

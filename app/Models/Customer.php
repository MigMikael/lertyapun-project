<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    use HasFactory;
    public $timestamps = true;
    protected $table = 'customers';

    protected $fillable = [
        'slug',
        'first_name',
        'last_name',
        'email',
        'phone',
        'password',
        'status',
        'point',
        'remark',
        'citizen_card_image',
        'drug_store_approve_image',
        'medical_license_image',
        'commercial_register_image',
        'juristic_person_image',
        'vat_register_cert_image'
    ];

    public function citizenCardImage()
    {
        return $this->belongsTo(Image::class, 'citizen_card_image');
    }

    public function drugStoreApproveImage()
    {
        return $this->belongsTo(Image::class, 'drug_store_approve_image');
    }

    public function medicalLicenseImage()
    {
        return $this->belongsTo(Image::class, 'medical_license_image');
    }

    public function commercialRegisterImage()
    {
        return $this->belongsTo(Image::class, 'commercial_register_image');
    }

    public function juristicPersonImage()
    {
        return $this->belongsTo(Image::class, 'juristic_person_image');
    }

    public function vatRegisterCertImage()
    {
        return $this->belongsTo(Image::class, 'vat_register_cert_image');
    }

    public function cart()
    {
        return $this->belongsToMany('App\Models\Product', 'customer_products', 'customer_id', 'product_id')
            ->withPivot('quantity');
    }

    public function orders()
    {
        return $this->hasMany(Order::class);
    }
}

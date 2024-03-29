<?php

namespace App\Models;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Customer extends Authenticatable
{
    use Notifiable;
    use HasFactory;
    public $timestamps = true;
    protected $table = 'customers';
    protected $guard = 'customer';

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
        'avatar_image',
        'citizen_card_image',
        'drug_store_approve_image',
        'medical_license_image',
        'commercial_register_image',
        'juristic_person_image',
        'vat_register_cert_image',
        'citizen_card_id',
        'drug_store_id',
        'store_name'
    ];

    public function avatarImage()
    {
        return $this->belongsTo(Image::class, 'avatar_image');
    }

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
            ->withPivot('quantity', 'unitName');
    }

    public function orders()
    {
        return $this->hasMany(Order::class);
    }

    public function addresses()
    {
        return $this->hasMany(Address::class);
    }
}

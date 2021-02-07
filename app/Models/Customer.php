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
        'proof_image_id',
        'point',
    ];

    public function proofImage()
    {
        return $this->belongsTo(Image::class);
    }

    public function cart()
    {
        return $this->belongsToMany('App\Models\Product', 'customer_product', 'customer_id', 'product_id')
            ->withPivot('quantity');
    }

    public function orders()
    {
        return $this->hasMany(Order::class);
    }
}

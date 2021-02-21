<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;
    public $timestamps = true;
    protected $table = 'orders';

    protected $fillable = [
        'slug',
        'total_amount',
        'status',
        'order_date',
        'payment_method',
        'payment_status',
        'payment_date',
        'customer_id',
        'slip_image_id',
    ];

    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }

    public function orderDetails()
    {
        return $this->hasMany(OrderDetail::class);
    }

    public function products()
    {
        return $this->belongsToMany('App\Models\Product', 'order_details', 'order_id', 'product_id')
            ->withPivot('sale_quantity', 'order_price');
    }

    public function slipImage()
    {
        return $this->belongsTo(Image::class, 'slip_image_id');
    }
}

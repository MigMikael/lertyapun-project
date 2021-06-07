<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
    public $timestamps = true;
    protected $table = 'products';

    protected $fillable = [
        'slug',
        'name',
        'description',
        'price',
        'point',
        'quantity',
        'unit',
        'image_id',
        'status',
        'weight',
        'expired_startdate',
        'expired_enddate',
        'expired_date',
    ];

    public function promotions()
    {
        return $this->belongsToMany('App\Models\Promotion', 'product_promotions', 'product_id', 'promotion_id');
    }

    public function tags()
    {
        return $this->belongsToMany('App\Models\Tag', 'product_tags', 'product_id', 'tag_id');
    }

    public function categories()
    {
        return $this->belongsToMany('App\Models\Category', 'category_products', 'product_id', 'category_id');
    }

    public function cart()
    {
        return $this->belongsToMany('App\Models\Customer', 'customer_products', 'product_id', 'customer_id')
            ->withPivot('quantity');
    }

    public function image()
    {
        return $this->belongsTo(Image::class);
    }

    public function products()
    {
        return $this->belongsToMany('App\Models\Order', 'order_details', 'product_id', 'order_id');
    }

    public function detailImages()
    {
        return $this->belongsToMany('App\Models\Image', 'image_products', 'product_id', 'image_id');
    }

    public function units()
    {
        return $this->hasMany(ProductUnit::class);
    }
}

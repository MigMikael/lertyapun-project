<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CategoryProduct extends Model
{
    use HasFactory;
    public $timestamps = true;
    protected $table = 'category_products';

    protected $fillable = [
        'product_id',
        'category_id',
    ];
}

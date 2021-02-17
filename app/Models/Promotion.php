<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Promotion extends Model
{
    use HasFactory;
    public $timestamps = true;
    protected $table = 'promotions';

    protected $fillable = [
        'slug',
        'name',
        'type',
        'valid_start',
        'valid_end',
    ];

    public function products()
    {
        return $this->belongsToMany('App\Models\Product', 'product_promotions', 'promotion_id', 'product_id');
    }
}

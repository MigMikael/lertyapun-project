<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductUnit extends Model
{
    use HasFactory;
    public $timestamps = true;
    protected $table = 'product_units';

    protected $fillable = [
        'product_id',
        'unitName',
        'pricePerUnit',
        'quantityPerUnit',
    ];
}

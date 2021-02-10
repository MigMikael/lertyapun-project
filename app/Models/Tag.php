<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    use HasFactory;
    public $timestamps = true;
    protected $table = 'tags';

    protected $fillable = [
        'slug',
        'name',
    ];

    public function products()
    {
        return $this->belongsToMany('App\Models\Product', 'product_tags', 'tag_id', 'product_id');
    }
}

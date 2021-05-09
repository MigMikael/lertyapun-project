<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DaliveryService extends Model
{
    use HasFactory;
    public $timestamps = true;
    protected $table = 'dalivery_services';

    protected $fillable = [
        'name',
        'status',
        'image_id'
    ];
}

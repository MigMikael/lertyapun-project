<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DeliveryReport extends Model
{
    use HasFactory;
    public $timestamps = true;
    protected $table = 'delivery_reports';

    protected $guarded = [];
}

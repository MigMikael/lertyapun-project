<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BankAccount extends Model
{
    use HasFactory;
    public $timestamps = true;
    protected $table = 'bank_accounts';

    protected $fillable = [
        'account_no',
        'account_name',
        'bank_name',
        'branch_name',
        'status',
        'image_id'
    ];
}

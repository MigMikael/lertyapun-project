<?php

namespace App\Models;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Admin extends Authenticatable
{
    use Notifiable;
    use HasFactory;
    public $timestamps = true;
    protected $table = 'admins';
    protected $guard = 'admin';

    protected $fillable = [
        'slug',
        'name',
        'email',
        'password',
    ];
}

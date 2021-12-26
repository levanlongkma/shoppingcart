<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Hash;

class Admin extends Authenticatable
{
    use SoftDeletes;
    
    protected $guard = ['admin'];

    protected $guarded = [];

    protected $hidden = [
        'password', 'remember_token'
    ];

    public function setPasswordAttribute($value) {
        return $this->attributes['password'] = Hash::make($value);
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Hash;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Admin extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $guard = ['admin'];

    protected $guarded = [];

    protected $hidden = [
        'password', 'remember_token'
    ];

    public function setPasswordAttribute($value) {
        return $this->attributes['password'] = Hash::make($value);
    }
}

<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    use HasFactory;
    protected $fillable = [
        'name_customer',
        'password',
        'phone',
        'email',
        'birthday',
        'address',
        'gender',
        'image',
        'status',
    ];
    public function orders()
    {
        return $this->hasMany(Order::class, 'id_customer');
    }
}

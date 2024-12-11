<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;
    protected $fillable = [
        'id_customer',
        'name_customer',
        'phone',
        'email',
        'address',
        'note',
        'total_amount',
        'date_order',
        'time_order',
        'name_payment',
        'status',
    ];
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductItem extends Model
{
    use HasFactory;
    protected $fillable = [
        'id_product',
        'id_color',
        'price',
        'discount_price',
    ];

    protected static function boot()
    {
        parent::boot();

        static::saving(function ($model) {
            // Kiểm tra nếu không phải là tạo mới và có thay đổi id_size, loại bỏ nó
            if (! $model->exists || $model->isDirty('id_size')) {
                unset($model->id_size);
            }
        });
    }
}

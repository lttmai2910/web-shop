<?php

namespace App\Providers;

use App\Models\User;
use App\Models\Customer;
use App\Models\Order;
use App\Models\OrderDetail;
use App\Models\Post;
use App\Models\Product;
use App\Models\ProductCategory;
use App\Models\ProductColor;
use App\Models\ProductGallery;
use App\Models\ProductItem;
use App\Models\ProductSize;
use App\Models\Size;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Route;

class RouteServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        Route::model('user', User::class);
        Route::model('customer', Customer::class);
        Route::model('productcategory', ProductCategory::class);
        Route::model('product', Product::class);
        Route::model('productcolor', ProductColor::class);
        Route::model('productitem', ProductItem::class);
        Route::model('productgallery', ProductGallery::class);
        Route::model('productsize', ProductSize::class);
        Route::model('size', Size::class);
        Route::model('post', Post::class);
        Route::model('order', Order::class);
        Route::model('orderdetail', OrderDetail::class);
    }
}

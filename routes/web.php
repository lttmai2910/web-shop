<?php

use App\Http\Controllers\Admin\ProductSizeController as AdminProductSizeController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\ProductCategoryController;
use App\Http\Controllers\ProductColorController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProductGalleryController;
use App\Http\Controllers\ProductItemController;
use App\Http\Controllers\ProductSizeController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\PublicRegisterController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\SizeController;
use App\Http\Controllers\StatisticController;
use App\Http\Controllers\UserController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use SebastianBergmann\CodeCoverage\Report\Html\Dashboard;

Route::get('/', function () {
    return Inertia::render('Welcome', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
    ]);
});

Route::get('/dashboard', function () {
    return Inertia::render('Dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// Route::get('/Admin/Dashboard', function () {
//     return inertia('Dashboard');
// })->name('dashboard');

/* ProductCategory */
Route::get('/Admin/ProductCategory/Index', [ProductCategoryController::class,'index'])->name('productcategory.index');
Route::delete('/Admin/ProductCategory/Index/{id}', [ProductCategoryController::class,'destroy'])->name('productcategory.destroy');
Route::get('/Admin/ProductCategory/Create', [ProductCategoryController::class,'create'])->name('productcategory.create');
Route::post('/Admin/ProductCategory/Create', [ProductCategoryController::class,'store'])->name('productcategory.store');
Route::get('/Admin/ProductCategory/Edit/{productcategory}', [ProductCategoryController::class,'edit'])->name('productcategory.edit');
Route::post('/Admin/ProductCategory/Edit/{id}', [ProductCategoryController::class,'update'])->name('productcategory.update');

/* Product */
Route::get('/Admin/Product/Index', [ProductController::class,'index'])->name('product.index');
Route::delete('/Admin/Product/Index/{id}', [ProductController::class,'destroy'])->name('product.destroy');
Route::get('/Admin/Product/Create', [ProductController::class,'create'])->name('product.create');
Route::post('/Admin/Product/Create', [ProductController::class,'store'])->name('product.store');
Route::get('/Admin/Product/Edit/{product}', [ProductController::class,'edit'])->name('product.edit');
Route::post('/Admin/Product/Edit/{id}', [ProductController::class,'update'])->name('product.update');
Route::get('/Admin/Product/Search', [ProductController::class, 'search'])->name('product.search');

/* ProductSize */
Route::get('/Admin/ProductSize/Create/{id}', [ProductSizeController::class, 'create'])->name('productsize.create');
Route::post('/Admin/ProductSize', [ProductSizeController::class, 'store'])->name('productsize.store');

/* ProductItem */
Route::get('/Admin/Product/ProductItem/{id}', [ProductController::class, 'show'])->name('product.show');
Route::get('/Admin/ProductItem/Edit/{id}', [ProductItemController::class, 'edit'])->name('productitem.edit');
Route::post('/Admin/ProductItem/Edit/{id}', [ProductItemController::class, 'update'])->name('productitem.update');
Route::get('/Admin/ProductItem/Create/{id}', [ProductItemController::class, 'create'])->name('productitem.create');
Route::post('/Admin/ProductItem/Store', [ProductItemController::class, 'store'])->name('productitem.store');

/* ProductGallery */
Route::get('/Admin/ProductGallery/Index', [ProductGalleryController::class,'index'])->name('productgallery.index');
Route::delete('/Admin/ProductGallery/Index/{id}', [ProductGalleryController::class,'destroy'])->name('productgallery.destroy');
Route::get('/Admin/ProductGallery/Create', [ProductGalleryController::class,'create'])->name('productgallery.create');
Route::post('/Admin/ProductGallery/Create', [ProductGalleryController::class,'store'])->name('productgallery.store');
Route::get('/Admin/ProductGallery/Edit/{productgallery}', [ProductGalleryController::class,'edit'])->name('productgallery.edit');
Route::post('/Admin/ProductGallery/Edit/{id}', [ProductGalleryController::class,'update'])->name('productgallery.update');

/* Size */
Route::get('/Admin/Size/Index', [SizeController::class,'index'])->name('size.index');
Route::delete('/Admin/Size/Index/{id}', [SizeController::class,'destroy'])->name('size.destroy');
Route::get('/Admin/Size/Create', [SizeController::class,'create'])->name('size.create');
Route::post('/Admin/Size/Create', [SizeController::class,'store'])->name('size.store');
Route::get('/Admin/Size/Edit/{size}', [SizeController::class,'edit'])->name('size.edit');
Route::post('/Admin/Size/Edit/{id}', [SizeController::class,'update'])->name('size.update');

/* ProductColor */
Route::get('/Admin/ProductColor/Index', [ProductColorController::class,'index'])->name('productcolor.index');
Route::delete('/Admin/ProductColor/Index/{id}', [ProductColorController::class,'destroy'])->name('productcolor.destroy');
Route::get('/Admin/ProductColor/Create', [ProductColorController::class,'create'])->name('productcolor.create');
Route::post('/Admin/ProductColor/Create', [ProductColorController::class,'store'])->name('productcolor.store');
Route::get('/Admin/ProductColor/Edit/{productcolor}', [ProductColorController::class,'edit'])->name('productcolor.edit');
Route::post('/Admin/ProductColor/Edit/{id}', [ProductColorController::class,'update'])->name('productcolor.update');

/* Customer */
Route::get('/Admin/Customer/Index', [CustomerController::class,'index'])->name('customer.index');
Route::delete('/Admin/Customer/Index/{id}', [CustomerController::class,'destroy'])->name('customer.destroy');
Route::get('/Admin/Customer/Edit/{customer}', [CustomerController::class,'edit'])->name('customer.edit');
Route::post('/Admin/Customer/Edit/{id}', [CustomerController::class,'update'])->name('customer.update');

/* User */
Route::get('/Admin/User/Index', [UserController::class,'index'])->name('user.index');
Route::delete('/Admin/User/Index/{id}', [UserController::class,'destroy'])->name('user.destroy');
Route::get('/Admin/User/Create', [UserController::class,'create'])->name('user.create');
Route::post('/Admin/User/Create', [UserController::class,'store'])->name('user.store');
Route::get('/Admin/User/Edit/{user}', [UserController::class,'edit'])->name('user.edit');
Route::post('/Admin/User/Edit/{id}', [UserController::class,'update'])->name('user.update');

/* Post */
Route::get('/Admin/Post/Index', [PostController::class,'index'])->name('post.index');
Route::delete('/Admin/Post/Index/{id}', [PostController::class,'destroy'])->name('post.destroy');
Route::get('/Admin/Post/Create', [PostController::class,'create'])->name('post.create');
Route::post('/Admin/Post/Create', [PostController::class,'store'])->name('post.store');
Route::get('/Admin/Post/Edit/{post}', [PostController::class,'edit'])->name('post.edit');
Route::post('/Admin/Post/Edit/{id}', [PostController::class,'update'])->name('post.update');

/* Order */
Route::get('/Admin/Order/Index', [OrderController::class,'index'])->name('order.index');
Route::delete('/Admin/Order/Index/{id}', [OrderController::class,'destroy'])->name('order.destroy');
Route::get('/Admin/Order/Edit/{order}', [OrderController::class,'edit'])->name('order.edit');
Route::post('/Admin/Order/Edit/{id}', [OrderController::class,'update'])->name('order.update');

/* OrderDetail */
Route::get('/Admin/Order/OrderDetail/{id}', [OrderController::class, 'show'])->name('order.show');

/* Statistic */
Route::get('/Admin/Statistic/Index', [StatisticController::class,'index'])->name('statistic.index');

/* Public */
//Home
Route::get('/', [HomeController::class, 'index'])->name('welcome');

//About
Route::get('/Public/About', function (){ return inertia('Public/About'); })->name('about');
Route::get('/Public/Profile', function (){ return inertia('Public/Profile'); })->name('profile');

//Post
Route::get('/Public/Post/Index', [PostController::class,'post'])->name('post');
Route::get('/Public/Post/PostItem/{id}', [PostController::class, 'show'])->name('postitem');

//Product
Route::get('/Public/Product/Index', [ProductController::class,'product'])->name('product');   
Route::get('/Public/Product/ProductItem/{id}', [ProductItemController::class, 'productitem'])->name('productitem');
Route::put('Public/Product/ProductItem/{id}', [CartController::class, 'updateQuantity'])->name('productitem.updateQuantity');

//Cart
Route::get('Public/Cart/Index/{id}', [CartController::class, 'store'])->name('cart.add');
Route::get('Public/Cart/Index', [CartController::class, 'index'])->name('cart');
Route::delete('Public/Cart/Index/{id}', [CartController::class, 'destroy'])->name('cart.destroy');
Route::put('Public/Cart/Index/{id}', [CartController::class, 'updateQuantity'])->name('cart.updateQuantity');
Route::get('Public/Cart/Pay', [OrderController::class, 'pay'])->name('cart.pay');
Route::post('/', [OrderController::class, 'checkout'])->name('cart.checkout');

//Search
Route::get('/Public/Search', [ProductController::class, 'searchPublic'])->name('product.search');

//Login
Route::get('/Public/Login', [LoginController::class, 'login'])->name('login.index');
Route::post('/Public/Login/Check', [LoginController::class, 'checklogin'])->name('login.check');
Route::post('/Public/Logout', [LoginController::class, 'logout'])->name('login.logout');
Route::post('/Public/Update/{id}', [LoginController::class, 'update'])->name('login.update');

Route::get('/Public/Register', [PublicRegisterController::class, 'register'])->name('register.index');
Route::post('/Public/Register/Store', [PublicRegisterController::class, 'store'])->name('register.store');

Route::get('/dashboard', [DashboardController::class, 'count'])->name('dashboard');

require __DIR__.'/auth.php';

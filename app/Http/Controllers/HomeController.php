<?php 
namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Post;
use App\Models\ProductGallery;
use App\Models\ProductItem;
use Inertia\Inertia;
use Inertia\Response;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index(Request $request): Response
{
    $customer = $request->session()->get('customer', []);
    $products = Product::latest()->take(8)->get();
    $productGalleries = ProductGallery::all();
    $productItems = ProductItem::all();
    $posts = Post::with('user')->where('status', 1)->latest()->take(3)->get();
    $newProducts = [];

    foreach ($productItems as $productItem) {
        $productGallery = ProductGallery::where('id_product_item', $productItem->id)->first(); // Lấy ảnh đầu tiên từ mỗi productItem
        if ($productGallery) {
            $newProducts[] = $productGallery; // Thêm productGallery vào mảng newProducts
        }
    }

    // Lọc sản phẩm có chi tiết và hình ảnh
    $products = $products->filter(function ($product) {
        return ProductItem::where('id_product', $product->id)->exists() && 
               ProductGallery::where('id_product_item', $product->id)->exists();
    });

    return Inertia::render('Welcome', [
        'customers' => $customer,
        'products' => $products,
        'productItems' => $productItems,
        'posts' => $posts,
        'productGalleries' => $productGalleries,
        'newProducts' => $newProducts,
    ]);
}

    
    
}
?>
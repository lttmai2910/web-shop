<?php
namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\OrderDetail;
use App\Models\Product;
use App\Models\ProductCategory;
use App\Models\ProductGallery;
use App\Models\ProductItem;
use App\Models\ProductSize;
use Inertia\Inertia;
use Inertia\Response;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ProductController extends Controller 
{
    public function index(Request $request): Response
    {
        $query = Product::query();
    
        // Lọc sản phẩm theo danh mục nếu có biến selectedCategory được truyền
        if ($request->has('category') || $request->filled('category')) {
            $query->where('id_product_category', $request->input('category'));
        }
    
        // Lấy danh sách sản phẩm dựa trên truy vấn đã được lọc
        $products = $query->latest()->paginate(10);
    
        // Lấy danh sách các mục sản phẩm và danh mục sản phẩm
        $productItems = ProductItem::all();
        $categories = ProductCategory::all();
    
        return Inertia::render('Admin/Product/Index', [
            'products' => $products,
            'productItems' => $productItems,
            'categories' => $categories
        ]);
    }
    

    public function destroy($id): RedirectResponse
    {
        Product::find($id) -> update([
            'status' => 0,
        ]);

        return Redirect::route('product.index');
    }
    
    
    public function create()
    {
        return Inertia::render('Admin/Product/Create');
    }

    public function store(Request $request): RedirectResponse
    {
        Product::create([
            'id_product_category' => $request->id_product_category,
            'product_name' => $request->product_name,
            'description' => $request->description,
            'status' => $request->status,
        ]);
        return Redirect::route('product.index');
    }

    public function edit(Product $product)
    {
        return Inertia::render('Admin/Product/Edit', ['product'=>$product]);
    }

    public function update($id, Request $request): RedirectResponse
    {
        Product::find($id)->update([
            'id_product_category' => $request->id_product_category,
            'product_name' => $request->product_name,
            'description' => $request->description,
            'status' => $request->status,
        ]);
        return Redirect::route('product.index');
    }
    
    public function show($id)
    {
        $product = DB::table('products')->where('id', $id)->first();
        $productItems = DB::table('product_items')->where('id_product', $id)->first();
        
        // Retrieve all sizes associated with the product item
        $productSizes = DB::table('product_sizes')
                        ->where('id_product_item', $productItems->id)
                        ->join('sizes', 'product_sizes.id_size', '=', 'sizes.id')
                        ->select('sizes.id', 'sizes.size')
                        ->get();
    
        return Inertia::render('Admin/Product/Show', [
            'product' => $product,
            'productitems' => $productItems,
            'productSizes' => $productSizes,
        ]);
    }
    
    
    public function welcome(): Response
    {
        $products = Product::all();
        $productItems = ProductItem::all(); // Truy vấn dữ liệu từ bảng ProductItem
        $productGalleries = ProductGallery::all();

        return Inertia::render('Welcome', [
            'products' => $products,
            'productItems' => $productItems,
            'productGalleries' => $productGalleries,
        ]);
    }
    
    public function product(Request $request): Response
    {
        // Lấy tất cả các danh mục đang hoạt động
        $activeCategories = ProductCategory::where('status', 1)->pluck('id')->toArray();
    
        $query = Product::query();
    
        // Lọc sản phẩm theo danh mục nếu có tham số 'category' và danh mục đó đang hoạt động
        if ($request->has('category') && $request->filled('category')) {
            $category = $request->input('category');
            if (in_array($category, $activeCategories)) {
                $query->where('id_product_category', $category);
            } else {
                // Nếu danh mục không hoạt động, trả về không có sản phẩm nào
                $query->where('id', -1); // điều kiện không hợp lệ để trả về kết quả trống
            }
        } else {
            // Nếu không có danh mục nào được chỉ định, chỉ hiển thị sản phẩm từ các danh mục đang hoạt động
            $query->whereIn('id_product_category', $activeCategories);
        }
    
        // Chỉ lấy các sản phẩm có status = 1
        $query->where('status', 1);
    
        // Lọc sản phẩm chỉ hiển thị những sản phẩm có chi tiết và hình ảnh
        $query->whereExists(function ($subquery) {
            $subquery->select(DB::raw(1))
                ->from('product_items')
                ->whereRaw('product_items.id_product = products.id');
        })->whereExists(function ($subquery) {
            $subquery->select(DB::raw(1))
                ->from('product_galleries')
                ->whereRaw('product_galleries.id_product_item = products.id');
        });
    
        // Lấy danh sách sản phẩm đã được lọc
        $products = $query->latest()->paginate(12);
    
        // Lấy dữ liệu cần thiết cho view
        $productItems = ProductItem::all();
        $categories = ProductCategory::where('status', 1)->get();
        $productGalleries = ProductGallery::all();
        $categoryName = ProductCategory::where('id', $request->input('category'))->where('status', 1)->get();
    
        return Inertia::render('Public/Product/Index', [
            'products' => $products,
            'productItems' => $productItems,
            'categories' => $categories,
            'productGalleries' => $productGalleries,
            'categoryName' => $categoryName,
        ]);
    }
    
    
    public function searchPublic(Request $request)
    {
        $search = $request->input('search');
        
        // Lấy danh sách các danh mục đang hoạt động
        $activeCategories = ProductCategory::where('status', 1)->pluck('id')->toArray();
        
        // Tìm kiếm sản phẩm
        $products = Product::query()
            ->where('product_name', 'like', "%{$search}%")
            ->where('status', 1) // Chỉ lấy các sản phẩm có status = 1
            ->whereIn('id_product_category', $activeCategories); // Chỉ lấy các sản phẩm thuộc danh mục đang hoạt động
        
        // Kiểm tra sản phẩm có chi tiết và hình ảnh
        $products->whereExists(function ($query) {
            $query->select(DB::raw(1))
                ->from('product_items')
                ->whereRaw('product_items.id_product = products.id');
        })->whereExists(function ($query) {
            $query->select(DB::raw(1))
                ->from('product_galleries')
                ->whereRaw('product_galleries.id_product_item = products.id');
        });
    
        // Lấy danh sách sản phẩm đã được lọc và phân trang
        $products = $products->latest()->paginate(10);
    
        // Lấy tất cả product items và product galleries
        $productItems = ProductItem::all();
        $productGalleries = ProductGallery::all();
        
        // Trả về view Public/Search với dữ liệu tìm kiếm và thông tin sản phẩm
        return Inertia::render('Public/Search', [
            'products' => $products,
            'productItems' => $productItems,
            'productGalleries' => $productGalleries,
            'search' => $search
        ]);
    }
    
}

<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\ProductItem;
use Illuminate\Http\Request;
use App\Models\ProductSize;
use App\Models\Size;
use Illuminate\Support\Facades\Redirect;

class ProductSizeController extends Controller
{
    public function create($id)
    {
        // Lấy thông tin chi tiết sản phẩm bằng ID
        $productItem = ProductItem::findOrFail($id);

        // Lấy danh sách các size
        $sizes = Size::all();

        // Lấy các kích cỡ đã được liên kết với chi tiết sản phẩm
        $productItemSizes = ProductSize::where('id_product_item', $id)->pluck('id_size')->toArray();

        return inertia('Admin/ProductSize/Create', [
            'productItem' => $productItem,
            'sizes' => $sizes,
            'productItemSizes' => $productItemSizes, // Chuyển các kích cỡ đã liên kết
        ]);
    }

    public function store(Request $request)
    {
        // Kiểm tra xem kích cỡ đã được liên kết với chi tiết sản phẩm hay chưa
        $existingProductSize = ProductSize::where('id_product_item', $request->id_product_item)
                                          ->where('id_size', $request->id_size)
                                          ->first();

        if ($existingProductSize) {
            return Redirect::back()->with('error', 'Kích thước này đã được thêm trước đó.');
        }

        // Tạo mới bản ghi product size nếu chưa tồn tại
        ProductSize::create([
            'id_product_item' => $request->id_product_item,
            'id_size' => $request->id_size,
        ]);

        return Redirect::route('product.index');
    }
}

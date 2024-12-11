<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Cart;
use App\Models\Customer;
use App\Models\Order;
use App\Models\OrderDetail;
use App\Models\Product;
use App\Models\ProductItem;
use App\Models\ProductGallery;
use App\Models\ProductSize;

use Illuminate\Support\Facades\File;
use Inertia\Inertia;
use Inertia\Response;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CartController extends Controller
{
    
    public function index(Request $request, $id = null): Response
    {
        $customerId = $request->session()->get('customer_id');
        $customer = Customer::find($customerId);

        // Lấy thông tin giỏ hàng từ session
        $cart = $request -> session()->get('cart', []);
        $totalPrice = $this->calculateTotalPrice($cart);

        // Hiển thị giỏ hàng
        return Inertia::render('Public/Cart/Index', [
            'cart' => $cart,
            'totalPrice' => $totalPrice, // Truyền totalPrice vào view
            'customer' => $customer, 
        ]);
    }

public function store(Request $request, $id): RedirectResponse 
{
    $cart = $request->session()->get('cart', []);
    $product = Product::find($id);
    $productItem = DB::table('product_items')->where('id_product', $id)->first();
    $productGalleries = DB::table('product_galleries')->where('id_product_item', $productItem->id)->first();
    $productSizes = ProductSize::where('id_product_item', $productItem->id)
        ->join('sizes', 'product_sizes.id_size', '=', 'sizes.id')
        ->get(['sizes.size']);

    // Thêm truy vấn để lấy thông tin màu sắc từ bảng product_colors
    $productColors = DB::table('product_items')
        ->join('product_colors', 'product_items.id_color', '=', 'product_colors.id')
        ->where('product_items.id', $id)
        ->select('product_colors.color_name')
        ->first();

    if ($product && $productItem) {
        $itemKey = $productItem->id;

        if (isset($cart[$itemKey])) {
            $cart[$itemKey]['quantity']++;
        } else {
            $cart[$itemKey] = [
                'id_product_category' => $product->id_product_category,
                'id' => $id,
                'product_name' => $product->product_name,
                'description' => $product->description,
                'status' => $product->status,
                'price' => $productItem->price,
                'discount_price' => $productItem->discount_price,
                'image' => $productGalleries->image,
                'quantity' => 1,
                'sizes' => $productSizes->pluck('size')->toArray(),
                'color_name' => $productColors->color_name, // Thêm thông tin màu sắc vào giỏ hàng
            ];
        }

        $request->session()->put('cart', $cart);
    }
    return Redirect::route('cart');
}


    private function calculateTotalPrice(array $cart): float
    {
        $totalPrice = 0;

        foreach ($cart as $item) {
            $totalPrice += $item['quantity'] * $item['discount_price']; // Sử dụng giá giảm giá
        }
        return $totalPrice;
    }

    public function updateQuantity(Request $request, $id): RedirectResponse
    {
        $cart = $request->session()->get('cart', []);
        $action = $request->input('action');
        $quantity = $request->input('quantity');
    
        if (isset($cart[$id])) {
            if ($action === 'increase') {
                $cart[$id]['quantity']++;
            } elseif ($action === 'decrease') {
                if ($cart[$id]['quantity'] > 1) {
                    $cart[$id]['quantity']--;
                }
            } elseif ($action === 'update' && is_numeric($quantity) && $quantity > 0) {
                $cart[$id]['quantity'] = $quantity;
            } else {
                // Nếu số lượng <= 0 thì xóa sản phẩm khỏi giỏ hàng
                unset($cart[$id]);
                session()->put('cart', $cart);
            }
            $request->session()->put('cart', $cart);
        }
    
        return redirect()->route('cart');
    }

    public function destroy($id): RedirectResponse
    {   
        $cart = session()->get('cart', []);

            if (isset($cart[$id])) {
                unset($cart[$id]);
                session()->put('cart', $cart);
            }
            return redirect()->route('cart')->with('success', 'Sản phẩm đã được xóa khỏi giỏ hàng.');
    }
}


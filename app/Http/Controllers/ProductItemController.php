<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\ProductItem;
use App\Models\Product;
use App\Models\ProductColor;
use App\Models\ProductGallery;
use App\Models\ProductSize;
use App\Models\Size;
use Inertia\Inertia;
use Inertia\Response;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ProductItemController extends Controller 
{    
    public function create($id_product)
    {
        $sizes = Size::all();
        return Inertia::render('Admin/ProductItem/Create', ['id_product' => $id_product, 'sizes' => $sizes]);
    }

    public function store(Request $request): RedirectResponse
    {
    $productItem = ProductItem::create([
        'id_product' => $request->id_product,
        'id_color' => $request->id_color,
        'price' => $request->price,
        'discount_price' => $request->discount_price,
    ]);

    $productItemId = $productItem->id;

    DB::table('product_sizes')->insert([
        'id_product_item' => $productItemId,
        'id_size' => $request->id_size,
    ]);

    return Redirect::route('product.index');
    }

    public function edit(Product $product)
    {
        return Inertia::render('Admin/Product/Show', ['product'=>$product]);
    }

    public function update($id, Request $request): RedirectResponse
    {

    ProductItem::find($id)->update([
        'id_product' => $request -> id_product,
        'id_color' => $request -> id_color,
        'price' => $request -> price,
        'discount_price' => $request -> discount_price,
    ]);
    
    return Redirect::route('product.index');
    }

    public function productitem($id)
    {
        $product = Product::findOrFail($id);

        // Fetch product items related to the product
        $productItems = ProductItem::where('id_product', $id)->get();

        // Fetch product galleries related to the product items
        $productGalleries = ProductGallery::whereIn('id_product_item', $productItems->pluck('id'))->get();

        // Fetch product sizes related to the product
        $productSizes = ProductSize::whereIn('id_product_item', $productItems->pluck('id'))
            ->join('sizes', 'product_sizes.id_size', '=', 'sizes.id')
            ->get(['sizes.size']);

        // Fetch product colors related to the product items
        $productColors = ProductColor::whereIn('id', $productItems->pluck('id_color'))->get();

        return Inertia::render('Public/Product/ProductItem', [
            'product' => $product,
            'productItems' => $productItems,
            'productGalleries' => $productGalleries,
            'productSizes' => $productSizes,
            'productColors' => $productColors,
        ]);
    }
}
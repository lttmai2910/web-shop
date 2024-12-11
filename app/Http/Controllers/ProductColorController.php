<?php
namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\ProductColor;
use Inertia\Inertia;
use Inertia\Response;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;

class ProductColorController extends Controller 
{

    public function index(): Response
    {
        $productcolor = ProductColor::latest()->paginate(10);
        return Inertia::render('Admin/ProductColor/Index', ['productcolor'=>$productcolor]);
    }

    public function destroy($id): RedirectResponse
    {
        ProductColor::find($id)->delete();
        return Redirect::route('productcolor.index');
    }

    public function create()
    {
        return Inertia::render('Admin/ProductColor/Create');
    }

    public function store(Request $request): RedirectResponse
    {
        ProductColor::create([
            'color_name' => $request->color_name,
        ]);
        return Redirect::route('productcolor.index');
    }

    public function edit(ProductColor $productColor)
    {
        return Inertia::render('Admin/ProductColor/Edit', ['productcolor'=>$productColor]);
    }

    public function update($id, Request $request): RedirectResponse
    {
        ProductColor::find($id)->update([
            'color_name' => $request->color_name,
        ]);
        return Redirect::route('productcolor.index');
    }
}

<?php
namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\ProductGallery;
use App\Models\ProductItem;
use Inertia\Inertia;
use Inertia\Response;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;

require_once('Config.php');

class ProductGalleryController extends Controller 
{

    public function index(): Response
    {
        $productgallery = ProductGallery::latest()->paginate(10);
        return Inertia::render('Admin/ProductGallery/Index', ['productgallery'=>$productgallery]);
    }

    public function destroy($id): RedirectResponse
    {
        $images = DB::select('select image from product_galleries where id = :id', ['id' => $id]);
        foreach ($images as $image)
        {
            File::delete(public_path(path_delete_productgall.$image->image));
        }
        ProductGallery::find($id)->delete();
        return Redirect::route('productgallery.index');
    }

    public function create()
    {
        return Inertia::render('Admin/ProductGallery/Create');
    }

    public function store(Request $request): RedirectResponse
    {
        $filename = time().'.'.$request->image->extension();
        $request->image->move(public_path(path_productgall), $filename);  

        ProductGallery::create([
            'id_product_item' => $request->id_product_item,
            'image' => $filename,
        ]);
        return Redirect::route('productgallery.index');
    }

    public function edit(ProductGallery $productgallery)
    {
        return Inertia::render('Admin/ProductGallery/Edit', ['productgallery'=>$productgallery]);
    }

    public function update($id, Request $request): RedirectResponse
    {
        if($request->image){
            $images = DB::select('select image from product_galleries where id = :id', ['id' => $id]);
            foreach ($images as $image)
            {
                File::delete(public_path(path_delete_productgall.$image->image));
            }
            $filename = time().".".$request->image->extension();
            $request->image->move(public_path(path_productgall), $filename);
    
            ProductGallery::find($id)->update([
                'id_product_item' => $request->id_product_item,
                'image' => $filename,
            ]);
        }
        else
        {
            ProductGallery::find($id)->update([
                'id_product_item' => $request->id_product_item,
            ]);
            
        }
        return Redirect::route('productgallery.index');
    }
    
    
}

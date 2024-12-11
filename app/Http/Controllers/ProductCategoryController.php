<?php
namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\ProductCategory;
use Illuminate\Support\Facades\File;
use Inertia\Inertia;
use Inertia\Response;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

require_once('Config.php');

class ProductCategoryController extends Controller 
{

    public function index(): Response
    {
        $productcategory = ProductCategory::latest()->paginate(10);
        return Inertia::render('Admin/ProductCategory/Index', ['productcategory'=>$productcategory]);
    }

    public function destroy($id): RedirectResponse
    {
        $images = DB::select('select image from product_categories where id = :id', ['id' => $id]);
        foreach ($images as $image)
        {
            File::delete(public_path(path_delete.$image->image));
        }
        ProductCategory::find($id)->delete();
        return Redirect::route('productcategory.index');
    }

    public function create()
    {
        return Inertia::render('Admin/ProductCategory/Create');
    }

    public function store(Request $request): RedirectResponse
    {
        // Validator::make($request->all(), [
        //     'category_name' => ['required'],
        //     'description' => ['required'],
        //     'image' => ['required'],
        //     'status' => ['required'],
        // ])->validate();
        
        $filename = time().'.'.$request->image->extension();
        $request->image->move(public_path(path), $filename);  

        ProductCategory::create([
            'category_name' => $request->category_name,
            'description' => $request->description,
            'image' => $filename,
            'status' => $request->status,
        ]);
        return Redirect::route('productcategory.index');
    }

    public function edit(ProductCategory $productCategory)
    {
        return Inertia::render('Admin/ProductCategory/Edit', ['productcategory'=>$productCategory]);
    }

    public function update($id, Request $request): RedirectResponse
    {
        if($request->image){
            $images = DB::select('select image from product_categories where id = :id', ['id' => $id]);
            foreach ($images as $image)
            {
                File::delete(public_path(path_delete.$image->image));
            }
            $filename = time().".".$request->image->extension();
            $request->image->move(public_path(path), $filename);
    
            ProductCategory::find($id)->update([
                'category_name' => $request->category_name,
                'description' => $request->description,
                'image' => $filename,
                'status' => $request->status,
            ]);
        }
        else
        {
            ProductCategory::find($id)->update([
                'category_name' => $request->category_name,
                'description' => $request->description,
                'status' => $request->status,
            ]);
        }
        return Redirect::route('productcategory.index');
    }
}

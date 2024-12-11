<?php
namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Size;
use Inertia\Inertia;
use Inertia\Response;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;

class SizeController extends Controller 
{

    public function index(): Response
    {
        $size = Size::latest()->paginate(10);
        return Inertia::render('Admin/Size/Index', ['size'=>$size]);
    }

    public function destroy($id): RedirectResponse
    {
        Size::find($id)->delete();
        return Redirect::route('size.index');
    }

    public function create()
    {
        return Inertia::render('Admin/Size/Create');
    }

    public function store(Request $request): RedirectResponse
    {
        Size::create([
            'size' => $request->size,
        ]);
        return Redirect::route('size.index');
    }
    
    public function edit(Size $size)
    {
        return Inertia::render('Admin/Size/Edit', ['size'=>$size]);
    }

    public function update($id, Request $request): RedirectResponse
    {
        Size::find($id)->update([
            'size' => $request->size,
        ]);
        return Redirect::route('size.index');
    }

}

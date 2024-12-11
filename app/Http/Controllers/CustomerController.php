<?php
namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Customer;
use Inertia\Inertia;
use Inertia\Response;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\File;

require_once('Config.php');

class CustomerController extends Controller 
{

    public function index(): Response
    {
        $customer = Customer::latest()->paginate(10);
        return Inertia::render('Admin/Customer/Index', ['customer'=>$customer]);
    }

    public function destroy($id): RedirectResponse
    {
        $images = DB::select('select image from customers where id = :id', ['id' => $id]);
        foreach ($images as $image)
        {
            File::delete(public_path(path_delete.$image->image));
        }
        Customer::find($id)->delete();
        return Redirect::route('customer.index');
    }

    public function edit(Customer $customer)
    {
        return Inertia::render('Admin/Customer/Edit', ['customer'=>$customer]);
    }

    public function update($id, Request $request): RedirectResponse
    {
        if($request->image){
            $images = DB::select('select image from customers where id = :id', ['id' => $id]);
            foreach ($images as $image)
            {
                File::delete(public_path(path_delete_customer.$image->image));
            }
            $filename = time().".".$request->image->extension();
            $request->image->move(public_path(path_customer), $filename);
    
            Customer::find($id)->update([
                'name_customer' => $request->name_customer,
                'password' => Hash::make($request->password),
                'phone' => $request->phone,
                'email' => $request->email,
                'birthday' => $request->birthday,
                'address' => $request->address,
                'gender' => $request->gender,
                'image' => $filename,
                'status' => $request->status,
            ]);
        }
        else
        {
            Customer::find($id)->update([
                'name_customer' => $request->name_customer,
                'password' => $request->password,
                'phone' => $request->phone,
                'email' => $request->email,
                'birthday' => $request->birthday,
                'address' => $request->address,
                'gender' => $request->gender,
                'status' => $request->status,
            ]);
        }
        return Redirect::route('customer.index');
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use Illuminate\Http\Request;
use Illuminate\Routing\Route;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Redis;
use Inertia\Inertia;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\DB;

require_once('Config.php');

class LoginController extends Controller
{
    public function login()
    {
        return Inertia::render('Public/Login');
    }

    public function checklogin(Request $request)
    {
        $customer = Customer::where('email','=', $request -> email)->first();
        if (Hash::check($request -> password, $customer -> password))
        {
            $request->session()->put('customer', $customer);
            return redirect()->route('welcome'); 
        }
    }

    public function logout(Request $request)
    {
        // Xóa session 'customer_id' nếu tồn tại
        $request->session()->forget('customer_id');
        
        if ($request -> session() -> exists('customer'))
        {
            $request -> session() -> forget('customer');
            
        }
        return redirect()->route('welcome'); 
    }

    public function update(Request $request, $id)
    {
        if($request->image){
            $images = DB::select('select image from customers where id = :id', ['id' => $id]);
            foreach ($images as $image)
            {
                File::delete(public_path(path_delete_customer.$image->image));
            }
            $filename = time().".".$request->image->extension();
            $request->image->move(public_path(path_customer), $filename);
            
        Customer::find($id) -> update([
            'name_customer' => $request->name_customer,
            'phone' => $request->phone,
            'birthday' => $request->birthday,
            'address' => $request->address,
            'gender' => $request->gender,
            'image' => $filename,
        ]);
        }else
        {
            Customer::find($id) -> update([
                'name_customer' => $request->name_customer,
                'phone' => $request->phone,
                'birthday' => $request->birthday,
                'address' => $request->address,
                'gender' => $request->gender,
            ]);
        }
        $customer = Customer::where('id','=', $id)->first();
        $request -> session() -> put('customer', $customer);
        return redirect()->route('profile'); 
    }
}


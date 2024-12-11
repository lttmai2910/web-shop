<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Customer;
use Illuminate\Support\Facades\Hash;
use Inertia\Inertia;

class PublicRegisterController extends Controller
{
    public function register()
    {
        return Inertia::render('Public/Register');
    }

    public function store(Request $request)
    {

        // Create new customer
        Customer::create([
            'name_customer' => $request -> name_customer,
            'password' => Hash::make($request -> password),
            'phone' => $request -> phone,
            'email' => $request -> email,
            'birthday' => $request -> birthday,
            'address' => $request -> address,
            'gender' => $request -> gender,
            'status' => 1,
        ]);

        // Optionally, you can redirect or return response
        return redirect()->route('login.index'); // Redirect to login page after registration
    }
}

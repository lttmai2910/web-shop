<?php

namespace App\Http\Middleware;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Inertia\Middleware;

class HandleInertiaRequests extends Middleware
{
    /**
     * The root template that is loaded on the first page visit.
     *
     * @var string
     */
    protected $rootView = 'app';

    /**
     * Determine the current asset version.
     */
    public function version(Request $request): string|null
    {
        return parent::version($request);
    }

    /**
     * Define the props that are shared by default.
     *
     * @return array<string, mixed>
     */
    public function share(Request $request): array
    {
        return [
            ...parent::share($request),
            'auth' => [
                'user' => $request->user(),
            ],

            'users' => DB::table('users') ->get(),
            'product_categories' => DB::table('product_categories')->get(),
            'products' => DB::table('products')->get(),
            'product_colors' => DB::table('product_colors')->get(),
            'product_items' => DB::table('product_items')->get(),
            'orders' => DB::table('orders')->get(),
            'order_details' => DB::table('order_details')->get(),
            'product_sizes' => DB::table('product_sizes')->get(),
            'session' => [
                'customer' => $request -> session() -> get('customer'),
            ],
        ];

    }
}

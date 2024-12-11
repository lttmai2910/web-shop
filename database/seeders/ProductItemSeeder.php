<?php

namespace Database\Seeders;

use App\Models\ProductItems;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProductItemSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('product_items')->insert(
            [
                [
                    'id_product' => '1',
                    'id_color' => '1',
                    'price' => '199',
                    'discount_price' => '159',
                ],
                [
                    'id_product' => '2',
                    'id_color' => '1',
                    'price' => '239',
                    'discount_price' => '209',
                ],
            ]
        );
    }
}

<?php

namespace Database\Seeders;

use App\Models\Product;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('products')->insert(
            [
                [
                    'id_product_category' => '1',
                    'product_name' => 'Áo thun Strawberry',
                    'description' => 'ABC',
                    'status' => '1',
                ],
                [
                    'id_product_category' => '2',
                    'product_name' => 'Quần short Strawberry',
                    'description' => 'ABC',
                    'status' => '1',
                ],
            ]
        );
    }
}

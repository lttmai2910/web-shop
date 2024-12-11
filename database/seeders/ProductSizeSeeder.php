<?php

namespace Database\Seeders;

use App\Models\Product;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProductSizeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('product_sizes')->insert(
            [
                [
                    'id_product_item' => '1',
                    'id_size' => '1',
                ],
                [
                    'id_product_item' => '2',
                    'id_size' => '4',
                ],
            ]
        );
    }
}

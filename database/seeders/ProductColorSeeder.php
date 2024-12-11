<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProductColorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('product_colors')->insert(
            [
                [
                    'color_name' => 'Đen',
                ],
                [
                    'color_name' => 'Trắng',
                ],
                [
                    'color_name' => 'Xanh dương',
                ],
                [
                    'color_name' => 'Đỏ rượu',
                ],
            ]
        );
    }
}

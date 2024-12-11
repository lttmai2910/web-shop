<?php

namespace Database\Seeders;

use App\Models\ProductCategory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProductCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('product_categories')->insert(
            [
                [
                    'category_name' => 'Áo thun',
                    'description' => 'Một loạt các áo thun đa dạng về kiểu dáng và màu sắc.',
                    'image' => 'aothun.jpg',
                    'status' => '1',
                ],
                [
                    'category_name' => 'Quần',
                    'description' => 'Những chiếc quần thời trang phù hợp cho mọi lứa tuổi.',
                    'image' => 'quan.jpg',
                    'status' => '1',
                ],
                [
                    'category_name' => 'Phụ kiện',
                    'description' => 'Những phụ kiện xinh đẹp không thể thiếu trong tủ đồ.',
                    'image' => 'phukien.jpg',
                    'status' => '1',
                ],
            ]
        );
    }
}

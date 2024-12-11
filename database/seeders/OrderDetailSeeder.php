<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class OrderDetailSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('order_details')->insert(
            [
                [   
                    'id_order'=> '1',
                    'id_product_item'=> '1' ,
                    'size'=> 'M',
                    'discount_price'=> '189',
                    'quantity'=> '1',
                ],
                [   
                    'id_order'=> '2',
                    'id_product_item'=> '2' ,
                    'size'=> 'Freesize',
                    'discount_price'=> '209',
                    'quantity'=> '1',
                ],
            ]
        );
    }
}

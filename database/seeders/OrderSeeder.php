<?php

namespace Database\Seeders;

use App\Models\Order;
use App\Models\User;
use App\Models\Customer;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class OrderSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('orders')->insert(
            [
                [   
                    'id_customer'=> '1',
                    'name_customer' => 'Nguyễn Thị Thanh Trúc',
                    'phone' => '01234567891',
                    'email' => 'ngthtruc1111@gmail.com',
                    'address' => '111 Trần Phú, Quận 5, TP.HCM',
                    'note'=> '111111',
                    'total_amount'=> '189',
                    'date_order'=> '2024-05-07',
                    'time_order'=> '01:02:04',
                    'name_payment'=> 'Thanh toán khi nhận hàng',
                    'status'=> '1',
                ],
                [   
                    'id_customer'=> '2',
                    'name_customer' => 'Lương Thị Thanh Mai',
                    'phone' => '01234567899',
                    'email' => 'thanhmai@gmail.com',
                    'address' => '3 Tân Bình, TP.HCM',
                    'note'=> '111111',
                    'total_amount'=> '209',
                    'date_order'=> '2024-05-15',
                    'time_order'=> '02:02:02',
                    'name_payment'=> 'Thanh toán khi nhận hàng',
                    'status'=> '1',
                ],
            ]
        );
    }
}

<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PaymentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('payments')->insert(
            [
                [
                    'name_payment' => 'Thanh toán khi nhận hàng',
                ],
                [
                    'name_payment' => 'Thanh toán VNPay',
                ],
            ]
        );
    }
}

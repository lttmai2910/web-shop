<?php

namespace Database\Seeders;

use App\Models\Customer;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CustomerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('customers')->insert(
            [
                [
                    'name_customer' => 'Nguyễn Thị Thanh Trúc',
                    'password' => 'ngthtruc111',
                    'phone' => '01234567891',
                    'email' => 'ngthtruc1111@gmail.com',
                    'birthday' => '2003-11-01',
                    'address' => '111 Trần Phú, Quận 5, TP.HCM',
                    'gender' => '0',
                    'image' => 'nguoidung1.jpg',
                    'status' => '1',
                ],
                [
                    'name_customer' => 'Lương Thị Thanh Mai',
                    'password' => 'thanhmai29',
                    'phone' => '01234567899',
                    'email' => 'thanhmai@gmail.com',
                    'birthday' => '2003-11-01',
                    'address' => '3 Tân Bình, TP.HCM',
                    'gender' => '0',
                    'image' => 'nguoidung2.jpg',
                    'status' => '1',
                ],
            ]
        );
    }
}

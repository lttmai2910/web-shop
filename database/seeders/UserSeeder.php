<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('users')->insert(
            [
                [
                    'name' => 'Nguyễn Thị Thanh Trúc',
                    'birthday' => '2003-11-01',
                    'address' => '111 Trần Phú, Quận 5, TP.HCM',
                    'gender' => '0',
                    'image' => 'anh1.jpg',
                    'role' => '1',
                    'status' => '1',
                    'email' => 'ngthtruc1002@gmail.com',
                    'password' => 'ngthtruc111',
                ],
                [
                    'name' => 'Lương Thị Thanh Mai',
                    'birthday' => '2003-09-29',
                    'address' => '222 Nguyễn Chính Sắt, Quận Tân Bình, TP.HCM',
                    'gender' => '0',
                    'image' => 'anh2.jpg',
                    'role' => '1',
                    'status' => '1',
                    'email' => 'cogaithang10@gmail.com',
                    'password' => '12345678',
                ],
            ]
        );
    }
}

<?php

namespace Database\Seeders;

use App\Models\Customer;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call(UserSeeder::class);
        $this->call(CustomerSeeder::class);
        $this->call(ProductCategorySeeder::class);
        $this->call(ProductSeeder::class);
        $this->call(ProductColorSeeder::class);
        $this->call(ProductItemSeeder::class);
        $this->call(SizeSeeder::class);
        $this->call(PaymentSeeder::class);
        $this->call(ProductSizeSeeder::class);
        $this->call(OrderSeeder::class);
        $this->call(PostSeeder::class);
        $this->call(OrderDetailSeeder::class);
    }
}

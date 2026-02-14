<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Product;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Product::insert([
            ['name' => 'Laptop', 'price' => 1200.00],
            ['name' => 'Smartphone', 'price' => 699.99],
            ['name' => 'Tablet', 'price' => 399.99],
            ['name' => 'Headphones', 'price' => 149.99],
            ['name' => 'Smartwatch', 'price' => 199.99],
        ]);
    }
}

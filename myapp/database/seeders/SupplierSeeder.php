<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Supplier;
use App\Models\Product;

class SupplierSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Supplier::factory()->count(5)->create()
        ->each(function($supplier){
            $supplier->products()->saveMany(Product::factory()->count(3)->make());
        });
    }
}

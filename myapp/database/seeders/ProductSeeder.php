<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Product;

class ProductSeeder extends Seeder
{
   
    protected static $arr = array('a', 'b', 'c', 'd', 'e', 'f', 'g', 'h', 'i', 'j', 'k', 'l', 'm', 'n', 'o', 'p', 'q', 'r', 's', 't', 'u', 'v', 'w', 'x', 'y', 'z');
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for ($i=1; $i<=100; $i++){
            $keys = array_rand(self::$arr, 3);
            Product::create([
                'code'=> sprintf('%04d', $i),
                'name' => self::$arr[$keys[0]] . self::$arr[$keys[1]] . self::$arr[$keys[2]]
            ]);
        }
    }
}

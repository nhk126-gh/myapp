<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Product;

class ProductFactory extends Factory
{
    protected $model = Product::class;
    protected static int $sequence = 1;
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'address' => str_pad(self::$sequence++, 5, 0, STR_PAD_LEFT),
            'supplier_code' => $this->faker->randomElement(['00100', '00200', '00300', '00400', '00500']),
            'hinban' => $this->faker->regexify('([A-Z]|[1-9]){5}-([A-Z]|[1-9]){5}-00'),
            'seban' => str_pad($this->faker->numberBetween(0, 5000), 4, 0, STR_PAD_LEFT),
            'store' => $this->faker->regexify('([A-Z])\d{2}-\d{2}-\d'),
            'quantity' => random_int(1, 100) * 10,
            'box_type' => $this->faker->randomElement(['TP331', 'TP332', 'TP342', 'RG331', 'RG332', 'RG342'])
        ];
    }
}

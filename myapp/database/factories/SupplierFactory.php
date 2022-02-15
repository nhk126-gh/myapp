<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Supplier;

class SupplierFactory extends Factory
{
    protected static int $sequence = 1;
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'supplier_code' => str_pad(self::$sequence++, 5, 0, STR_PAD_LEFT),
            'supplier_name' => $this->faker->company(),
        ];
    }
}

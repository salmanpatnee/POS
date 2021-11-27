<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class ProductFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $purchase_price = $this->faker->randomFloat(2, 10, 1000);

        return [
            'category_id' => $this->faker->numberBetween(1, 3),
            'name' => $this->faker->sentence(2),
            'code' => $this->faker->randomNumber(6),
            'description' => $this->faker->paragraph(12),
            'image' => null,
            'quantity' => $this->faker->numberBetween(1, 50),
            'purchase_price' => $purchase_price,
            'sale_price' => $purchase_price + 30,
        ];
    }
}

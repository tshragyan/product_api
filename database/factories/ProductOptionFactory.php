<?php

namespace Database\Factories;

use App\Models\Product;
use App\Models\ProductOption;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\ProductOption>
 */
class ProductOptionFactory extends Factory
{
    protected $model = ProductOption::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */

    public function definition()
    {
        return [
            'title' => $this->faker->randomElement(['color', 'size', 'brand']),
            'value' => $this->faker->word(),
            'product_id' => Product::factory(),
        ];
    }

    public function color()
    {
        return $this->state(function (array $attributes) {
            return [
                'title' => 'color',
                'value' => $this->faker->randomElement(['red', 'green', 'blue']),
            ];
        });
    }

    public function size()
    {
        return $this->state(function (array $attributes) {
            return [
                'title' => 'size',
                'value' => $this->faker->randomElement(['x', 'xs', 's', 'l', 'xl']),
            ];
        });
    }

    public function brand()
    {
        return $this->state(function (array $attributes) {
            return [
                'title' => 'brand',
                'value' => $this->faker->randomElement(['adidas', 'nike', 'puma']),
            ];
        });
    }
}

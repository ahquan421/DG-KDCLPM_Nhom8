<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class ProductFactory extends Factory
{
    public function definition(): array
    {
        return [
            'name' => $this->faker->sentence(3), // tên sách
            'price' => $this->faker->numberBetween(50000, 300000),
            'quantity' => $this->faker->numberBetween(1, 100),
            'author' => $this->faker->name,
            'publisher' => $this->faker->company,
            'page' => $this->faker->numberBetween(100, 800),
            'description' => $this->faker->paragraph,
            'year_of_publication' => $this->faker->year,
            'image' => 'default.jpg', // ảnh mặc định (bạn có thể thay đổi)
            'category_id' => $this->faker->numberBetween(1, 5), // giả sử có 5 category
        ];
    }
}

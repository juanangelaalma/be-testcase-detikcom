<?php

namespace Database\Factories;

use App\Models\Category;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Book>
 */
class BookFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'user_id'   => function () {
                return User::inRandomOrder()->first()->id;
            },
            'category_id'   => function () {
                return Category::inRandomOrder()->first()->id;
            },
            'title' => $this->faker->sentence,
            'description' => $this->faker->paragraph,
            'quantity' => $this->faker->numberBetween(1, 100),
            'file' => $this->faker->url,
            'cover' => $this->faker->imageUrl(),
        ];
    }
}

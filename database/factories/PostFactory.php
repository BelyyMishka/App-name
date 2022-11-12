<?php

namespace Database\Factories;

use App\Models\Category;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Post>
 */
class PostFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        $categoryId = Category::all()->random()->id;
        $userId = User::all()->random()->id;

        return [
            'title' => $this->faker->sentence(),
            'category_id' => $categoryId,
            'user_id' => $userId,
            'content' => $this->faker->text(),
            'views' => 0,
        ];
    }
}

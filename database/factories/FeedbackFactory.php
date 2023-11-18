<?php

namespace Database\Factories;

use App\Enums\FeedbackCategoryEnum;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Feedback>
 */
class FeedbackFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'title' => fake()->name(),
            'category' => fake()->randomElement(FeedbackCategoryEnum::array()),
            'description' => fake()->paragraph(50),
            'user_id' => User::factory(),
        ];
    }
}

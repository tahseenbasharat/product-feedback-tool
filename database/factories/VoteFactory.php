<?php

namespace Database\Factories;

use App\Enums\VoteTypeEnum;
use App\Models\Comment;
use App\Models\Feedback;
use App\Models\User;
use App\Models\Vote;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Vote>
 */
class VoteFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'feedback_id' => Feedback::factory(),
            'user_id' => User::factory(),
            'type' => fn () => fake()->randomElement(VoteTypeEnum::array()),
        ];
    }

    public function configure()
    {
        return $this->afterCreating(
            fn(Vote $vote) => Comment::factory()
                ->create([
                    'user_id' => $vote->user_id,
                    'feedback_id' => $vote->feedback_id,
                ])
        );
    }
}

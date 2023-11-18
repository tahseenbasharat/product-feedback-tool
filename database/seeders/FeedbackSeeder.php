<?php

namespace Database\Seeders;

use App\Enums\VoteTypeEnum;
use App\Models\Feedback;
use App\Models\User;
use App\Models\Vote;
use Illuminate\Database\Seeder;

class FeedbackSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $userIds = User::pluck('id')->toArray();

        Feedback::factory(100)
            ->create()->each(
                fn($feedback) => Vote::factory(rand(0, 100))
                    ->create([
                        'user_id' => function() use (&$userIds) {
                            $index = array_rand($userIds);
                            $userId = $userIds[$index];

                            unset($userIds[$index]);
                            return $userId;
                        },
                        'feedback_id' => $feedback->id,
                        'type' => fn () => fake()->randomElement(VoteTypeEnum::array()),
                    ])
            );
    }
}

<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Comment;
use App\Models\Feedback;
use App\Models\User;
use App\Models\Vote;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        if ($this->command->confirm('Warning! This will truncate all records and generate new record')) {
            // truncate all records
            DB::statement('SET FOREIGN_KEY_CHECKS=0');
            Comment::truncate();
            Vote::truncate();
            Feedback::truncate();
            User::truncate();
            DB::statement('SET FOREIGN_KEY_CHECKS=1');


            $this->call(UserSeeder::class);
            $this->call(FeedbackSeeder::class);
        } else {
            $this->command->comment('Aborted');
        }
    }
}

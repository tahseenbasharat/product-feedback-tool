<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Creating personal account
        User::factory()
            ->create([
                'name' => 'Tahseen Basharat',
                'username' => 'tahseenbasharat'
            ]);

        // Create dummy user accounts
        User::factory(1000)->create();
    }
}

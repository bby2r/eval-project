<?php

namespace Database\Seeders;

use App\Models\Post;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        User::factory(30)->create();

        User::factory()->create([
            'name' => 'Test User',
            'email' => 'test@example.com',
        ]);

        Post::factory(300)->create();

        $users = User::all();
        foreach($users as $user) {
            $rand_number = random_int(20, 31);
            $shuffled_users = $users->shuffle()->take($rand_number);
            foreach($shuffled_users as $shuffled_user) {
                if ($shuffled_user->id === $user->id) {
                    continue;
                }
                DB::table('user_subscribers')->insert([
                    'user_id' => $user->id,
                    'subscriber_id' => $shuffled_user->id
                ]);
            }
        }

    }
}

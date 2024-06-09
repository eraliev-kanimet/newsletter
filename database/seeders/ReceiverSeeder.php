<?php

namespace Database\Seeders;

use App\Models\Receiver;
use App\Models\User;
use Illuminate\Database\Seeder;

class ReceiverSeeder extends Seeder
{
    public function run(): void
    {
        $user = User::first();

        if ($user && !Receiver::exists()) {
            for ($i = 0; $i < 21; $i++) {
                Receiver::create([
                    'user_id' => $user->id,
                    'email' => fake()->email,
                    'data' => [
                        'name' => fake()->name,
                    ],
                ]);
            }
        }
    }
}

<?php

namespace Database\Seeders;

use App\Models\Message;
use App\Models\User;
use Illuminate\Database\Seeder;

class MessageSeeder extends Seeder
{
    public function run(): void
    {
        $user = User::first();

        if ($user && !Message::exists()) {
            for ($i = 0; $i < 10; $i++) {
                $this->create($user->id);
            }
        }
    }

    protected function create(int $user_id): void
    {
        $random = rand(0, 2);

        if ($random == 2) {
            $message = [
                'text' => fake()->text  . '. ' . fake()->text,
                'html' => fakeContent(),
            ];
        } else if ($random == 1) {
            $message = [
                'html' => fakeContent(),
            ];
        } else {
            $message = [
                'text' => fake()->text  . '. ' . fake()->text,
            ];
        }

        Message::create([
            'user_id' => $user_id,
            'subject' => fake()->sentence(),
            'message' => $message,
        ]);
    }
}

<?php

namespace Database\Seeders;

use App\Models\Message;
use App\Models\Receiver;
use App\Models\SendingProcess;
use App\Models\User;
use Illuminate\Database\Seeder;

class SendingProcessSeeder extends Seeder
{
    public function run(): void
    {
        $user = User::first();

        if ($user && Receiver::count() >= 20 && Message::exists() && !SendingProcess::exists()) {
            $this->createAll($user->id);
        }
    }

    protected function createAll(int $user_id): void
    {
        for ($i = 0; $i < 20; $i++) {
            $this->create($user_id, rand(2, 4));
        }
    }

    protected function create(int $user_id, int $status): void
    {
        $message = Message::inRandomOrder()->limit(1)->first();

        $process = SendingProcess::create([
            'user_id' => $user_id,
            'message' => [
                'subject' => $message->subject,
                'text' => $message->data['text'] ?? '',
                'html' => $message->data['html'] ?? '',
            ],
            'status' => $status,
            'when' => now()->minute(rand(120, 300))
        ]);

        $receivers = Receiver::inRandomOrder()->limit(rand(10, 20))->get();

        $process->receivers()->attach($receivers);
    }
}

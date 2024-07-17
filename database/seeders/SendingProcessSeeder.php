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
        foreach (range(1, 6) as $month) {
            $rand = rand(8, 15);

            for ($i = 0; $i < $rand; $i++) {
                $this->create($user_id, rand(2, 4), now()->subMonths(6 - $month)->addDays(rand(1, 20)));
            }
        }

        $rand = rand(5, 10);

        for ($i = 0; $i < $rand; $i++) {
            $this->create($user_id, rand(2, 4), now());
        }
    }

    protected function create(int $user_id, int $status, mixed $at): void
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
            'when' => now()->minute(rand(120, 300)),
            'updated_at' => $at,
            'created_at' => $at,
        ]);

        $receivers = Receiver::inRandomOrder()->limit(rand(10, 20))->get();

        $process->receivers()->attach($receivers);
    }
}

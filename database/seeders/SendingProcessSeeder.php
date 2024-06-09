<?php

namespace Database\Seeders;

use App\Enums\SendingProcessStatus;
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
        $messages = Message::pluck('id')->toArray();
        $count1 = count($messages) - 1;

        $status = SendingProcessStatus::values();

        unset($status[1]);

        $status = array_values($status);

        $count2 = count($status) - 1;

        for ($i = 0; $i < 20; $i++) {
            $this->create($user_id, $messages[rand(0, $count1)], $status[rand(0, $count2)]);
        }
    }

    protected function create(int $user_id, int $message_id, int $status): void
    {
        $process = SendingProcess::create([
            'user_id' => $user_id,
            'message_id' => $message_id,
            'status' => $status,
            'when' => now()->minute(rand(120, 300))
        ]);

        $receivers = Receiver::inRandomOrder()->limit(rand(10, 20))->get();

        $process->receivers()->attach($receivers);
    }
}

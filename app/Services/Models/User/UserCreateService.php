<?php

namespace App\Services\Models\User;

use App\Contracts\Mail\MailServiceInterface;
use App\Contracts\User\UserCreateServiceInterface;
use App\Contracts\User\UserServiceInterface;
use App\Exceptions\UserCreationOrderException;
use App\Mail\UserCreationOrderMail;
use App\Models\TimeData;
use App\Models\User;
use Illuminate\Support\Str;

class UserCreateService implements UserCreateServiceInterface
{
    const CREATION_ORDER = 'USER_CREATION_ORDER';

    public function __construct(
        protected MailServiceInterface $mailService
    )
    {
        //
    }

    public function execute(array $data): UserServiceInterface
    {
        if (empty($data['roles'])) {
            $data['roles'] = [2];
        }

        if (empty($data['password'])) {
            $data['password'] = Str::random(8);
        }

        $user = User::create($data);

        $service = new UserService();

        return $service->set($user);
    }

    public function placeOrder(array $data): void
    {
        $token = md5(uniqid(rand(), true));

        TimeData::create([
            'type' => self::CREATION_ORDER,
            'token' => $token,
            'data' => $data,
        ]);

        $link = route('auth.register.action', ['token' => $token]);

        $this->mailService
            ->to($data['email'])
            ->setMailable(new UserCreationOrderMail($link))
            ->send();
    }

    public function withOrder(string|int $id): UserServiceInterface
    {
        $timeData = TimeData::whereType(self::CREATION_ORDER)->whereToken($id)->first();

        if (!$timeData) {
            throw new UserCreationOrderException;
        }

        if ($timeData->created_at->addMinutes(30)->isPast()) {
            throw new UserCreationOrderException;
        }

        if (User::whereEmail($timeData->data['email'])->exists()) {
            throw new UserCreationOrderException;
        }

        $timeData->delete();

        return $this->execute($timeData->data);
    }
}

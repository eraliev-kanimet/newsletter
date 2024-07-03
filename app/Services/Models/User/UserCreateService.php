<?php

namespace App\Services\Models\User;

use App\Contracts\User\UserCreateServiceInterface;
use App\Contracts\User\UserServiceInterface;
use App\Exceptions\UserCreationOrderException;
use App\Models\TimeData;
use App\Models\User;
use Illuminate\Support\Str;

class UserCreateService implements UserCreateServiceInterface
{
    const CREATION_ORDER = 'USER_CREATION_ORDER';

    public function execute(array $data): UserServiceInterface
    {
        $data['roles'] = [1];

        if (empty($data['password'])) {
            $data['password'] = Str::random(8);
        }

        $user = User::create($data);

        $service = new UserService();

        return $service->set($user);
    }

    public function placeOrder(array $data): void
    {
        TimeData::create([
            'type' => self::CREATION_ORDER,
            'token' => md5(uniqid(rand(), true)),
            'data' => $data,
        ]);
    }

    public function withOrder(string|int $id): void
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

        $this->execute($timeData->data)->login();

        $timeData->delete();
    }
}

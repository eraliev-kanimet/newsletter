<?php

namespace App\Http\Controllers\Api\Auth;

use App\Contracts\Auth\PasswordResetServiceInterface;
use App\Exceptions\PasswordResetException;
use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\PasswordResetRequest;
use App\Http\Requests\EmailRequest;

class PasswordController extends Controller
{
    public function forgot(EmailRequest $request, PasswordResetServiceInterface $service)
    {
        $service->send($request->get('email'), true);

        return $this->apiRes();
    }

    public function reset(PasswordResetRequest $request, PasswordResetServiceInterface $service)
    {
        try {
            $userService = $service->reset(
                $request->get('token'),
                $request->get('password')
            );
        } catch (PasswordResetException) {
            return $this->apiRes(status: 404);
        }

        $userService->login();

        return $this->apiRes($userService->api()->resourceWithToken());
    }
}

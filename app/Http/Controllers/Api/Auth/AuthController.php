<?php

namespace App\Http\Controllers\Api\Auth;

use App\Contracts\User\UserServiceInterface;
use App\Exceptions\UserCreationOrderException;
use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Http\Requests\Auth\RegisterRequest;
use App\Http\Requests\TokenRequest;
use App\Services\Models\User\UserCreateService;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function order(RegisterRequest $request, UserCreateService $service)
    {
        $service->placeOrder($request->validated(), true);

        return $this->apiRes();
    }

    public function register(TokenRequest $request, UserCreateService $service)
    {
        try {
            $service = $service->withOrder($request->get('token'));
        } catch (UserCreationOrderException) {
            return $this->apiRes(status: 404);
        }

        $service->login();

        return $this->apiRes($service->api()->resourceWithToken());
    }

    public function login(LoginRequest $request, UserServiceInterface $service)
    {
        if ($service->attempt($request->validated())) {
            return $this->apiRes($service->api()->resourceWithToken());
        }

        return $this->apiRes(api_login_error(), 422);
    }

    public function logout(UserServiceInterface $service)
    {
        $service->set(Auth::user())->api()->logout();

        return $this->apiRes();
    }
}

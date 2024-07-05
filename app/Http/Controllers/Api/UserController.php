<?php

namespace App\Http\Controllers\Api;

use App\Contracts\User\UserCreateServiceInterface;
use App\Http\Controllers\Controller;
use App\Http\Requests\Api\UserCreateRequest;
use App\Http\Requests\Api\UserGetRequest;
use App\Http\Resources\UserResource;
use App\Models\User;
use App\Services\Models\Api\User\UserGetService;

class UserController extends Controller
{
    public function index(UserGetRequest $request, UserGetService $service)
    {
        $service->setParameters($request->validated());

        return $service->get();
    }

    public function store(UserCreateRequest $request, UserCreateServiceInterface $service)
    {
        $userService = $service->execute($request->validated());

        return $this->show($userService->get());
    }

    public function show(User $user)
    {
        return new UserResource($user);
    }

    public function destroy(User $user)
    {
        $user->delete();

        $this->apiRes(status: 204);
    }
}
